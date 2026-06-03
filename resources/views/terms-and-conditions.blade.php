@extends('layouts.app', ['title' => 'Terms & Conditions'])

@section('content')

<!-- Hero Section -->

<section class="relative overflow-hidden bg-white dark:bg-slate-950">
    <div class="absolute inset-0 bg-gradient-to-br from-[#0b3a67]/10 via-transparent to-[#ed1c24]/10 dark:from-[#0b3a67]/30 dark:to-[#ed1c24]/20"></div>

    <div class="relative mx-auto max-w-5xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">

        <div class="text-center">

            <p class="inline-flex rounded-full bg-[#0b3a67]/10 px-4 py-2 text-sm font-semibold text-[#0b3a67] dark:bg-white/10 dark:text-slate-200 mb-6">
                TC Affiliate Program
            </p>

            <h1 class="text-4xl font-extrabold text-[#0b3a67] dark:text-white md:text-6xl">
                Terms & Conditions
            </h1>

            <p class="mx-auto mt-6 max-w-3xl text-lg text-[#7a7a7a] dark:text-slate-300">
                Please read these Terms & Conditions carefully before participating
                in the TC Affiliate Program.
            </p>

            <p class="mt-4 text-sm text-gray-500 dark:text-slate-400">
                Last Updated: {{ now()->format('F d, Y') }}
            </p>

        </div>

    </div>


</section>

<!-- Important Notice -->

<section class="bg-[#f2f2f2] py-12 dark:bg-slate-900">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">


        <div class="rounded-3xl border border-yellow-200 bg-yellow-50 p-6 dark:border-yellow-700 dark:bg-yellow-950/20">

            <h2 class="text-xl font-bold text-yellow-700 dark:text-yellow-400">
                Important Notice
            </h2>

            <p class="mt-3 text-gray-700 dark:text-slate-300">
                By creating an affiliate account and using the TC Affiliate Platform,
                you agree to these Terms & Conditions. If you do not agree, please do
                not register or participate in the program.
            </p>

        </div>

    </div>

</section>

<!-- Terms -->

