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
            @if(auth()->user()->role === 'admin')

            <a href="{{ route('admin.dashboard') }}"
                class="block rounded-xl px-4 py-3 text-sm font-semibold transition
                {{ request()->routeIs('admin.dashboard')
                    ? 'bg-[#0b3a67] text-white'
                    : 'text-[#0b3a67] hover:bg-gray-100 dark:text-white dark:hover:bg-slate-800' }}">
                Admin Dashboard
            </a>

            <a href="{{ route('admin.users.index') }}"
                class="block rounded-xl px-4 py-3 text-sm font-semibold transition
                {{ request()->routeIs('admin.users.*')
                    ? 'bg-[#0b3a67] text-white'
                    : 'text-[#0b3a67] hover:bg-gray-100 dark:text-white dark:hover:bg-slate-800' }}">
                Users Analytics
            </a>

            <a href="{{ route('admin.withdrawals.index') }}"
                class="block rounded-xl px-4 py-3 text-sm font-semibold transition
                {{ request()->routeIs('admin.withdrawals.*')
                    ? 'bg-[#0b3a67] text-white'
                    : 'text-[#0b3a67] hover:bg-gray-100 dark:text-white dark:hover:bg-slate-800' }}">
                All Withdrawals Request
            </a>

            @elseif(auth()->user()->role === 'affiliate')

            <a href="{{ route('dashboard') }}"
                class="block rounded-xl px-4 py-3 text-sm font-semibold transition
                {{ request()->routeIs('dashboard')
                    ? 'bg-[#0b3a67] text-white'
                    : 'text-[#0b3a67] hover:bg-gray-100 dark:text-white dark:hover:bg-slate-800' }}">
                Dashboard
            </a>

            <a href="{{ route('referrals.index') }}"
                class="block rounded-xl px-4 py-3 text-sm font-semibold transition
                {{ request()->routeIs('referrals.*')
                    ? 'bg-[#0b3a67] text-white'
                    : 'text-[#0b3a67] hover:bg-gray-100 dark:text-white dark:hover:bg-slate-800' }}">
                Referrals
            </a>

            <a href="{{ route('earnings.index') }}"
                class="block rounded-xl px-4 py-3 text-sm font-semibold transition
                {{ request()->routeIs('earnings.*')
                    ? 'bg-[#0b3a67] text-white'
                    : 'text-[#0b3a67] hover:bg-gray-100 dark:text-white dark:hover:bg-slate-800' }}">
                Earnings
            </a>

            <a href="{{ route('withdrawals.index') }}"
                class="block rounded-xl px-4 py-3 text-sm font-semibold transition
                {{ request()->routeIs('withdrawals.*')
                    ? 'bg-[#0b3a67] text-white'
                    : 'text-[#0b3a67] hover:bg-gray-100 dark:text-white dark:hover:bg-slate-800' }}">
                Withdrawals
            </a>
            @endif

            <a href="{{ route('profile.show') }}"
                class="block rounded-xl px-4 py-3 text-sm font-semibold transition
                {{ request()->routeIs('profile.*')
                    ? 'bg-[#0b3a67] text-white'
                    : 'text-[#0b3a67] hover:bg-gray-100 dark:text-white dark:hover:bg-slate-800' }}">
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