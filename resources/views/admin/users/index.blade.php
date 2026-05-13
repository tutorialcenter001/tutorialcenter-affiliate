<x-dashboard-layout title="Users Analytics">

    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-[#0b3a67] dark:text-white">
            Users Analytics
        </h1>

        <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
            View affiliate performance, balances and payouts.
        </p>
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