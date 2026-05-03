@extends('layouts.app', ['title' => 'Verify Account'])

@section('content')
<section class="flex min-h-screen items-center justify-center bg-[#f2f2f2] px-3 py-8 dark:bg-slate-950 sm:px-4 sm:py-12">
    <div class="w-full max-w-2xl bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-gray-200 dark:border-slate-800 overflow-hidden">

        <div class="bg-[#0b3a67] px-5 py-8 text-center text-white sm:px-8 sm:py-10">
            <img src="{{ asset('images/tc-logo.png') }}" alt="TC Logo" class="w-28 mx-auto mb-4">

            <h1 class="text-2xl font-extrabold sm:text-3xl">
                Verify Your Account
            </h1>

            <p class="mt-2 text-gray-200">
                Enter the 6-digit token sent to your email.
            </p>
        </div>

        <div class="p-5 sm:p-8 lg:p-10">
            @if(session('success'))
                <div class="mb-5 rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <div id="successMessage" class="hidden mb-5 rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-green-700"></div>
            <div id="errorMessage" class="hidden mb-5 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-red-700"></div>

            <div class="mb-6 rounded-xl bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 px-4 py-3">
                <p class="text-sm text-gray-500 dark:text-slate-400">Email</p>
                <p class="break-words font-semibold text-[#0b3a67] dark:text-white">
                    {{ request('email') ?? 'Enter your registered email below to resend token.' }}
                </p>
            </div>

            <form method="GET" action="{{ url('/verify') }}" class="space-y-5">
                <div>
                    <label for="token" class="block text-sm font-semibold text-[#0b3a67] dark:text-white mb-2">
                        Verification Token
                    </label>

                    <input
                        type="text"
                        name="token"
                        id="token"
                        maxlength="6"
                        inputmode="numeric"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-center text-xl font-bold tracking-[0.25em] focus:outline-none focus:ring-2 focus:ring-[#0b3a67] dark:border-slate-700 dark:bg-slate-950 sm:text-2xl sm:tracking-[0.4em]"
                        placeholder="000000"
                    >
                </div>

                <button
                    type="submit"
                    onclick="event.preventDefault(); const token = document.getElementById('token').value.trim(); if(token){ window.location.href = '{{ url('/verify') }}/' + encodeURIComponent(token); }"
                    class="w-full rounded-xl bg-[#ed1c24] py-3.5 font-semibold text-white hover:opacity-90 transition"
                >
                    Verify Account
                </button>
            </form>

            <div class="mt-8 border-t border-gray-200 dark:border-slate-800 pt-6">
                <h2 class="text-lg font-bold text-[#0b3a67] dark:text-white mb-2">
                    Did not receive your token?
                </h2>

                <p class="text-sm text-gray-500 dark:text-slate-400 mb-4">
                    Enter your email address and request a new verification token.
                </p>

                <form id="resendForm" class="space-y-4">
                    @csrf

                    <div>
                        <input
                            type="email"
                            name="email"
                            value="{{ request('email') }}"
                            class="w-full rounded-xl border border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#0b3a67]"
                            placeholder="Enter your email"
                        >
                        <p class="error mt-2 text-sm text-red-600" data-error="email"></p>
                    </div>

                    <button
                        type="submit"
                        id="resendBtn"
                        class="w-full rounded-xl border border-[#0b3a67] py-3.5 font-semibold text-[#0b3a67] dark:text-white dark:border-slate-600 hover:bg-[#0b3a67] hover:text-white transition"
                    >
                        Resend Verification Token
                    </button>
                </form>
            </div>

            <p class="mt-6 text-center text-sm text-gray-500 dark:text-slate-400">
                Already verified?
                <a href="{{ route('login') }}" class="font-semibold text-[#0b3a67] dark:text-white hover:text-[#ed1c24]">
                    Login
                </a>
            </p>
        </div>
    </div>
</section>

<script>
    const resendForm = document.getElementById('resendForm');
    const resendBtn = document.getElementById('resendBtn');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');

    function clearMessages() {
        document.querySelectorAll('.error').forEach(el => el.textContent = '');
        successMessage.classList.add('hidden');
        errorMessage.classList.add('hidden');
        successMessage.textContent = '';
        errorMessage.textContent = '';
    }

    function showErrors(errors) {
        Object.keys(errors).forEach(key => {
            const field = document.querySelector(`[data-error="${key}"]`);
            if (field) {
                field.textContent = errors[key][0];
            }
        });
    }

    resendForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        clearMessages();

        resendBtn.disabled = true;
        resendBtn.textContent = 'Sending...';

        try {
            const response = await fetch(`{{ route('verification.resend') }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin',
                body: new FormData(resendForm)
            });

            const data = await response.json();

            if (response.ok) {
                successMessage.textContent = data.message || 'A new verification token has been sent to your email.';
                successMessage.classList.remove('hidden');
            } else if (response.status === 422) {
                errorMessage.textContent = data.message || 'Validation failed.';
                errorMessage.classList.remove('hidden');
                showErrors(data.errors || {});
            } else {
                errorMessage.textContent = data.message || 'Unable to resend verification token.';
                errorMessage.classList.remove('hidden');
            }
        } catch (error) {
            errorMessage.textContent = 'Unable to resend verification token right now.';
            errorMessage.classList.remove('hidden');
        } finally {
            resendBtn.disabled = false;
            resendBtn.textContent = 'Resend Verification Token';
        }
    });
</script>
@endsection
