<x-dashboard-layout title="Pending Affiliates">

    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-[#0b3a67] dark:text-white">
            Pending Affiliates
        </h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
            Affiliates who have not verified their email.
        </p>
    </div>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @forelse($affiliates as $affiliate)
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <p class="font-bold text-[#0b3a67] dark:text-white">
                    {{ $affiliate->firstname }} {{ $affiliate->surname }}
                </p>
                <p class="mt-1 break-all text-sm text-gray-500 dark:text-slate-400">
                    {{ $affiliate->email }}
                </p>
                <p class="mt-3 font-semibold text-[#ed1c24]">
                    {{ $affiliate->referral_code }}
                </p>
                <p class="mt-3 text-xs text-gray-500 dark:text-slate-400">
                    Registered: {{ $affiliate->created_at->format('d M, Y') }}
                </p>
            </div>
        @empty
            <div class="rounded-2xl border border-dashed border-gray-300 p-8 text-center dark:border-slate-700">
                <p class="text-sm text-gray-500 dark:text-slate-400">
                    No pending affiliates.
                </p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $affiliates->links() }}
    </div>

</x-dashboard-layout>