<x-dashboard-layout title="All Referrals">

    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-[#0b3a67] dark:text-white">
            All Referrals
        </h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
            View referrals submitted by all affiliates.
        </p>
    </div>

    {{-- Filters & Actions --}}
    <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <form method="GET" action="{{ route('admin.referrals.index') }}"
            class="flex flex-1 flex-col gap-3 sm:flex-row">

            {{-- Search --}}
            <div class="flex-1">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search referrals, contacts, affiliates..."
                    class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-900 dark:text-white">
            </div>

            {{-- Status Filter --}}
            <div class="sm:w-52">
                <select
                    name="status"
                    class="w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm outline-none transition focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-900 dark:text-white">

                    <option value="">
                        All Statuses
                    </option>

                    <option value="pending"
                        {{ request('status') === 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="approved"
                        {{ request('status') === 'approved' ? 'selected' : '' }}>
                        Approved
                    </option>

                    <option value="declined"
                        {{ request('status') === 'declined' ? 'selected' : '' }}>
                        Declined
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
        <a href="{{ route('admin.referrals.export', request()->query()) }}"
            class="inline-flex items-center justify-center rounded-2xl bg-[#ed1c24] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-90">
            Export CSV
        </a>

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