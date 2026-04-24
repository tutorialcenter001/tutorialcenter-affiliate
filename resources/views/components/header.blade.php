<header class="sticky top-0 z-50 border-b border-gray-200 bg-white/90 backdrop-blur dark:border-slate-800 dark:bg-slate-950/90">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">

            <!-- Logo -->
            <a href="{{ route('welcome') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/tc-logo.png') }}" alt="TC Logo" class="h-12 w-auto">

                <div>
                    <h1 class="text-lg font-bold text-[#0b3a67] dark:text-white">
                        TC Affiliates
                    </h1>
                    <p class="text-xs text-gray-500 dark:text-slate-400">
                        Affiliate Partner Platform
                    </p>
                </div>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold text-[#0b3a67] dark:text-slate-200">
                <a href="#how-it-works" class="hover:text-[#ed1c24] transition">How It Works</a>
                <a href="#benefits" class="hover:text-[#ed1c24] transition">Benefits</a>
                <a href="#faq" class="hover:text-[#ed1c24] transition">FAQ</a>
            </nav>

            <!-- Desktop Actions -->
            <div class="hidden lg:flex items-center gap-3">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}"
                       class="font-semibold text-[#0b3a67] hover:text-[#ed1c24] dark:text-slate-200 dark:hover:text-[#ed1c24] transition">
                        Login
                    </a>
                @endif

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="rounded-xl bg-[#ed1c24] px-5 py-2.5 text-sm font-semibold text-white hover:opacity-90 transition">
                        Become an Affiliate
                    </a>
                @endif
            </div>

            <!-- Mobile Button -->
            <button
                type="button"
                id="mobileMenuButton"
                class="lg:hidden inline-flex h-11 w-11 items-center justify-center rounded-xl border border-gray-200 text-[#0b3a67] hover:bg-gray-100 dark:border-slate-700 dark:text-white dark:hover:bg-slate-800"
                aria-label="Open menu"
                aria-expanded="false"
            >
                <svg id="menuIcon" class="h-6 w-6 block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>

                <svg id="closeIcon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden lg:hidden pb-6">
            <nav class="space-y-2 border-t border-gray-200 pt-5 dark:border-slate-800">
                <a href="#how-it-works"
                   class="block rounded-xl px-4 py-3 text-sm font-semibold text-[#0b3a67] hover:bg-gray-100 dark:text-slate-200 dark:hover:bg-slate-800">
                    How It Works
                </a>

                <a href="#benefits"
                   class="block rounded-xl px-4 py-3 text-sm font-semibold text-[#0b3a67] hover:bg-gray-100 dark:text-slate-200 dark:hover:bg-slate-800">
                    Benefits
                </a>

                <a href="#faq"
                   class="block rounded-xl px-4 py-3 text-sm font-semibold text-[#0b3a67] hover:bg-gray-100 dark:text-slate-200 dark:hover:bg-slate-800">
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
                            Become an Affiliate
                        </a>
                    @endif
                </div>
            </nav>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('mobileMenuButton');
        const menu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');
        const closeIcon = document.getElementById('closeIcon');

        if (!button || !menu) return;

        button.addEventListener('click', function () {
            const isOpen = !menu.classList.contains('hidden');

            menu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');

            button.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
        });
    });
</script>