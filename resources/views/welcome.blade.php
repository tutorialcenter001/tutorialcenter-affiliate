<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TC Affiliates | Welcome</title>

    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f2f2f2] text-gray-800 dark:bg-slate-950 dark:text-slate-100">

    @include('components.header')

    <main>

        <!-- Hero -->
        <section class="relative overflow-hidden bg-white dark:bg-slate-950">
            <div class="absolute inset-0 bg-gradient-to-br from-[#0b3a67]/10 via-transparent to-[#ed1c24]/10 dark:from-[#0b3a67]/30 dark:to-[#ed1c24]/20"></div>

            <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-28 grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <p class="inline-flex rounded-full bg-[#0b3a67]/10 px-4 py-2 text-sm font-semibold text-[#0b3a67] dark:bg-white/10 dark:text-slate-200 mb-6">
                        TC Affiliate Partner Platform
                    </p>

                    <h1 class="text-4xl md:text-6xl font-extrabold text-[#0b3a67] dark:text-white leading-tight">
                        Earn with TC by sharing your referral code.
                    </h1>

                    <p class="mt-6 text-lg text-[#7a7a7a] dark:text-slate-300 leading-relaxed max-w-2xl">
                        Join the TC affiliate platform, create your own referral code, track account growth,
                        monitor earnings, and request withdrawals from one simple dashboard.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="inline-flex justify-center rounded-xl bg-[#ed1c24] px-7 py-3.5 font-semibold text-white hover:opacity-90 transition">
                                Become an Affiliate
                            </a>
                        @endif

                        @if (Route::has('login'))
                            <a href="{{ route('login') }}"
                               class="inline-flex justify-center rounded-xl border-2 border-[#0b3a67] px-7 py-3.5 font-semibold text-[#0b3a67] hover:bg-[#0b3a67] hover:text-white dark:border-slate-500 dark:text-slate-100 dark:hover:bg-slate-800 transition">
                                Login to Dashboard
                            </a>
                        @endif
                    </div>
                </div>

                <div class="rounded-3xl bg-[#0b3a67] dark:bg-slate-900 p-8 text-white shadow-2xl border border-white/10">
                    <div class="bg-white/10 rounded-2xl p-6 mb-6">
                        <p class="text-sm text-gray-200">Sample Referral Code</p>
                        <h2 class="text-4xl font-extrabold text-[#ed1c24] mt-2">TC-JOHN25</h2>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white dark:bg-slate-800 rounded-2xl p-5">
                            <p class="text-sm text-[#7a7a7a] dark:text-slate-400">Referrals</p>
                            <h3 class="text-3xl font-bold text-[#0b3a67] dark:text-white">128</h3>
                        </div>

                        <div class="bg-white dark:bg-slate-800 rounded-2xl p-5">
                            <p class="text-sm text-[#7a7a7a] dark:text-slate-400">Earnings</p>
                            <h3 class="text-3xl font-bold text-[#0b3a67] dark:text-white">₦250k</h3>
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
                    <p class="mt-4 text-[#7a7a7a] dark:text-slate-400">
                        Start earning as a TC affiliate in a few simple steps.
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-7 shadow-sm border border-gray-200 dark:border-slate-800">
                        <div class="w-12 h-12 rounded-xl bg-[#ed1c24] text-white flex items-center justify-center font-bold mb-5">1</div>
                        <h3 class="text-xl font-bold text-[#0b3a67] dark:text-white mb-3">Create Account</h3>
                        <p class="text-[#7a7a7a] dark:text-slate-400 leading-relaxed">
                            Register as an affiliate and set up your TC affiliate profile.
                        </p>
                    </div>

                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-7 shadow-sm border border-gray-200 dark:border-slate-800">
                        <div class="w-12 h-12 rounded-xl bg-[#ed1c24] text-white flex items-center justify-center font-bold mb-5">2</div>
                        <h3 class="text-xl font-bold text-[#0b3a67] dark:text-white mb-3">Share Your Code</h3>
                        <p class="text-[#7a7a7a] dark:text-slate-400 leading-relaxed">
                            Create your unique referral code and share it with your audience.
                        </p>
                    </div>

                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-7 shadow-sm border border-gray-200 dark:border-slate-800">
                        <div class="w-12 h-12 rounded-xl bg-[#ed1c24] text-white flex items-center justify-center font-bold mb-5">3</div>
                        <h3 class="text-xl font-bold text-[#0b3a67] dark:text-white mb-3">Track & Withdraw</h3>
                        <p class="text-[#7a7a7a] dark:text-slate-400 leading-relaxed">
                            Monitor your growth and request withdrawals from your dashboard.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefits -->
        <section id="benefits" class="bg-white dark:bg-slate-900 py-20">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-[#0b3a67] dark:text-white mb-5">
                            Built for TC affiliates.
                        </h2>

                        <p class="text-[#7a7a7a] dark:text-slate-400 leading-relaxed mb-8">
                            The platform gives every affiliate a simple way to manage referral activity,
                            monitor performance, and request payouts.
                        </p>

                        <div class="space-y-4">
                            <div class="flex gap-3">
                                <span class="mt-2 w-3 h-3 rounded-full bg-[#ed1c24]"></span>
                                <p class="text-[#7a7a7a] dark:text-slate-300">Create and manage your personal referral code.</p>
                            </div>

                            <div class="flex gap-3">
                                <span class="mt-2 w-3 h-3 rounded-full bg-[#ed1c24]"></span>
                                <p class="text-[#7a7a7a] dark:text-slate-300">Track account growth and referral activity.</p>
                            </div>

                            <div class="flex gap-3">
                                <span class="mt-2 w-3 h-3 rounded-full bg-[#ed1c24]"></span>
                                <p class="text-[#7a7a7a] dark:text-slate-300">Request withdrawal of available affiliate funds.</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-[#f2f2f2] dark:bg-slate-950 p-8 border border-gray-200 dark:border-slate-800">
                        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800">
                            <p class="text-sm text-[#7a7a7a] dark:text-slate-400">Affiliate Balance</p>
                            <h3 class="text-5xl font-extrabold text-[#0b3a67] dark:text-white mt-3">₦0.00</h3>
                            <button class="mt-6 w-full rounded-xl bg-[#ed1c24] py-3 font-semibold text-white">
                                Request Withdrawal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section id="faq" class="py-20 bg-[#f2f2f2] dark:bg-slate-950">
            <div class="max-w-4xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-[#0b3a67] dark:text-white">
                        Frequently Asked Questions
                    </h2>
                </div>

                <div class="space-y-5">
                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-gray-200 dark:border-slate-800">
                        <h3 class="font-bold text-[#0b3a67] dark:text-white mb-2">Do I need a referral code to register?</h3>
                        <p class="text-[#7a7a7a] dark:text-slate-400">
                            No. This platform is for affiliates to register directly and create their own referral code.
                        </p>
                    </div>

                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-gray-200 dark:border-slate-800">
                        <h3 class="font-bold text-[#0b3a67] dark:text-white mb-2">Can I choose my own referral code?</h3>
                        <p class="text-[#7a7a7a] dark:text-slate-400">
                            Yes. Your referral code must be unique. If someone already uses it, you will need to choose another.
                        </p>
                    </div>

                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-gray-200 dark:border-slate-800">
                        <h3 class="font-bold text-[#0b3a67] dark:text-white mb-2">Where do I track my earnings?</h3>
                        <p class="text-[#7a7a7a] dark:text-slate-400">
                            After registration and verification, you can log in to your dashboard to track growth and withdrawals.
                        </p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    @include('components.footer')

</body>
</html>