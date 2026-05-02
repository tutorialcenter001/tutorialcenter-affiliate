<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Referral;
use Illuminate\Http\Request;
use App\Models\AffiliateEarning;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReferralController extends Controller
{

    /**
     * Handle referral registration from the main platform.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'contact' => 'required|string|max:255',
            'referral_code' => 'required|string|exists:users,referral_code',

            // Optional earning data from main platform
            // 'amount' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            $affiliate = User::where('referral_code', $request->referral_code)->first();

            if (! $affiliate) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid referral code.',
                ], 404);
            }

            $referral = Referral::where('user_id', $affiliate->id)
                ->where('contact', $request->contact)
                ->first();

            if (! $referral) {
                $referral = Referral::create([
                    'user_id' => $affiliate->id,
                    'name' => $request->name,
                    'contact' => $request->contact,
                    'referral_code' => $request->referral_code,
                    'status' => 'converted',
                    'referred_at' => now(),
                ]);
            } else {
                $referral->update([
                    'name' => $request->name ?? $referral->name,
                    'status' => 'converted',
                ]);
            }

            // $earningAmount = $request->amount ?? 0;
            $earningAmount = 500;

            $earning = null;

            if ($earningAmount > 0) {
                $earning = AffiliateEarning::create([
                    'user_id' => $affiliate->id,
                    'referral_id' => $referral->id,
                    'amount' => $earningAmount,
                    'status' => 'pending',
                    'description' => $request->description ?? 'Affiliate earning from referral registration.',
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Referral registered successfully.',
                'data' => [
                    'referral' => $referral,
                    'earning' => $earning,
                ],
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Failed to register referral.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function referrals()
    {
        $user = auth()->user();

        $referrals = Referral::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('referrals.index', [
            'user' => $user,
            'referrals' => $referrals,
        ]);
    }
}
