@props(['user'])

<div class="mb-6 rounded-3xl border border-gray-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:mb-8 sm:p-6">
    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

        <div class="min-w-0 flex items-center gap-4">
            <div class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-full bg-[#0b3a67] text-xl font-bold text-white sm:h-16 sm:w-16">
                @if($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile" class="h-full w-full object-cover">
                @else
                    {{ strtoupper(substr($user->firstname, 0, 1)) }}
                @endif
            </div>

            <div class="min-w-0">
                <p class="text-sm text-gray-500 dark:text-slate-400">Welcome back</p>
                <h1 class="break-words text-xl font-extrabold text-[#0b3a67] dark:text-white sm:text-2xl">
                    {{ $user->firstname }} {{ $user->surname }}
                </h1>
                <p class="text-sm text-gray-500 dark:text-slate-400">
                    Manage your affiliate growth and earnings.
                </p>
            </div>
        </div>

        <div class="flex w-full flex-col gap-3 sm:flex-row sm:items-center lg:w-auto">
            <div class="w-full rounded-2xl bg-gray-50 px-4 py-3 dark:bg-slate-950 sm:px-5 lg:w-auto">
                <p class="text-xs text-gray-500 dark:text-slate-400">Referral Code</p>
                <div class="mt-1 flex items-center gap-3">
                    <span id="referralCode" class="min-w-0 break-all font-bold text-[#ed1c24]">
                        {{ $user->referral_code }}
                    </span>

                    <button type="button"
                        onclick="copyReferralCode()"
                        class="shrink-0 rounded-lg bg-[#0b3a67] px-3 py-1 text-xs font-semibold text-white">
                        Copy
                    </button>
                </div>
            </div>

            <a href="#withdraw"
               class="w-full rounded-xl bg-[#ed1c24] px-5 py-3 text-center text-sm font-semibold text-white transition hover:opacity-90 sm:w-auto">
                Withdraw Funds
            </a>
        </div>

    </div>
</div>

<script>
    function copyReferralCode() {
        const code = document.getElementById('referralCode').innerText.trim();
        navigator.clipboard.writeText(code);
        alert('Referral code copied!');
    }
</script>
