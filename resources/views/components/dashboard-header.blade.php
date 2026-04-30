@props(['user'])

<div class="mb-8 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

        <div class="flex items-center gap-4">
            <div class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-full bg-[#0b3a67] text-xl font-bold text-white">
                @if($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile" class="h-full w-full object-cover">
                @else
                    {{ strtoupper(substr($user->firstname, 0, 1)) }}
                @endif
            </div>

            <div>
                <p class="text-sm text-gray-500 dark:text-slate-400">Welcome back</p>
                <h1 class="text-2xl font-extrabold text-[#0b3a67] dark:text-white">
                    {{ $user->firstname }} {{ $user->surname }}
                </h1>
                <p class="text-sm text-gray-500 dark:text-slate-400">
                    Manage your affiliate growth and earnings.
                </p>
            </div>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <div class="rounded-2xl bg-gray-50 px-5 py-3 dark:bg-slate-950">
                <p class="text-xs text-gray-500 dark:text-slate-400">Referral Code</p>
                <div class="mt-1 flex items-center gap-3">
                    <span id="referralCode" class="font-bold text-[#ed1c24]">
                        {{ $user->referral_code }}
                    </span>

                    <button type="button"
                        onclick="copyReferralCode()"
                        class="rounded-lg bg-[#0b3a67] px-3 py-1 text-xs font-semibold text-white">
                        Copy
                    </button>
                </div>
            </div>

            <a href="#withdraw"
               class="rounded-xl bg-[#ed1c24] px-5 py-3 text-center text-sm font-semibold text-white transition hover:opacity-90">
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