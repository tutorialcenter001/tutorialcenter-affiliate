<x-dashboard-layout title="Earnings">

    <x-dashboard-header :user="$user" />

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">Total Earnings</p>
            <h2 class="mt-2 text-3xl font-bold text-[#0b3a67] dark:text-white">
                ₦{{ number_format($totalEarnings, 2) }}
            </h2>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">Pending</p>
            <h2 class="mt-2 text-3xl font-bold text-yellow-600">
                ₦{{ number_format($pendingEarnings, 2) }}
            </h2>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">Approved</p>
            <h2 class="mt-2 text-3xl font-bold text-green-600">
                ₦{{ number_format($approvedEarnings, 2) }}
            </h2>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">Paid</p>
            <h2 class="mt-2 text-3xl font-bold text-[#ed1c24]">
                ₦{{ number_format($paidEarnings, 2) }}
            </h2>
        </div>
    </div>

    <div class="mt-8 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-[#0b3a67] dark:text-white">
                My Earnings
            </h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
                Track commissions earned from your referrals.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-gray-200 text-gray-500 dark:border-slate-800 dark:text-slate-400">
                        <th class="py-3 pr-4">Referral</th>
                        <th class="py-3 pr-4">Contact</th>
                        <th class="py-3 pr-4">Amount</th>
                        <th class="py-3 pr-4">Status</th>
                        <th class="py-3 pr-4">Description</th>
                        <th class="py-3">Date</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($earnings as $earning)
                        <tr class="border-b border-gray-100 dark:border-slate-800">
                            <td class="py-4 pr-4 font-medium text-[#0b3a67] dark:text-white">
                                {{ $earning->referral->name ?? 'N/A' }}
                            </td>

                            <td class="py-4 pr-4 text-gray-500 dark:text-slate-400">
                                {{ $earning->referral->contact ?? 'N/A' }}
                            </td>

                            <td class="py-4 pr-4 font-bold text-[#ed1c24]">
                                ₦{{ number_format($earning->amount, 2) }}
                            </td>

                            <td class="py-4 pr-4">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold
                                    @if($earning->status === 'paid')
                                        bg-blue-100 text-blue-700
                                    @elseif($earning->status === 'approved')
                                        bg-green-100 text-green-700
                                    @elseif($earning->status === 'rejected')
                                        bg-red-100 text-red-700
                                    @else
                                        bg-yellow-100 text-yellow-700
                                    @endif">
                                    {{ ucfirst($earning->status) }}
                                </span>
                            </td>

                            <td class="py-4 pr-4 text-gray-500 dark:text-slate-400">
                                {{ $earning->description ?? '-' }}
                            </td>

                            <td class="py-4 text-gray-500 dark:text-slate-400">
                                {{ $earning->created_at->format('d M, Y h:i A') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-gray-500 dark:text-slate-400">
                                You do not have any earnings yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $earnings->links() }}
        </div>
    </div>

</x-dashboard-layout>