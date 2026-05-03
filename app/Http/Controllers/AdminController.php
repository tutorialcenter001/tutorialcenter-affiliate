<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Referral;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function authorizeAdmin()
    {
        if (! auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }
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
}