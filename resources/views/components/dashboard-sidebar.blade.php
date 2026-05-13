<aside class="fixed inset-y-0 left-0 z-40 hidden w-72 flex-col bg-[#0b3a67] text-white lg:flex">
    <div class="border-b border-white/10 px-8 py-7">
        <img src="{{ asset('images/tc-logo.png') }}" alt="TC Logo" class="mb-4 w-32 rounded">

        <h2 class="text-xl font-bold">TC Affiliates</h2>
        <p class="mt-1 text-sm text-gray-200">Partner Dashboard</p>
    </div>

    <nav class="flex-1 space-y-2 px-5 py-7">

        @if(auth()->user()->role === 'admin')

        <a href="{{ route('admin.dashboard') }}"
            class="block rounded-xl px-4 py-3 transition
            {{ request()->routeIs('admin.dashboard') 
                ? 'bg-white/10 font-semibold text-white' 
                : 'text-gray-200 hover:bg-white/10' }}">
            Overview
        </a>

        <a href="{{ route('admin.users.index') }}"
            class="block rounded-xl px-4 py-3 transition
            {{ request()->routeIs('admin.users.*') 
                ? 'bg-white/10 font-semibold text-white' 
                : 'text-gray-200 hover:bg-white/10' }}">
            Users Analytics
        </a>

        <a href="{{ route('admin.withdrawals.index') }}"
            class="block rounded-xl px-4 py-3 transition
            {{ request()->routeIs('admin.withdrawals.*') 
                ? 'bg-white/10 font-semibold text-white' 
                : 'text-gray-200 hover:bg-white/10' }}">
            Withdrawals Request
        </a>

        @endif

        <a href="{{ route('dashboard') }}"
            class="block rounded-xl px-4 py-3 transition
            {{ request()->routeIs('dashboard') 
                ? 'bg-white/10 font-semibold text-white' 
                : 'text-gray-200 hover:bg-white/10' }}">
            Dashboard
        </a>

        <a href="{{ route('referrals.index') }}"
            class="block rounded-xl px-4 py-3 transition
            {{ request()->routeIs('referrals.*') 
                ? 'bg-white/10 font-semibold text-white' 
                : 'text-gray-200 hover:bg-white/10' }}">
            Referrals
        </a>

        <a href="{{ route('earnings.index') }}"
            class="block rounded-xl px-4 py-3 transition
            {{ request()->routeIs('earnings.*') 
                ? 'bg-white/10 font-semibold text-white' 
                : 'text-gray-200 hover:bg-white/10' }}">
            Earnings
        </a>

        <a href="{{ route('withdrawals.index') }}"
            class="block rounded-xl px-4 py-3 transition
            {{ request()->routeIs('withdrawals.*') 
                ? 'bg-white/10 font-semibold text-white' 
                : 'text-gray-200 hover:bg-white/10' }}">
            Withdrawals
        </a>

        <a href="{{ route('profile.show') }}"
            class="block rounded-xl px-4 py-3 transition
            {{ request()->routeIs('profile.*') 
                ? 'bg-white/10 font-semibold text-white' 
                : 'text-gray-200 hover:bg-white/10' }}">
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
</aside>