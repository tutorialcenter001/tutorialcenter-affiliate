@extends('layouts.app', ['title' => 'Privacy Policy'])

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
                Privacy Policy
            </h1>

            <p class="mx-auto mt-6 max-w-3xl text-lg text-[#7a7a7a] dark:text-slate-300">
                Your privacy is important to us. This Privacy Policy explains how
                Tutorial Center collects, uses, stores, and protects your personal information.
            </p>

            <p class="mt-4 text-sm text-gray-500 dark:text-slate-400">
                Last Updated: {{ now()->format('F d, Y') }}
            </p>

        </div>

    </div>


</section>

<!-- Privacy Notice -->

<section class="bg-[#f2f2f2] py-12 dark:bg-slate-900">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">


        <div class="rounded-3xl border border-blue-200 bg-blue-50 p-6 dark:border-blue-700 dark:bg-blue-950/20">

            <h2 class="text-xl font-bold text-[#0b3a67] dark:text-blue-300">
                Privacy Commitment
            </h2>

            <p class="mt-3 text-gray-700 dark:text-slate-300">
                Tutorial Center is committed to safeguarding your personal information
                and ensuring that your data is handled responsibly and securely.
            </p>

        </div>

    </div>


</section>

<!-- Policy Content -->

<section class="bg-white py-16 dark:bg-slate-950">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">


        <div class="space-y-8">

            <div class="policy-card">
                <h2>1. Information We Collect</h2>

                <p>
                    We may collect personal information that you provide when
                    registering or using the TC Affiliate Platform.
                </p>

                <ul>
                    <li>First Name and Surname</li>
                    <li>Email Address</li>
                    <li>Phone Number</li>
                    <li>Referral Code</li>
                    <li>Bank Account Information</li>
                    <li>Profile Photo (if provided)</li>
                </ul>
            </div>

            <div class="policy-card">
                <h2>2. How We Use Your Information</h2>

                <p>Your information may be used to:</p>

                <ul>
                    <li>Create and manage your affiliate account.</li>
                    <li>Track referrals and earnings.</li>
                    <li>Process withdrawals and payments.</li>
                    <li>Verify account ownership.</li>
                    <li>Communicate important account updates.</li>
                    <li>Improve our services and user experience.</li>
                </ul>
            </div>

            <div class="policy-card">
                <h2>3. Bank Account Information</h2>

                <p>
                    Bank account details provided by affiliates are used solely
                    for payment processing purposes.
                </p>

                <p class="mt-3">
                    Affiliates are responsible for ensuring that the name on
                    their account matches the name used during registration.
                </p>
            </div>

            <div class="policy-card">
                <h2>4. Referral Tracking</h2>

                <p>
                    We collect referral information to identify, verify,
                    and reward successful referrals.
                </p>

                <p class="mt-3">
                    Referral data may include referral names, contact details,
                    referral codes, timestamps, and status updates.
                </p>
            </div>

            <div class="policy-card">
                <h2>5. Cookies and Analytics</h2>

                <p>
                    We may use cookies and similar technologies to improve
                    platform functionality, remember preferences, and analyze usage.
                </p>

                <p class="mt-3">
                    You may disable cookies through your browser settings,
                    although some features may not function properly.
                </p>
            </div>

            <div class="policy-card">
                <h2>6. Data Security</h2>

                <p>
                    We implement appropriate security measures designed to
                    protect your personal information from unauthorized access,
                    disclosure, alteration, or destruction.
                </p>

                <p class="mt-3">
                    However, no online platform can guarantee absolute security.
                </p>
            </div>

            <div class="policy-card">
                <h2>7. Information Sharing</h2>

                <p>
                    Tutorial Center does not sell, rent, or trade your personal
                    information to third parties.
                </p>

                <p class="mt-3">
                    Information may only be shared when:
                </p>

                <ul>
                    <li>Required by law.</li>
                    <li>Necessary to process payments.</li>
                    <li>Needed to protect our legal rights.</li>
                    <li>Required for fraud prevention and investigation.</li>
                </ul>
            </div>

            <div class="policy-card">
                <h2>8. Data Retention</h2>

                <p>
                    We retain personal information only for as long as necessary
                    to provide services, comply with legal obligations, resolve disputes,
                    and enforce our agreements.
                </p>
            </div>

            <div class="policy-card">
                <h2>9. Your Rights</h2>

                <p>You may have the right to:</p>

                <ul>
                    <li>Access your personal information.</li>
                    <li>Correct inaccurate information.</li>
                    <li>Request deletion of your account.</li>
                    <li>Withdraw consent where applicable.</li>
                    <li>Request information about how your data is processed.</li>
                </ul>
            </div>

            <div class="policy-card">
                <h2>10. Third-Party Services</h2>

                <p>
                    The TC Affiliate Platform may integrate with third-party
                    services such as payment providers, email providers,
                    analytics services, and hosting platforms.
                </p>

                <p class="mt-3">
                    These services maintain their own privacy policies.
                </p>
            </div>

            <div class="policy-card">
                <h2>11. Children's Privacy</h2>

                <p>
                    The TC Affiliate Program is not intended for individuals
                    under the age of 18. We do not knowingly collect personal
                    information from minors.
                </p>
            </div>

            <div class="policy-card">
                <h2>12. Changes to this Privacy Policy</h2>

                <p>
                    Tutorial Center reserves the right to update this Privacy Policy
                    at any time. Updates will be published on this page with a revised
                    effective date.
                </p>
            </div>

            <div class="policy-card">
                <h2>13. Contact Us</h2>

                <p>
                    If you have questions regarding this Privacy Policy,
                    please contact us:
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
            Your Privacy Matters
        </h2>

        <p class="mt-4 text-white/80">
            We are committed to protecting your personal information and maintaining your trust.
        </p>

        <div class="mt-8 flex flex-col justify-center gap-4 sm:flex-row">

            <a href="{{ route('register') }}"
                class="rounded-xl bg-[#ed1c24] px-8 py-3 font-semibold text-white">
                Join the Program
            </a>

            <a href="{{ route('terms') }}"
                class="rounded-xl border border-white px-8 py-3 font-semibold">
                View Terms & Conditions
            </a>

        </div>

    </div>


</section>

<style>
    .policy-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 1.5rem;
        padding: 2rem;
    }

    .dark .policy-card {
        background: #0f172a;
        border-color: #1e293b;
    }

    .policy-card h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0b3a67;
        margin-bottom: 1rem;
    }

    .dark .policy-card h2 {
        color: white;
    }

    .policy-card p {
        color: #64748b;
        line-height: 1.8;
    }

    .policy-card ul {
        margin-top: 1rem;
        padding-left: 1.5rem;
        color: #64748b;
    }

    .policy-card li {
        margin-bottom: .5rem;
    }
</style>

@endsection