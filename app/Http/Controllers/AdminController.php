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

        $users = User::with([
            'referrals',
            'affiliateEarnings',
            'withdrawals',
        ])
            ->where('role', 'affiliate')
            ->latest()
            ->paginate(20);

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

        return view('admin.users.index', [
            'users' => $users,
        ]);
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
