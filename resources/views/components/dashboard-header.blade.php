@props(['user'])

<div class="mb-6 rounded-3xl border border-gray-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:mb-8 sm:p-6">

    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

        {{-- User Profile --}}
        <div class="min-w-0 flex items-center gap-4">

            <div class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-full bg-[#0b3a67] text-xl font-bold text-white sm:h-16 sm:w-16">

                @if($user->profile_picture)

                <img
                    src="{{ asset('storage/' . $user->profile_picture) }}"
                    alt="Profile"
                    class="h-full w-full object-cover">

                @else

                {{ strtoupper(substr($user->firstname, 0, 1)) }}

                @endif

            </div>

            <div class="min-w-0">

                <p class="text-sm text-gray-500 dark:text-slate-400">
                    Welcome back
                </p>

                <h1 class="break-words text-xl font-extrabold text-[#0b3a67] dark:text-white sm:text-2xl">
                    {{ $user->firstname }} {{ $user->surname }}
                </h1>

                <p class="text-sm text-gray-500 dark:text-slate-400">
                    Manage your affiliate growth and earnings.
                </p>

            </div>

        </div>


        {{-- Affiliate Actions --}}
        <div class="flex w-full flex-col gap-3 sm:flex-row sm:items-center lg:w-auto">

            {{-- Referral Code --}}
            <!-- <div class="w-full rounded-2xl bg-gray-50 px-4 py-3 dark:bg-slate-950 sm:px-5 lg:w-auto">

                <p class="text-xs text-gray-500 dark:text-slate-400">
                    Referral Code
                </p>

                <div class="mt-1 flex flex-col items-start gap-3">

                    <span
                        id="referralCode"
                        class="min-w-0 break-all font-bold text-[#ed1c24]">
                        {{ $user->referral_code }}
                    </span>

                    <button
                        type="button"
                        id="copyReferralCodeBtn"
                        class="shrink-0 rounded-lg bg-[#0b3a67] px-3 py-1 text-xs font-semibold text-white transition hover:opacity-90">

                        Copy

                    </button>

                </div>

            </div> -->


            {{-- Referral Link --}}
            <div class="w-full rounded-2xl bg-gray-50 px-4 py-3 dark:bg-slate-950 sm:px-5 lg:w-auto">

                <p class="text-xs text-gray-500 dark:text-slate-400">
                    Referral Link
                </p>

                <div class="mt-1 flex items-center gap-3">

                    <span
                        id="referralLink"
                        data-link="https://www.tutorialcenter.africa?ref={{ $user->referral_code }}"
                        title="https://www.tutorialcenter.africa?ref={{ $user->referral_code }}"
                        class="min-w-0 break-all font-bold text-[#ed1c24]"
                    >
                        https://www.tutorialcenter.africa?ref={{ $user->referral_code }}
                        <!-- {{ $user->referral_code }} -->

                    </span>

                    <button
                        type="button"
                        id="copyReferralLinkBtn"
                        title="https://www.tutorialcenter.africa?ref={{ $user->referral_code }}"
                        class="shrink-0 rounded-lg bg-[#0b3a67] px-3 py-1 text-xs font-semibold text-white transition hover:opacity-90"
                    >
                        Copy
                    </button>

                </div>

                <p class="mt-1 text-xs text-gray-500 dark:text-slate-400">
                    Share this link with your referrals.
                </p>

            </div>


            {{-- Withdraw --}}
            <a
                href="{{ route('withdrawals.index') }}"
                class="w-full rounded-xl bg-[#ed1c24] px-5 py-3 text-center text-sm font-semibold text-white transition hover:opacity-90 sm:w-auto">

                Withdraw Funds

            </a>

        </div>

    </div>

</div>


{{-- Copy Functions --}}
<script>
    /*
    |--------------------------------------------------------------------------
    | Copy Text Function
    |--------------------------------------------------------------------------
    */

    async function copyText(text, successMessage, errorMessage) {

        try {

            /*
            |--------------------------------------------------------------------------
            | Modern Clipboard API
            |--------------------------------------------------------------------------
            */

            if (
                navigator.clipboard &&
                window.isSecureContext
            ) {

                await navigator.clipboard.writeText(text);

                alert(successMessage);

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Fallback Copy Method
            |--------------------------------------------------------------------------
            */

            const textarea = document.createElement('textarea');

            textarea.value = text;

            textarea.style.position = 'fixed';
            textarea.style.left = '-9999px';
            textarea.style.top = '-9999px';

            document.body.appendChild(textarea);

            textarea.focus();
            textarea.select();

            const successful = document.execCommand('copy');

            document.body.removeChild(textarea);


            if (successful) {

                alert(successMessage);

            } else {

                throw new Error('Copy command failed.');

            }

        } catch (error) {

            console.error('Copy failed:', error);

            alert(errorMessage);

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Copy Referral Code
    |--------------------------------------------------------------------------
    */

    function copyReferralCode() {

        const element = document.getElementById('referralCode');

        if (!element) {

            alert('Referral code not found.');

            return;
        }

        const code = element.textContent.trim();

        if (!code) {

            alert('Referral code is empty.');

            return;
        }

        copyText(
            code,
            'Referral code copied!',
            'Unable to copy referral code.'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Copy Referral Link
    |--------------------------------------------------------------------------
    */

    function copyReferralLink() {

        const element = document.getElementById('referralLink');

        if (!element) {

            alert('Referral link not found.');

            return;
        }

        const link = element.dataset.link;

        if (!link) {

            alert('Referral link is empty.');

            return;
        }

        copyText(
            link,
            'Referral link copied!',
            'Unable to copy referral link.'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Attach Button Events
    |--------------------------------------------------------------------------
    */

    document.addEventListener('DOMContentLoaded', function() {

        const copyReferralCodeBtn =
            document.getElementById('copyReferralCodeBtn');

        const copyReferralLinkBtn =
            document.getElementById('copyReferralLinkBtn');


        /*
        |--------------------------------------------------------------------------
        | Referral Code Button
        |--------------------------------------------------------------------------
        */

        if (copyReferralCodeBtn) {

            copyReferralCodeBtn.addEventListener(
                'click',
                copyReferralCode
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Referral Link Button
        |--------------------------------------------------------------------------
        */

        if (copyReferralLinkBtn) {

            copyReferralLinkBtn.addEventListener(
                'click',
                copyReferralLink
            );

        }

    });
</script>