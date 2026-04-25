@extends('layouts.app', ['title' => 'Welcome'])

@section('content')

<!-- Hero Section -->
<section class="relative overflow-hidden bg-white dark:bg-slate-950">
    <div class="absolute inset-0 bg-gradient-to-br from-[#0b3a67]/10 via-transparent to-[#ed1c24]/10 dark:from-[#0b3a67]/30 dark:to-[#ed1c24]/20"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-28 grid lg:grid-cols-2 gap-12 items-center">

        <!-- Left -->
        <div>
            <p class="inline-flex rounded-full bg-[#0b3a67]/10 px-4 py-2 text-sm font-semibold text-[#0b3a67] dark:bg-white/10 dark:text-slate-200 mb-6">
                TC Affiliate Platform
            </p>

            <h1 class="text-4xl md:text-6xl font-extrabold text-[#0b3a67] dark:text-white leading-tight">
                Earn with TC by sharing your referral code
            </h1>

            <p class="mt-6 text-lg text-[#7a7a7a] dark:text-slate-300 leading-relaxed max-w-xl">
                Create your affiliate account, generate your referral code, track your growth,
                monitor earnings, and withdraw your funds — all from one dashboard.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row gap-4">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="inline-flex justify-center rounded-xl bg-[#ed1c24] px-7 py-3.5 font-semibold text-white hover:opacity-90 transition">
                        Get Started
                    </a>
                @endif

                @if (Route::has('login'))
                    <a href="{{ route('login') }}"
                       class="inline-flex justify-center rounded-xl border-2 border-[#0b3a67] px-7 py-3.5 font-semibold text-[#0b3a67] hover:bg-[#0b3a67] hover:text-white dark:border-slate-500 dark:text-slate-100 dark:hover:bg-slate-800 transition">
                        Login
                    </a>
                @endif
            </div>
        </div>

        <!-- Right -->
        <div class="rounded-3xl bg-[#0b3a67] dark:bg-slate-900 p-8 text-white shadow-2xl border border-white/10">

            <div class="bg-white/10 rounded-2xl p-6 mb-6">
                <p class="text-sm text-gray-200">Your Referral Code</p>
                <h2 class="text-4xl font-extrabold text-[#ed1c24] mt-2">TC-USER123</h2>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-5">
                    <p class="text-sm text-gray-500 dark:text-slate-400">Referrals</p>
                    <h3 class="text-3xl font-bold text-[#0b3a67] dark:text-white">0</h3>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-2xl p-5">
                    <p class="text-sm text-gray-500 dark:text-slate-400">Earnings</p>
                    <h3 class="text-3xl font-bold text-[#0b3a67] dark:text-white">₦0</h3>
                </div>
            </div>

            <div class="mt-6 rounded-2xl bg-white/10 p-5">
                <p class="text-sm text-gray-200">Available Balance</p>
                <h3 class="text-4xl font-extrabold mt-2">₦0.00</h3>
            </div>
        </div>

    </div>
</section>

<!-- How It Works -->
<section id="how-it-works" class="py-20 bg-[#f2f2f2] dark:bg-slate-950">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-[#0b3a67] dark:text-white">
                How It Works
            </h2>
            <p class="mt-4 text-gray-500 dark:text-slate-400">
                Start earning in three simple steps.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">

            <div class="card">
                <div class="step">1</div>
                <h3>Create Account</h3>
                <p>Register and verify your email to activate your affiliate account.</p>
            </div>

            <div class="card">
                <div class="step">2</div>
                <h3>Share Your Code</h3>
                <p>Generate your unique referral code and share it with others.</p>
            </div>

            <div class="card">
                <div class="step">3</div>
                <h3>Earn & Withdraw</h3>
                <p>Track referrals, monitor earnings, and request withdrawals.</p>
            </div>

        </div>
    </div>
</section>

<!-- Benefits -->
<section id="benefits" class="bg-white dark:bg-slate-900 py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">

        <div>
            <h2 class="text-3xl md:text-4xl font-bold text-[#0b3a67] dark:text-white mb-5">
                Built for growth
            </h2>

            <p class="text-gray-500 dark:text-slate-400 mb-8">
                Everything you need to succeed as a TC affiliate is built into one platform.
            </p>

            <ul class="space-y-4">
                <li class="benefit">Create your own referral code</li>
                <li class="benefit">Track referrals in real-time</li>
                <li class="benefit">Monitor earnings and withdrawals</li>
            </ul>
        </div>

        <div class="bg-[#f2f2f2] dark:bg-slate-950 p-8 rounded-3xl border border-gray-200 dark:border-slate-800">
            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl">
                <p class="text-gray-500">Affiliate Balance</p>
                <h3 class="text-5xl font-bold mt-3 text-[#0b3a67] dark:text-white">₦0.00</h3>

                <button class="mt-6 w-full bg-[#ed1c24] text-white py-3 rounded-xl">
                    Request Withdrawal
                </button>
            </div>
        </div>

    </div>
</section>

<!-- FAQ -->
<section id="faq" class="py-20 bg-[#f2f2f2] dark:bg-slate-950">
    <div class="max-w-4xl mx-auto px-6">

        <h2 class="text-3xl font-bold text-center text-[#0b3a67] dark:text-white mb-10">
            FAQ
        </h2>

        <div class="space-y-4">

            <div class="faq">
                <h3>Do I need a referral code?</h3>
                <p>No. You register and create your own.</p>
            </div>

            <div class="faq">
                <h3>Can I choose my code?</h3>
                <p>Yes, as long as it is unique.</p>
            </div>

            <div class="faq">
                <h3>Where do I track earnings?</h3>
                <p>From your dashboard after login.</p>
            </div>

        </div>
    </div>
</section>

<style>
.card {
    background: white;
    padding: 1.5rem;
    border-radius: 1rem;
    border: 1px solid #eee;
}
.dark .card {
    background: #0f172a;
    border-color: #1e293b;
}

.step {
    background: #ed1c24;
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    font-weight: bold;
}

.benefit::before {
    content: "• ";
    color: #ed1c24;
    font-weight: bold;
}

.faq {
    background: white;
    padding: 1rem;
    border-radius: 10px;
}
.dark .faq {
    background: #0f172a;
}
</style>

@endsection