<header class="sticky top-0 z-50 border-b border-gray-200 bg-white/90 backdrop-blur dark:border-slate-800 dark:bg-slate-950/90">
    @php
        $pageTitle = $title ?? 'TC Affiliates';
    @endphp

    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">

            <div class="flex items-center gap-4">
                <a href="{{ route('welcome') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/tc-logo.png') }}" alt="TC Logo" class="h-10 w-auto">
                </a>

                <div class="hidden sm:block">
                    <h1 class="text-lg font-bold text-[#0b3a67] dark:text-white">
                        {{ $pageTitle }}
                    </h1>
                    <p class="text-xs text-gray-500 dark:text-slate-400">
                        TC Affiliates
                    </p>
                </div>
            </div>

            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold text-[#0b3a67] dark:text-slate-200">
                <a href="{{ route('welcome') }}#how-it-works" class="hover:text-[#ed1c24] transition">How It Works</a>
                <a href="{{ route('welcome') }}#benefits" class="hover:text-[#ed1c24] transition">Benefits</a>
                <a href="{{ route('welcome') }}#faq" class="hover:text-[#ed1c24] transition">FAQ</a>
            </nav>

            <div class="flex items-center gap-3">

                <button
                    type="button"
                    id="themeToggle"
                    class="h-10 w-10 flex items-center justify-center rounded-xl border border-gray-200 text-[#0b3a67] hover:bg-gray-100 dark:border-slate-700 dark:text-white dark:hover:bg-slate-800"
                    aria-label="Toggle dark mode"
                >
                    <svg class="h-5 w-5 hidden dark:block text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 3v1m0 16v1m8.66-9h-1M4.34 12h-1m15.36 6.36l-.7-.7M6.34 6.34l-.7-.7m12.02 0l-.7.7M6.34 17.66l-.7.7M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>

                    <svg class="h-5 w-5 block dark:hidden text-[#0b3a67]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 12.79A9 9 0 1111.21 3c0 .34 0 .67.05 1A7 7 0 0021 12.79z" />
                    </svg>
                </button>

                @if (Route::has('login'))
                    <a href="{{ route('login') }}"
                       class="hidden sm:inline text-[#0b3a67] dark:text-slate-200 font-semibold hover:text-[#ed1c24] transition">
                        Login
                    </a>
                @endif

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="hidden sm:inline bg-[#ed1c24] text-white px-4 py-2 rounded-xl font-semibold hover:opacity-90 transition">
                        Register
                    </a>
                @endif

                <button
                    type="button"
                    id="mobileMenuButton"
                    class="lg:hidden h-10 w-10 flex items-center justify-center rounded-xl border border-gray-200 text-[#0b3a67] hover:bg-gray-100 dark:border-slate-700 dark:text-white dark:hover:bg-slate-800"
                    aria-label="Open menu"
                >
                    ☰
                </button>
            </div>
        </div>

        <div id="mobileMenu" class="hidden lg:hidden pb-6">
            <div class="space-y-2 pt-4 border-t border-gray-200 dark:border-slate-800">
                <a href="{{ route('welcome') }}#how-it-works" class="block rounded-xl px-4 py-3 text-sm font-semibold text-[#0b3a67] hover:bg-gray-100 dark:text-slate-200 dark:hover:bg-slate-800">
                    How It Works
                </a>

                <a href="{{ route('welcome') }}#benefits" class="block rounded-xl px-4 py-3 text-sm font-semibold text-[#0b3a67] hover:bg-gray-100 dark:text-slate-200 dark:hover:bg-slate-800">
                    Benefits
                </a>

                <a href="{{ route('welcome') }}#faq" class="block rounded-xl px-4 py-3 text-sm font-semibold text-[#0b3a67] hover:bg-gray-100 dark:text-slate-200 dark:hover:bg-slate-800">
                    FAQ
                </a>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-4">
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}"
                           class="rounded-xl border border-[#0b3a67] px-5 py-3 text-center text-sm font-semibold text-[#0b3a67] hover:bg-[#0b3a67] hover:text-white dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-800 transition">
                            Login
                        </a>
                    @endif

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="rounded-xl bg-[#ed1c24] px-5 py-3 text-center text-sm font-semibold text-white hover:opacity-90 transition">
                            Register
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>