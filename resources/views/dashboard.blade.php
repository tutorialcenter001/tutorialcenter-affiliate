<x-dashboard-layout title="Dashboard">

    <x-dashboard-header :user="$user" />

    {{-- Stats --}}
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">Total Referrals</p>
            <h2 class="mt-2 text-3xl font-bold text-[#0b3a67] dark:text-white">
                {{ $totalReferrals }}
            </h2>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">Total Earnings</p>
            <h2 class="mt-2 text-3xl font-bold text-[#0b3a67] dark:text-white">
                ₦{{ number_format($totalEarnings, 2) }}
            </h2>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">Available Balance</p>
            <h2 class="mt-2 text-3xl font-bold text-[#ed1c24]">
                ₦{{ number_format($availableBalance, 2) }}
            </h2>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">Total Withdrawn</p>
            <h2 class="mt-2 text-3xl font-bold text-[#0b3a67] dark:text-white">
                ₦{{ number_format($totalWithdrawn, 2) }}
            </h2>
        </div>
    </div>

    {{-- Main Grid --}}
    <div class="mt-8 grid gap-6 xl:grid-cols-3">

        {{-- Referral Activity --}}
        <div class="xl:col-span-2 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="mb-5">
                <h2 class="text-xl font-bold text-[#0b3a67] dark:text-white">
                    Recent Referral Activity
                </h2>
                <p class="text-sm text-gray-500 dark:text-slate-400">
                    Latest users connected to your affiliate code.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 text-gray-500 dark:border-slate-800 dark:text-slate-400">
                            <th class="py-3 pr-4">Name</th>
                            <th class="py-3 pr-4">Email</th>
                            <th class="py-3 pr-4">Status</th>
                            <th class="py-3">Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($recentReferrals as $referral)
                            <tr class="border-b border-gray-100 dark:border-slate-800">
                                <td class="py-4 pr-4 dark:text-white">
                                    {{ $referral->firstname ?? '' }} {{ $referral->surname ?? '' }}
                                </td>
                                <td class="py-4 pr-4 text-gray-500 dark:text-slate-400">
                                    {{ $referral->email ?? '-' }}
                                </td>
                                <td class="py-4 pr-4">
                                    <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                        {{ ucfirst($referral->status ?? 'pending') }}
                                    </span>
                                </td>
                                <td class="py-4 text-gray-500 dark:text-slate-400">
                                    {{ isset($referral->created_at) ? $referral->created_at->format('d M, Y') : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-500 dark:text-slate-400">
                                    No referral activity yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Withdraw --}}
        <div id="withdraw" class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <h2 class="text-xl font-bold text-[#0b3a67] dark:text-white">
                Withdraw Funds
            </h2>

            <p class="mt-2 text-sm text-gray-500 dark:text-slate-400">
                Request withdrawal from your available balance.
            </p>

            <div class="mt-6 rounded-2xl bg-gray-50 p-5 dark:bg-slate-950">
                <p class="text-sm text-gray-500 dark:text-slate-400">Available Balance</p>
                <p class="mt-2 text-3xl font-extrabold text-[#ed1c24]">
                    ₦{{ number_format($availableBalance, 2) }}
                </p>
            </div>

            <form action="#" method="POST" class="mt-6 space-y-4">
                @csrf

                <div>
                    <label class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">
                        Amount
                    </label>
                    <input
                        type="number"
                        name="amount"
                        min="0"
                        step="0.01"
                        placeholder="Enter amount"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                    >
                </div>

                <button type="submit"
                    class="w-full rounded-xl bg-[#ed1c24] py-3.5 font-semibold text-white transition hover:opacity-90">
                    Request Withdrawal
                </button>
            </form>
        </div>
    </div>

    {{-- Account Details --}}
    <div class="mt-8 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <h2 class="text-xl font-bold text-[#0b3a67] dark:text-white">
            Account Details
        </h2>

        <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
            Your registered affiliate information.
        </p>

        <div class="mt-6 grid gap-4 md:grid-cols-3">
            <div class="rounded-xl bg-gray-50 p-4 dark:bg-slate-950">
                <p class="text-xs text-gray-500 dark:text-slate-400">Name</p>
                <p class="mt-1 font-semibold text-[#0b3a67] dark:text-white">
                    {{ $user->firstname }} {{ $user->surname }}
                </p>
            </div>

            <div class="rounded-xl bg-gray-50 p-4 dark:bg-slate-950">
                <p class="text-xs text-gray-500 dark:text-slate-400">Email</p>
                <p class="mt-1 font-semibold text-[#0b3a67] dark:text-white">
                    {{ $user->email }}
                </p>
            </div>

            <div class="rounded-xl bg-gray-50 p-4 dark:bg-slate-950">
                <p class="text-xs text-gray-500 dark:text-slate-400">Phone</p>
                <p class="mt-1 font-semibold text-[#0b3a67] dark:text-white">
                    {{ $user->phone_number ?? 'Not provided' }}
                </p>
            </div>
        </div>
    </div>

</x-dashboard-layout>