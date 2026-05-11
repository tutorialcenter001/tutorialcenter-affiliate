<x-dashboard-layout title="Dashboard">

    <x-dashboard-header :user="$user" />

    {{-- Stats --}}
    <div class="grid gap-4 sm:gap-6 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-6">
            <p class="text-sm text-gray-500 dark:text-slate-400">Total Referrals</p>
            <h2 class="mt-2 break-words text-2xl font-bold text-[#0b3a67] dark:text-white sm:text-3xl">
                {{ $totalReferrals }}
            </h2>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-6">
            <p class="text-sm text-gray-500 dark:text-slate-400">Total Earnings</p>
            <h2 class="mt-2 break-words text-2xl font-bold text-[#0b3a67] dark:text-white sm:text-3xl">
                ₦{{ number_format($totalEarnings, 2) }}
            </h2>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-6">
            <p class="text-sm text-gray-500 dark:text-slate-400">Available Balance</p>
            <h2 class="mt-2 break-words text-2xl font-bold text-[#ed1c24] sm:text-3xl">
                ₦{{ number_format($availableBalance, 2) }}
            </h2>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-6">
            <p class="text-sm text-gray-500 dark:text-slate-400">Total Withdrawn</p>
            <h2 class="mt-2 break-words text-2xl font-bold text-[#0b3a67] dark:text-white sm:text-3xl">
                ₦{{ number_format($totalWithdrawn, 2) }}
            </h2>
        </div>
    </div>

    {{-- Main Grid --}}
    <div class="mt-8 rounded-2xl border border-gray-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-6">

        {{-- Referral Activity --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-6 xl:col-span-2">

            <div class="mb-5">
                <h2 class="text-xl font-bold text-[#0b3a67] dark:text-white">
                    Recent Referral Activity
                </h2>
                <p class="text-sm text-gray-500 dark:text-slate-400">
                    Latest users connected to your affiliate code.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-[54rem] w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 text-gray-500 dark:border-slate-800 dark:text-slate-400">
                            <th class="py-3 pr-4">Name</th>
                            <th class="py-3 pr-4">Contact</th>
                            <th class="py-3 pr-4">Referral Code</th>
                            <th class="py-3 pr-4">Status</th>
                            <th class="py-3">Referred At</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($recentReferrals as $referral)
                        <tr class="border-b border-gray-100 dark:border-slate-800">
                            <td class="py-4 pr-4 font-medium text-[#0b3a67] dark:text-white">
                                {{ $referral->name ?? 'N/A' }}
                            </td>

                            <td class="py-4 pr-4 text-gray-500 dark:text-slate-400">
                                {{ $referral->contact ?? 'N/A' }}
                            </td>

                            <td class="py-4 pr-4 font-semibold text-[#ed1c24]">
                                {{ $referral->referral_code }}
                            </td>

                            <td class="py-4 pr-4">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold
                                    {{ $referral->status === 'converted'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($referral->status) }}
                                </span>
                            </td>

                            <td class="py-4 text-gray-500 dark:text-slate-400">
                                {{ $referral->referred_at ? $referral->referred_at->format('d M, Y h:i A') : $referral->created_at->format('d M, Y h:i A') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center text-gray-500 dark:text-slate-400">
                                You do not have any referrals yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Account Details --}}
    <div class="mt-8 rounded-2xl border border-gray-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-6">
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