<footer class="bg-[#0b3a67] text-white dark:bg-slate-950 border-t border-white/10 dark:border-slate-800">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-12">
        <div class="grid md:grid-cols-3 gap-10">

            <div>
                <img src="{{ asset('images/tc-logo.png') }}" alt="TC Logo" class="h-14 w-auto mb-4">
                <h2 class="text-xl font-bold">TC Affiliates</h2>
                <p class="mt-3 text-sm text-gray-200 dark:text-slate-400 leading-relaxed">
                    Grow with TC by sharing your referral code, tracking your account growth,
                    and managing your affiliate earnings.
                </p>
            </div>

            <div>
                <h3 class="font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-3 text-sm text-gray-200 dark:text-slate-400">
                    <li><a href="#how-it-works" class="hover:text-[#ed1c24] transition">How It Works</a></li>
                    <li><a href="#benefits" class="hover:text-[#ed1c24] transition">Benefits</a></li>
                    <li><a href="#faq" class="hover:text-[#ed1c24] transition">FAQ</a></li>

                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}" class="hover:text-[#ed1c24] transition">Register</a></li>
                    @endif

                    @if (Route::has('login'))
                        <li><a href="{{ route('login') }}" class="hover:text-[#ed1c24] transition">Login</a></li>
                    @endif
                </ul>
            </div>

            <div>
                <h3 class="font-semibold mb-4">Affiliate Platform</h3>
                <p class="text-sm text-gray-200 dark:text-slate-400 leading-relaxed">
                    Create your affiliate account, get your referral code, monitor performance,
                    and request withdrawals from your dashboard.
                </p>

                <div class="mt-5">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="inline-flex rounded-xl bg-[#ed1c24] px-5 py-3 text-sm font-semibold text-white hover:opacity-90 transition">
                            Become an Affiliate
                        </a>
                    @endif
                </div>
            </div>

        </div>

        <div class="mt-10 flex flex-col items-center justify-between gap-4 border-t border-white/10 pt-6 text-center dark:border-slate-800 md:flex-row md:text-left">
            <p class="text-sm text-gray-200 dark:text-slate-400">
                &copy; {{ date('Y') }} TC Affiliates. All rights reserved.
            </p>

            <p class="text-sm text-gray-200 dark:text-slate-400">
                Empowering Minds. Achieving Excellence.
            </p>
        </div>
    </div>
</footer>
