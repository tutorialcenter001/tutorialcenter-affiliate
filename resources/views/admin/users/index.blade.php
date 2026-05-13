<x-dashboard-layout title="Users Analytics">

    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-[#0b3a67] dark:text-white">
            Users Analytics
        </h1>

        <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
            View affiliate performance, balances and payouts.
        </p>
    </div>

    {{-- Analytics Summary Cards --}}
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-5">

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">
                Total Referrals
            </p>

            <h3 class="mt-2 text-2xl font-extrabold text-[#0b3a67] dark:text-white">
                {{ number_format($users->sum('total_referrals')) }}
            </h3>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">
                Total Earnings
            </p>

            <h3 class="mt-2 text-2xl font-extrabold text-green-600">
                ₦{{ number_format($users->sum('total_earnings'), 2) }}
            </h3>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">
                Pending Earnings
            </p>

            <h3 class="mt-2 text-2xl font-extrabold text-yellow-600">
                ₦{{ number_format($users->sum('pending_earnings'), 2) }}
            </h3>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">
                Total Paid Out
            </p>

            <h3 class="mt-2 text-2xl font-extrabold text-blue-600">
                ₦{{ number_format($users->sum('paid_withdrawals'), 2) }}
            </h3>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">
                Total Balance
            </p>

            <h3 class="mt-2 text-2xl font-extrabold text-[#ed1c24]">
                ₦{{ number_format($users->sum('available_balance'), 2) }}
            </h3>
        </div>

    </div>

    {{-- Filters & Actions --}}
    <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <form method="GET" action="{{ route('admin.users.index') }}"
            class="flex flex-1 flex-col gap-3 sm:flex-row">

            {{-- Search --}}
            <div class="flex-1">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by name, email or referral code..."
                    class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-900 dark:text-white">
            </div>

            {{-- Filter --}}
            <div class="sm:w-56">
                <select
                    name="filter"
                    class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-900 dark:text-white">

                    <option value="">
                        All Users
                    </option>

                    <option value="high_earners"
                        {{ request('filter') === 'high_earners' ? 'selected' : '' }}>
                        High Earners
                    </option>

                    <option value="pending_withdrawals"
                        {{ request('filter') === 'pending_withdrawals' ? 'selected' : '' }}>
                        Pending Withdrawals
                    </option>

                    <option value="low_balance"
                        {{ request('filter') === 'low_balance' ? 'selected' : '' }}>
                        Low Balance
                    </option>

                </select>
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="rounded-2xl bg-[#0b3a67] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">
                Filter
            </button>

        </form>

        {{-- Export Button --}}
        <a href="{{ route('admin.users.export', request()->query()) }}"
            class="inline-flex items-center justify-center rounded-2xl bg-[#ed1c24] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">
            Export CSV
        </a>

    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-6">

        {{-- Mobile View --}}
        <div class="space-y-4 md:hidden">

            @forelse($users as $user)

            <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-slate-800 dark:bg-slate-950">

                <div class="flex items-start justify-between gap-4">

                    <div>
                        <p class="font-bold text-[#0b3a67] dark:text-white">
                            {{ $user->firstname }} {{ $user->surname }}
                        </p>

                        <p class="break-all text-sm text-gray-500 dark:text-slate-400">
                            {{ $user->email }}
                        </p>
                    </div>

                    <span class="rounded-full bg-[#0b3a67]/10 px-3 py-1 text-xs font-semibold text-[#0b3a67] dark:bg-slate-800 dark:text-white">
                        {{ $user->total_referrals }} Referrals
                    </span>

                </div>

                <div class="mt-5 grid grid-cols-2 gap-4 text-sm">

                    <div>
                        <p class="text-xs text-gray-500">
                            Total Earnings
                        </p>

                        <p class="font-semibold text-green-600">
                            ₦{{ number_format($user->total_earnings, 2) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500">
                            Pending Earnings
                        </p>

                        <p class="font-semibold text-yellow-600">
                            ₦{{ number_format($user->pending_earnings, 2) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500">
                            Paid Out
                        </p>

                        <p class="font-semibold text-blue-600">
                            ₦{{ number_format($user->paid_withdrawals, 2) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500">
                            Pending Withdrawals
                        </p>

                        <p class="font-semibold text-orange-600">
                            ₦{{ number_format($user->pending_withdrawals, 2) }}
                        </p>
                    </div>

                </div>

                <div class="mt-5 border-t border-gray-200 pt-4 dark:border-slate-800">

                    <p class="text-xs text-gray-500">
                        Available Balance
                    </p>

                    <p class="mt-1 text-lg font-bold text-[#ed1c24]">
                        ₦{{ number_format($user->available_balance, 2) }}
                    </p>

                </div>

            </div>

            @empty

            <p class="text-center text-sm text-gray-500 dark:text-slate-400">
                No affiliate users found.
            </p>

            @endforelse

        </div>

        {{-- Desktop View --}}
        <div class="hidden overflow-x-auto md:block">

            <table class="w-full min-w-[90rem] text-left text-sm">

                <thead>
                    <tr class="border-b border-gray-200 text-gray-500 dark:border-slate-800">

                        <th class="py-3 pr-4">
                            Affiliate
                        </th>

                        <th class="py-3 pr-4">
                            Referrals
                        </th>

                        <th class="py-3 pr-4">
                            Total Earnings
                        </th>

                        <th class="py-3 pr-4">
                            Pending Earnings
                        </th>

                        <th class="py-3 pr-4">
                            Paid Out
                        </th>

                        <th class="py-3 pr-4">
                            Pending Withdrawals
                        </th>

                        <th class="py-3">
                            Balance
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse($users as $user)

                    <tr class="border-b border-gray-100 dark:border-slate-800">

                        <td class="py-4 pr-4">

                            <div>
                                <p class="font-semibold text-[#0b3a67] dark:text-white">
                                    {{ $user->firstname }} {{ $user->surname }}
                                </p>

                                <p class="text-sm text-gray-500 dark:text-slate-400">
                                    {{ $user->email }}
                                </p>
                            </div>

                        </td>

                        <td class="py-4 pr-4 font-semibold text-[#0b3a67] dark:text-white">
                            {{ $user->total_referrals }}
                        </td>

                        <td class="py-4 pr-4 font-semibold text-green-600">
                            ₦{{ number_format($user->total_earnings, 2) }}
                        </td>

                        <td class="py-4 pr-4 font-semibold text-yellow-600">
                            ₦{{ number_format($user->pending_earnings, 2) }}
                        </td>

                        <td class="py-4 pr-4 font-semibold text-blue-600">
                            ₦{{ number_format($user->paid_withdrawals, 2) }}
                        </td>

                        <td class="py-4 pr-4 font-semibold text-orange-600">
                            ₦{{ number_format($user->pending_withdrawals, 2) }}
                        </td>

                        <td class="py-4 font-bold text-[#ed1c24]">
                            ₦{{ number_format($user->available_balance, 2) }}
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="py-10 text-center text-gray-500 dark:text-slate-400">
                            No affiliate users found.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>

    </div>

</x-dashboard-layout>