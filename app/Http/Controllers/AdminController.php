<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Referral;
use App\Models\Withdrawal;
use App\Models\AffiliateEarning;

class AdminController extends Controller
{
    private function authorizeAdmin()
    {
        if (! auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }
    }

    public function users()
    {
        $this->authorizeAdmin();

        $query = User::with([
            'referrals',
            'affiliateEarnings',
            'withdrawals',
        ])
            ->where('role', 'affiliate');

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */
        if (request('search')) {

            $search = trim(request('search'));

            $query->where(function ($q) use ($search) {

                $q->where('firstname', 'like', "%{$search}%")
                    ->orWhere('surname', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('referral_code', 'like', "%{$search}%");
            });
        }

        $users = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Transform User Analytics
        |--------------------------------------------------------------------------
        */
        $users->getCollection()->transform(function ($user) {

            $totalReferrals = $user->referrals->count();

            $totalEarnings = $user->affiliateEarnings
                ->sum('amount');

            $approvedEarnings = $user->affiliateEarnings
                ->where('status', 'approved')
                ->sum('amount');

            $pendingEarnings = $user->affiliateEarnings
                ->where('status', 'pending')
                ->sum('amount');

            $paidWithdrawals = $user->withdrawals
                ->whereIn('status', ['approved', 'paid'])
                ->sum('amount');

            $pendingWithdrawals = $user->withdrawals
                ->where('status', 'pending')
                ->sum('amount');

            $availableBalance = max(
                $approvedEarnings - (
                    $paidWithdrawals + $pendingWithdrawals
                ),
                0
            );

            $user->total_referrals = $totalReferrals;
            $user->total_earnings = $totalEarnings;
            $user->approved_earnings = $approvedEarnings;
            $user->pending_earnings = $pendingEarnings;
            $user->paid_withdrawals = $paidWithdrawals;
            $user->pending_withdrawals = $pendingWithdrawals;
            $user->available_balance = $availableBalance;

            return $user;
        });

        /*
        |--------------------------------------------------------------------------
        | Filters
        |--------------------------------------------------------------------------
        */
        if (request('filter') === 'high_earners') {

            $users->setCollection(
                $users->getCollection()->filter(function ($user) {
                    return $user->total_earnings >= 1000;
                })
            );
        }

        if (request('filter') === 'pending_withdrawals') {

            $users->setCollection(
                $users->getCollection()->filter(function ($user) {
                    return $user->pending_withdrawals > 0;
                })
            );
        }

        if (request('filter') === 'low_balance') {

            $users->setCollection(
                $users->getCollection()->filter(function ($user) {
                    return $user->available_balance < 1000;
                })
            );
        }

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    public function exportUsers()
    {
        $this->authorizeAdmin();

        $filename = 'affiliate-users-' . now()->format('Y-m-d-H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function () {

            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Name',
                'Email',
                'Referrals',
                'Total Earnings',
                'Pending Earnings',
                'Paid Out',
                'Pending Withdrawals',
                'Balance',
            ]);

            $users = User::with([
                'referrals',
                'affiliateEarnings',
                'withdrawals',
            ])
                ->where('role', 'affiliate')
                ->get();

            foreach ($users as $user) {

                $totalReferrals = $user->referrals->count();

                $totalEarnings = $user->affiliateEarnings->sum('amount');

                $pendingEarnings = $user->affiliateEarnings
                    ->where('status', 'pending')
                    ->sum('amount');

                $paidWithdrawals = $user->withdrawals
                    ->whereIn('status', ['approved', 'paid'])
                    ->sum('amount');

                $pendingWithdrawals = $user->withdrawals
                    ->where('status', 'pending')
                    ->sum('amount');

                $approvedEarnings = $user->affiliateEarnings
                    ->where('status', 'approved')
                    ->sum('amount');

                $balance = max(
                    $approvedEarnings - (
                        $paidWithdrawals + $pendingWithdrawals
                    ),
                    0
                );

                fputcsv($file, [
                    $user->firstname . ' ' . $user->surname,
                    $user->email,
                    $totalReferrals,
                    $totalEarnings,
                    $pendingEarnings,
                    $paidWithdrawals,
                    $pendingWithdrawals,
                    $balance,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function dashboard()
    {
        $this->authorizeAdmin();

        return view('admin.dashboard', [
            'totalReferrals' => Referral::count(),
            'pendingAffiliates' => User::where('role', 'affiliate')
                ->whereNull('email_verified_at')
                ->latest()
                ->take(5)
                ->get(),

            'pendingAffiliatesCount' => User::where('role', 'affiliate')
                ->whereNull('email_verified_at')
                ->count(),

            'pendingWithdrawals' => Withdrawal::with(['user', 'bankAccount'])
                ->where('status', 'pending')
                ->latest()
                ->take(5)
                ->get(),

            'pendingWithdrawalsCount' => Withdrawal::where('status', 'pending')->count(),

            'recentReferrals' => Referral::with('user')
                ->latest()
                ->take(10)
                ->get(),

            'pendingEarnings' => AffiliateEarning::with(['user', 'referral'])
                ->where('status', 'pending')
                ->latest()
                ->take(5)
                ->get(),

            'pendingEarningsCount' => AffiliateEarning::where('status', 'pending')->count(),

            // 'recentReferrals' => Referral::with('user')
            //     ->latest()
            //     ->take(10)
            //     ->get(),
        ]);
    }

    public function referrals()
    {
        $this->authorizeAdmin();

        return view('admin.referrals.index', [
            'referrals' => Referral::with('user')
                ->latest()
                ->paginate(20),
        ]);
    }

    public function withdrawals()
    {
        $this->authorizeAdmin();

        return view('admin.withdrawals.index', [
            'withdrawals' => Withdrawal::with(['user', 'bankAccount'])
                ->latest()
                ->paginate(20),
        ]);
    }

    public function pendingAffiliates()
    {
        $this->authorizeAdmin();

        return view('admin.affiliates.pending', [
            'affiliates' => User::where('role', 'affiliate')
                ->whereNull('email_verified_at')
                ->latest()
                ->paginate(20),
        ]);
    }

    public function pendingEarnings()
    {
        $this->authorizeAdmin();

        return view('admin.earnings.pending', [
            'earnings' => AffiliateEarning::with(['user', 'referral'])
                ->where('status', 'pending')
                ->latest()
                ->paginate(20),
        ]);
    }

    public function approveEarning(AffiliateEarning $earning)
    {
        $this->authorizeAdmin();

        if ($earning->status !== 'pending') {
            return back()->with('error', 'Only pending earnings can be approved.');
        }

        $earning->update([
            'status' => 'approved',
        ]);

        return back()->with('success', 'Earning approved successfully.');
    }

    public function declineEarning(AffiliateEarning $earning)
    {
        $this->authorizeAdmin();

        if ($earning->status !== 'pending') {
            return back()->with('error', 'Only pending earnings can be declined.');
        }

        $earning->update([
            'status' => 'declined',
        ]);

        return back()->with('success', 'Earning declined successfully.');
    }

    public function approveWithdrawal(Withdrawal $withdrawal)
    {
        $this->authorizeAdmin();

        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Only pending withdrawals can be approved.');
        }

        $withdrawal->update([
            'status' => 'approved',
        ]);

        return back()->with('success', 'Withdrawal approved.');
    }

    public function rejectWithdrawal(Withdrawal $withdrawal)
    {
        $this->authorizeAdmin();

        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Only pending withdrawals can be rejected.');
        }

        $withdrawal->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Withdrawal rejected.');
    }

    public function markWithdrawalSent(Withdrawal $withdrawal)
    {
        $this->authorizeAdmin();

        if ($withdrawal->status !== 'approved') {
            return back()->with('error', 'Only approved withdrawals can be marked as sent.');
        }

        $withdrawal->update([
            'status' => 'paid',
        ]);

        return back()->with('success', 'Withdrawal marked as sent.');
    }
}
