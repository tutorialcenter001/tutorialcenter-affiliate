<x-dashboard-layout title="Admin Dashboard">

    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-[#0b3a67] dark:text-white">
            Admin Dashboard
        </h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
            Monitor affiliates, referrals, and withdrawal requests.
        </p>
    </div>

    <div class="grid gap-6 md:grid-cols-3">
        <a href="{{ route('admin.referrals.index') }}"
           class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">Total Referrals</p>
            <h2 class="mt-2 text-3xl font-bold text-[#0b3a67] dark:text-white">
                {{ $totalReferrals }}
            </h2>
        </a>

        <a href="{{ route('admin.affiliates.pending') }}"
           class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">Pending Affiliates</p>
            <h2 class="mt-2 text-3xl font-bold text-yellow-600">
                {{ $pendingAffiliatesCount }}
            </h2>
        </a>

        <a href="{{ route('admin.withdrawals.index') }}"
           class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">Pending Withdrawals</p>
            <h2 class="mt-2 text-3xl font-bold text-[#ed1c24]">
                {{ $pendingWithdrawalsCount }}
            </h2>
        </a>
    </div>

    <div class="mt-8 grid gap-6 xl:grid-cols-2">

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="mb-5 flex items-center justify-between">
                <h2 class="text-xl font-bold text-[#0b3a67] dark:text-white">
                    Pending Affiliates
                </h2>

                <a href="{{ route('admin.affiliates.pending') }}" class="text-sm font-semibold text-[#ed1c24]">
                    View All
                </a>
            </div>

            <div class="space-y-4">
                @forelse($pendingAffiliates as $affiliate)
                    <div class="rounded-xl bg-gray-50 p-4 dark:bg-slate-950">
                        <p class="font-bold text-[#0b3a67] dark:text-white">
                            {{ $affiliate->firstname }} {{ $affiliate->surname }}
                        </p>
                        <p class="break-all text-sm text-gray-500 dark:text-slate-400">
                            {{ $affiliate->email }}
                        </p>
                        <p class="mt-1 text-sm font-semibold text-[#ed1c24]">
                            {{ $affiliate->referral_code }}
                        </p>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 dark:text-slate-400">
                        No pending affiliates.
                    </p>
                @endforelse
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="mb-5 flex items-center justify-between">
                <h2 class="text-xl font-bold text-[#0b3a67] dark:text-white">
                    Withdrawal Requests
                </h2>

                <a href="{{ route('admin.withdrawals.index') }}" class="text-sm font-semibold text-[#ed1c24]">
                    View All
                </a>
            </div>

            <div class="space-y-4">
                @forelse($pendingWithdrawals as $withdrawal)
                    <div class="rounded-xl bg-gray-50 p-4 dark:bg-slate-950">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-bold text-[#0b3a67] dark:text-white">
                                    {{ $withdrawal->user->firstname ?? '' }} {{ $withdrawal->user->surname ?? '' }}
                                </p>
                                <p class="text-sm text-gray-500 dark:text-slate-400">
                                    {{ $withdrawal->bankAccount->bank_name ?? 'No bank' }}
                                </p>
                            </div>

                            <p class="font-extrabold text-[#ed1c24]">
                                ₦{{ number_format($withdrawal->amount, 2) }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 dark:text-slate-400">
                        No pending withdrawals.
                    </p>
                @endforelse
            </div>
        </div>
    </div>

</x-dashboard-layout>