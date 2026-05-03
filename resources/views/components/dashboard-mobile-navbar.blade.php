<div class="sticky top-0 z-50 border-b border-gray-200 bg-white px-3 py-3 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:px-4 lg:hidden">
    <div class="flex items-center justify-between">
        <div class="min-w-0 flex items-center gap-3">
            <img src="{{ asset('images/tc-logo.png') }}" alt="TC Logo" class="h-10 w-auto shrink-0">

            <div class="min-w-0">
                <h1 class="truncate text-sm font-bold text-[#0b3a67] dark:text-white">
                    TC Affiliates
                </h1>
                <p class="truncate text-xs text-gray-500 dark:text-slate-400">
                    Dashboard
                </p>
            </div>
        </div>

        <button
            id="mobileDashboardMenuBtn"
            type="button"
            class="shrink-0 rounded-xl border border-gray-200 px-3 py-2 text-[#0b3a67] dark:border-slate-700 dark:text-white">
            ☰
        </button>
    </div>

    <div id="mobileDashboardMenu" class="hidden max-h-[calc(100vh-5rem)] overflow-y-auto pt-4">
        <nav class="space-y-2">
            <a href="{{ route('dashboard') }}" class="block rounded-xl bg-[#0b3a67] px-4 py-3 text-sm font-semibold text-white">
                Dashboard
            </a>

            <a href="{{ route('referrals.index') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-[#0b3a67] dark:text-white">
                Referrals
            </a>

            <a href="{{ route('earnings.index') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-[#0b3a67] dark:text-white">
                Earnings
            </a>

            <a href="#" class="block rounded-xl px-4 py-3 text-sm font-semibold text-[#0b3a67] dark:text-white">
                Withdrawals
            </a>

            <a href="{{ route('profile.show') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-[#0b3a67] dark:text-white">
                Profile
            </a>
        </nav>
        <div class="border-t border-white/10 p-5">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="w-full rounded-xl bg-[#ed1c24] py-3 font-semibold text-white transition hover:opacity-90">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('mobileDashboardMenuBtn')?.addEventListener('click', function() {
        document.getElementById('mobileDashboardMenu')?.classList.toggle('hidden');
    });
</script>
