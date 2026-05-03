<x-dashboard-layout title="All Referrals">

    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-[#0b3a67] dark:text-white">
            All Referrals
        </h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
            View referrals submitted by all affiliates.
        </p>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-6">

        <div class="space-y-4 md:hidden">
            @forelse($referrals as $referral)
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-slate-800 dark:bg-slate-950">
                    <p class="font-bold text-[#0b3a67] dark:text-white">
                        {{ $referral->name ?? 'N/A' }}
                    </p>
                    <p class="break-all text-sm text-gray-500 dark:text-slate-400">
                        {{ $referral->contact ?? 'N/A' }}
                    </p>

                    <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-xs text-gray-500">Affiliate</p>
                            <p class="font-semibold text-[#0b3a67] dark:text-white">
                                {{ $referral->user->firstname ?? '' }} {{ $referral->user->surname ?? '' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500">Code</p>
                            <p class="font-semibold text-[#ed1c24]">
                                {{ $referral->referral_code }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-sm text-gray-500 dark:text-slate-400">
                    No referrals found.
                </p>
            @endforelse
        </div>

        <div class="hidden overflow-x-auto md:block">
            <table class="w-full min-w-[60rem] text-left text-sm">
                <thead>
                    <tr class="border-b border-gray-200 text-gray-500 dark:border-slate-800">
                        <th class="py-3 pr-4">Referral Name</th>
                        <th class="py-3 pr-4">Contact</th>
                        <th class="py-3 pr-4">Affiliate</th>
                        <th class="py-3 pr-4">Referral Code</th>
                        <th class="py-3 pr-4">Status</th>
                        <th class="py-3">Date</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($referrals as $referral)
                        <tr class="border-b border-gray-100 dark:border-slate-800">
                            <td class="py-4 pr-4 font-medium text-[#0b3a67] dark:text-white">
                                {{ $referral->name ?? 'N/A' }}
                            </td>
                            <td class="py-4 pr-4 break-all text-gray-500 dark:text-slate-400">
                                {{ $referral->contact ?? 'N/A' }}
                            </td>
                            <td class="py-4 pr-4 text-gray-500 dark:text-slate-400">
                                {{ $referral->user->firstname ?? '' }} {{ $referral->user->surname ?? '' }}
                            </td>
                            <td class="py-4 pr-4 font-semibold text-[#ed1c24]">
                                {{ $referral->referral_code }}
                            </td>
                            <td class="py-4 pr-4">
                                <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                    {{ ucfirst($referral->status) }}
                                </span>
                            </td>
                            <td class="py-4 text-gray-500 dark:text-slate-400">
                                {{ $referral->created_at->format('d M, Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-gray-500 dark:text-slate-400">
                                No referrals found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $referrals->links() }}
        </div>
    </div>

</x-dashboard-layout>