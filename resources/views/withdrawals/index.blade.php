<x-dashboard-layout title="Withdrawals">

    <x-dashboard-header :user="$user" />

    @php
    $withdrawableBalance = $availableBalance - $pendingWithdrawals;
    @endphp

    @if(session('success'))
    <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-700 dark:border-green-900/60 dark:bg-green-950/40 dark:text-green-300">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-semibold text-red-700 dark:border-red-900/60 dark:bg-red-950/40 dark:text-red-300">
        Please correct the errors below.
    </div>
    @endif

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">Approved Earnings</p>
            <h2 class="mt-2 break-words text-3xl font-bold text-[#0b3a67] dark:text-white">
                ₦{{ number_format($availableBalance, 2) }}
            </h2>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">Pending Withdrawals</p>
            <h2 class="mt-2 break-words text-3xl font-bold text-yellow-600">
                ₦{{ number_format($pendingWithdrawals, 2) }}
            </h2>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">Withdrawable Balance</p>
            <h2 class="mt-2 break-words text-3xl font-bold text-[#ed1c24]">
                <!-- ₦{{ number_format($withdrawableBalance, 2) }} -->
                ₦{{ number_format($availableBalance - $totalWithdrawn, 2) }}
            </h2>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm text-gray-500 dark:text-slate-400">Total Withdrawn</p>
            <h2 class="mt-2 break-words text-3xl font-bold text-green-600">
                ₦{{ number_format($totalWithdrawn, 2) }}
            </h2>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 gap-6 xl:grid-cols-3">

        <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-6 xl:col-span-1">
            <h2 class="text-xl font-bold text-[#0b3a67] dark:text-white">
                Request Withdrawal
            </h2>

            <p class="mt-2 text-sm text-gray-500 dark:text-slate-400">
                Submit a withdrawal request from your approved earnings.
            </p>

            @if($bankAccounts->isEmpty())
            <div class="mt-6 rounded-2xl border border-dashed border-gray-300 p-6 text-center dark:border-slate-700">
                <p class="text-sm text-gray-500 dark:text-slate-400">
                    You need to add a bank account before requesting a withdrawal.
                </p>

                @if(Route::has('profile.index'))
                <a href="{{ route('profile.index') }}"
                    class="mt-4 inline-flex rounded-xl bg-[#ed1c24] px-5 py-3 text-sm font-semibold text-white">
                    Add Bank Account
                </a>
                @endif
            </div>
            @else
            <form method="POST" action="{{ route('withdrawals.store') }}" class="mt-6 space-y-5">
                @csrf

                <div>
                    <label class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">
                        Bank Account
                    </label>

                    <select
                        name="bank_account_id"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                        <option value="">Select bank account</option>
                        @foreach($bankAccounts as $account)
                        <option value="{{ $account->id }}" @selected(old('bank_account_id')==$account->id)>
                            {{ $account->bank_name }} - {{ $account->account_number }}
                        </option>
                        @endforeach
                    </select>

                    @error('bank_account_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">
                        Amount
                    </label>

                    <input
                        type="number"
                        name="amount"
                        min="100"
                        max="{{ $availableBalance - $totalWithdrawn }}"
                        step="0.01"
                        value="{{ old('amount') }}"
                        placeholder="Enter amount"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                    @error('amount')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- <p class="mt-2 text-xs text-gray-500 dark:text-slate-400">
                            Minimum withdrawal: ₦100.00
                        </p> -->
                    <p class="mt-2 text-xs text-gray-500 dark:text-slate-400">
                        Minimum withdrawal: ₦100.00. Maximum available: ₦{{ number_format($availableBalance - $totalWithdrawn, 2) }}.
                    </p>
                </div>

                <button
                    type="submit"
                    class="w-full rounded-xl bg-[#ed1c24] py-3.5 font-semibold text-white transition hover:opacity-90 disabled:cursor-not-allowed disabled:opacity-60"
                    {{ $withdrawableBalance < 100 ? 'disabled' : '' }}>
                    Submit Withdrawal
                </button>
            </form>
            @endif
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-6 xl:col-span-2">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-[#0b3a67] dark:text-white">
                    Withdrawal History
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
                    Track all your withdrawal requests.
                </p>
            </div>

            <div class="space-y-4 md:hidden">
                @forelse($withdrawals as $withdrawal)
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-slate-800 dark:bg-slate-950">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-2xl font-extrabold text-[#ed1c24]">
                                ₦{{ number_format($withdrawal->amount, 2) }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
                                {{ $withdrawal->bankAccount->bank_name ?? 'N/A' }}
                            </p>
                        </div>

                        <span class="shrink-0 rounded-full px-3 py-1 text-xs font-semibold
                                @if($withdrawal->status === 'paid')
                                    bg-green-100 text-green-700
                                @elseif($withdrawal->status === 'approved')
                                    bg-blue-100 text-blue-700
                                @elseif($withdrawal->status === 'rejected')
                                    bg-red-100 text-red-700
                                @else
                                    bg-yellow-100 text-yellow-700
                                @endif">
                            {{ ucfirst($withdrawal->status) }}
                        </span>
                    </div>

                    <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-slate-400">Account</p>
                            <p class="font-semibold text-[#0b3a67] dark:text-white">
                                {{ $withdrawal->bankAccount->account_number ?? 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 dark:text-slate-400">Date</p>
                            <p class="font-semibold text-[#0b3a67] dark:text-white">
                                {{ $withdrawal->created_at->format('d M, Y') }}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="rounded-2xl border border-dashed border-gray-300 p-8 text-center dark:border-slate-700">
                    <p class="text-sm text-gray-500 dark:text-slate-400">
                        No withdrawal requests yet.
                    </p>
                </div>
                @endforelse
            </div>

            <div class="hidden overflow-x-auto md:block">
                <table class="w-full min-w-[56rem] text-left text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 text-gray-500 dark:border-slate-800 dark:text-slate-400">
                            <th class="py-3 pr-4">Amount</th>
                            <th class="py-3 pr-4">Bank</th>
                            <th class="py-3 pr-4">Account Number</th>
                            <th class="py-3 pr-4">Method</th>
                            <th class="py-3 pr-4">Status</th>
                            <th class="py-3">Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($withdrawals as $withdrawal)
                        <tr class="border-b border-gray-100 dark:border-slate-800">
                            <td class="py-4 pr-4 font-bold text-[#ed1c24]">
                                ₦{{ number_format($withdrawal->amount, 2) }}
                            </td>

                            <td class="py-4 pr-4 text-gray-500 dark:text-slate-400">
                                {{ $withdrawal->bankAccount->bank_name ?? 'N/A' }}
                            </td>

                            <td class="py-4 pr-4 font-semibold text-[#0b3a67] dark:text-white">
                                {{ $withdrawal->bankAccount->account_number ?? 'N/A' }}
                            </td>

                            <td class="py-4 pr-4 text-gray-500 dark:text-slate-400">
                                {{ ucwords(str_replace('_', ' ', $withdrawal->payment_method)) }}
                            </td>

                            <td class="py-4 pr-4">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold
                                        @if($withdrawal->status === 'paid')
                                            bg-green-100 text-green-700
                                        @elseif($withdrawal->status === 'approved')
                                            bg-blue-100 text-blue-700
                                        @elseif($withdrawal->status === 'rejected')
                                            bg-red-100 text-red-700
                                        @else
                                            bg-yellow-100 text-yellow-700
                                        @endif">
                                    {{ ucfirst($withdrawal->status) }}
                                </span>
                            </td>

                            <td class="py-4 text-gray-500 dark:text-slate-400">
                                {{ $withdrawal->created_at->format('d M, Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-gray-500 dark:text-slate-400">
                                No withdrawal requests yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $withdrawals->links() }}
            </div>
        </div>
    </div>

</x-dashboard-layout>