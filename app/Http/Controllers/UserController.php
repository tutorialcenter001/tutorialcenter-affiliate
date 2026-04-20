<?php

namespace App\Http\Controllers;

use App\Models\AccountVerification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        try {
            $users = User::withTrashed()->paginate(15);

            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve users', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'referral_code' => 'required|string|max:255|unique:users,referral_code',
            'role' => 'required|string|in:affiliate,admin,user',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number' => [
                'nullable',
                'string',
                'size:11',
                'regex:/^0(70|80|81|90|91)\d{8}$/',
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            $user = new User();
            $user->firstname = $request->firstname;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->referral_code = $request->referral_code;
            $user->role = $request->role;
            $user->phone_number = $request->phone_number;

            if ($request->hasFile('profile_picture')) {
                $user->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
            }

            $user->save();

            $verification = AccountVerification::create([
                'user_id' => $user->id,
                'token' => rand(100000, 999999),
                'expires_at' => now()->addHours(24),
            ]);

            Mail::to($user->email)->send(new VerificationMail($user, $verification->token));

            DB::commit();

            return response()->json([
                'message' => 'Account created successfully. Please check your email for verification.',
                'user' => $user,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'Failed to create user',
                'message' => $e->getMessage(),
                'trace_message' => config('app.debug') ? $e->getTraceAsString() : null,
            ], 500);
        }
    }

    // Account verification method
    public function verifyAccount($token){
        $verification = AccountVerification::where('token', $token)->first();

        if (!$verification) {
            return redirect()->route('login')->with('error', 'Invalid verification link.');
        }

        if ($verification->expires_at && now()->gt($verification->expires_at)) {
            return redirect()->route('login')->with('error', 'Verification link expired.');
        }

        $user = $verification->user;

        if ($user->email_verified_at) {
            return redirect()->route('login')->with('success', 'Account already verified.');
        }

        $user->update([
            'email_verified_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Account verified successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'firstname' => 'sometimes|required|string|max:255',
                'surname' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'sometimes|required|string|min:8',
                'referral_code' => 'sometimes|required|string|max:255|unique:users,referral_code,' . $user->id,
                'role' => 'sometimes|required|string|in:affiliate,admin,user',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'phone_number' => 'nullable|string|max:20',
            ]);

            DB::beginTransaction();

            $data = $request->only(['firstname', 'surname', 'email', 'referral_code', 'role', 'phone_number']);

            if ($request->has('password')) {
                $data['password'] = Hash::make($request->password);
            }

            if ($request->hasFile('profile_picture')) {
                // Delete old profile picture if exists
                if ($user->profile_picture) {
                    Storage::disk('public')->delete($user->profile_picture);
                }
                $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
            }

            $user->update($data);

            DB::commit();

            return response()->json($user);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to update user', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();

            $user->delete();

            DB::commit();

            return response()->json(['message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete user', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        try {
            DB::beginTransaction();

            $user = User::withTrashed()->findOrFail($id);
            $user->restore();

            DB::commit();

            return response()->json(['message' => 'User restored successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to restore user', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Handle user registration.
     */
    public function registerUser(Request $request)
    {
        try {
            $request->validate([
                'firstname' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'referral_code' => 'required|string|max:255|unique:users',
                'role' => 'required|string|in:affiliate,admin,user',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'phone_number' => 'nullable|string|max:11|min:11|regex:/^\+?[0-9]{10,11}$/',
            ]);

            DB::beginTransaction();

            $data = [
                'firstname' => $request->firstname,
                'surname' => $request->surname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'referral_code' => $request->referral_code,
                'role' => $request->role,
                'phone_number' => $request->phone_number,
            ];

            if ($request->hasFile('profile_picture')) {
                $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
            }

            $user = User::create($data);

            // Send verification email
            Mail::send(new VerificationMail($user));

            DB::commit();

            // Log the user in but redirect to verification notice
            \Illuminate\Support\Facades\Auth::login($user);

            return redirect('/email/verify')->with('success', 'Registration successful! Please check your email to verify your account.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to create user: ' . $e->getMessage()]);
        }
    }

    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        if (!Auth::attempt($request->only('email', 'password'), $request->remember)) {
            return response()->json([
                'message' => 'Invalid login credentials',
            ], 401);
        }

        $request->session()->regenerate();

        return response()->json([
            'message' => 'Login successful',
            'redirect' => route('dashboard'),
        ]);
    }

    /**
     * Handle user logout.
     */
    public function logoutUser(Request $request)
    {
        try {
            \Illuminate\Support\Facades\Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/')->with('success', 'Logged out successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Logout failed: ' . $e->getMessage()]);
        }
    }
}