<section class="bg-white py-16 dark:bg-slate-950">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">


        <div class="space-y-8">

            <div class="term-card">
                <h2>1. Eligibility</h2>
                <p>
                    To participate in the TC Affiliate Program, you must be at least
                    18 years old and provide accurate registration information.
                </p>
            </div>

            <div class="term-card">
                <h2>2. Account Registration</h2>
                <p>
                    Affiliates must provide their real first name and surname.
                    The name used during registration should match the name on the
                    bank account that will receive payments.
                </p>

                <p class="mt-3">
                    Tutorial Center shall not be responsible for payment delays or
                    failed transfers resulting from incorrect account information.
                </p>
            </div>

            <div class="term-card">
                <h2>3. Referral Codes</h2>
                <p>
                    Every affiliate must create a unique referral code.
                </p>

                <ul>
                    <li>Referral codes must not impersonate another individual or organization.</li>
                    <li>Tutorial Center reserves the right to reject inappropriate codes.</li>
                    <li>Referral codes are subject to availability.</li>
                </ul>
            </div>

            <div class="term-card">
                <h2>4. Acceptable Promotion Methods</h2>

                <p>
                    Affiliates may promote Tutorial Center through:
                </p>

                <ul>
                    <li>Social media platforms</li>
                    <li>Blogs and websites</li>
                    <li>Email marketing (where permitted)</li>
                    <li>Direct referrals</li>
                </ul>

                <p class="mt-3">
                    Affiliates must not use misleading advertisements, false claims,
                    spam, or deceptive marketing techniques.
                </p>
            </div>

            <div class="term-card">
                <h2>5. Referral Validation</h2>

                <p>
                    Referral commissions are only earned when a referral is verified
                    and approved by Tutorial Center.
                </p>

                <p class="mt-3">
                    Tutorial Center reserves the right to reject referrals that are
                    incomplete, fraudulent, duplicated, or otherwise invalid.
                </p>
            </div>

            <div class="term-card">
                <h2>6. Affiliate Earnings</h2>

                <p>
                    Earnings may appear as pending until reviewed and approved.
                </p>

                <ul>
                    <li>Pending earnings cannot be withdrawn.</li>
                    <li>Approved earnings become available for withdrawal.</li>
                    <li>Declined earnings are not payable.</li>
                </ul>
            </div>

            <div class="term-card">
                <h2>7. Withdrawals</h2>

                <p>
                    Withdrawal requests are processed to the bank account registered
                    on the affiliate profile.
                </p>

                <ul>
                    <li>Withdrawal requests may be reviewed before approval.</li>
                    <li>Processing times may vary.</li>
                    <li>Tutorial Center may request additional verification before payment.</li>
                </ul>
            </div>

            <div class="term-card">
                <h2>8. Fraud Prevention</h2>

                <p>
                    The following activities are strictly prohibited:
                </p>

                <ul>
                    <li>Creating fake referrals.</li>
                    <li>Duplicate accounts.</li>
                    <li>Self-referrals.</li>
                    <li>Manipulating referral records.</li>
                    <li>Any fraudulent activity.</li>
                </ul>

                <p class="mt-3">
                    Accounts found engaging in fraudulent activity may be suspended,
                    terminated, and have earnings forfeited.
                </p>
            </div>

            <div class="term-card">
                <h2>9. Account Suspension</h2>

                <p>
                    Tutorial Center reserves the right to suspend or terminate any
                    affiliate account that violates these Terms & Conditions.
                </p>
            </div>

            <div class="term-card">
                <h2>10. Intellectual Property</h2>

                <p>
                    All Tutorial Center trademarks, branding, content, and materials
                    remain the exclusive property of Tutorial Center.
                </p>
            </div>

            <div class="term-card">
                <h2>11. Limitation of Liability</h2>

                <p>
                    Tutorial Center shall not be liable for indirect, incidental,
                    consequential, or special damages arising from participation
                    in the Affiliate Program.
                </p>
            </div>

            <div class="term-card">
                <h2>12. Modifications</h2>

                <p>
                    Tutorial Center reserves the right to update these Terms &
                    Conditions at any time. Continued participation in the program
                    constitutes acceptance of the revised terms.
                </p>
            </div>

            <div class="term-card">
                <h2>13. Governing Law</h2>

                <p>
                    These Terms & Conditions shall be governed by and interpreted in
                    accordance with the laws of the Federal Republic of Nigeria.
                </p>
            </div>

            <div class="term-card">
                <h2>14. Contact Information</h2>

                <p>
                    If you have any questions regarding these Terms & Conditions,
                    please contact:
                </p>

                <div class="mt-4 rounded-2xl bg-[#0b3a67] p-5 text-white">
                    <p><strong>Tutorial Center</strong></p>
                    <p>Email: support@tutorialcenter.africa</p>
                    <p>Website: https://tutorialcenter.africa</p>
                </div>
            </div>

        </div>

    </div>


</section>

<!-- CTA -->

<section class="bg-[#0b3a67] py-16 text-white">
    <div class="mx-auto max-w-4xl px-4 text-center">


        <h2 class="text-3xl font-bold">
            Ready to Start Earning?
        </h2>

        <p class="mt-4 text-white/80">
            Create your affiliate account today and start sharing your referral code.
        </p>

        <div class="mt-8 flex flex-col justify-center gap-4 sm:flex-row">

            <a href="{{ route('register') }}"
                class="rounded-xl bg-[#ed1c24] px-8 py-3 font-semibold text-white">
                Create Account
            </a>

            <a href="{{ route('login') }}"
                class="rounded-xl border border-white px-8 py-3 font-semibold">
                Login
            </a>

        </div>

    </div>


</section>

<style>
    .term-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 1.5rem;
        padding: 2rem;
    }

    .dark .term-card {
        background: #0f172a;
        border-color: #1e293b;
    }

    .term-card h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0b3a67;
        margin-bottom: 1rem;
    }

    .dark .term-card h2 {
        color: white;
    }

    .term-card p {
        color: #64748b;
        line-height: 1.8;
    }

    .term-card ul {
        margin-top: 1rem;
        padding-left: 1.5rem;
        color: #64748b;
    }

    .term-card li {
        margin-bottom: .5rem;
    }
</style>

@endsection