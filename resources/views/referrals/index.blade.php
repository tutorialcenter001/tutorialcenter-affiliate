<x-dashboard-layout title="Referrals">

    <x-dashboard-header :user="$user" />

    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-[#0b3a67] dark:text-white">
                    My Referrals
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
                    People registered through your referral code.
                </p>
            </div>

            <div class="rounded-xl bg-gray-50 px-4 py-3 dark:bg-slate-950">
                <p class="text-xs text-gray-500 dark:text-slate-400">Referral Code</p>
                <p class="font-bold text-[#ed1c24]">{{ $user->referral_code }}</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
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
                    @forelse($referrals as $referral)
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

        <div class="mt-6">
            {{ $referrals->links() }}
        </div>
    </div>

</x-dashboard-layout>