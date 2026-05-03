@extends('layouts.app', ['title' => 'Reset Password'])

@section('content')
<section class="flex min-h-screen items-center justify-center bg-[#f2f2f2] px-3 py-8 dark:bg-slate-950 sm:px-4 sm:py-12">
    <div class="w-full max-w-md rounded-3xl border border-gray-200 bg-white p-6 shadow-2xl dark:border-slate-800 dark:bg-slate-900 sm:p-8">
        <h1 class="text-2xl font-bold text-[#0b3a67] dark:text-white sm:text-3xl">Reset Password</h1>
        <p class="mt-2 text-sm text-gray-500 dark:text-slate-400">
            Create a new password for your account.
        </p>

        <div id="successMessage" class="mt-5 hidden rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700"></div>
        <div id="errorMessage" class="mt-5 hidden rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700"></div>

        <form id="resetPasswordForm" class="mt-6 space-y-5">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ request('email') }}">

            <div>
                <label class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">
                    Email Address
                </label>
                <input
                    type="email"
                    value="{{ request('email') }}"
                    disabled
                    class="w-full rounded-xl border border-gray-300 bg-gray-100 px-4 py-3 text-gray-500 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400"
                >
                <p class="mt-2 text-sm text-red-600" data-error="email"></p>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">
                    New Password
                </label>
                <input
                    type="password"
                    name="password"
                    placeholder="New password"
                    class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                >
                <p class="mt-2 text-sm text-red-600" data-error="password"></p>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">
                    Confirm Password
                </label>
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm password"
                    class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                >
            </div>

            <button
                id="submitBtn"
                type="submit"
                class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#ed1c24] py-3.5 font-semibold text-white transition hover:opacity-90 disabled:opacity-60"
            >
                <svg id="loader" class="hidden h-5 w-5 animate-spin text-white" viewBox="0 0 24 24" fill="none">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
                <span id="btnText">Change Password</span>
            </button>
        </form>
    </div>
</section>

<script>
const form = document.getElementById('resetPasswordForm');
const submitBtn = document.getElementById('submitBtn');
const btnText = document.getElementById('btnText');
const loader = document.getElementById('loader');
const successMessage = document.getElementById('successMessage');
const errorMessage = document.getElementById('errorMessage');

function setLoading(value) {
    submitBtn.disabled = value;
    loader.classList.toggle('hidden', !value);
    btnText.textContent = value ? 'Changing...' : 'Change Password';
}

function clearMessages() {
    document.querySelectorAll('[data-error]').forEach(el => el.textContent = '');
    successMessage.classList.add('hidden');
    errorMessage.classList.add('hidden');
}

function showErrors(errors) {
    Object.keys(errors).forEach(key => {
        const field = document.querySelector(`[data-error="${key}"]`);
        if (field) field.textContent = errors[key][0];
    });
}

form.addEventListener('submit', async function(e) {
    e.preventDefault();
    clearMessages();
    setLoading(true);

    try {
        const response = await fetch(`{{ route('password.update') }}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin',
            body: new FormData(form)
        });

        const data = await response.json();

        if (response.ok) {
            successMessage.textContent = data.message || 'Password changed successfully.';
            successMessage.classList.remove('hidden');

            setTimeout(() => {
                window.location.href = data.redirect || `{{ route('login') }}`;
            }, 1200);
        } else if (response.status === 422) {
            errorMessage.textContent = data.message || 'Validation failed.';
            errorMessage.classList.remove('hidden');
            showErrors(data.errors || {});
        } else {
            errorMessage.textContent = data.message || 'Something went wrong.';
            errorMessage.classList.remove('hidden');
        }
    } catch (error) {
        errorMessage.textContent = 'Unable to reset password right now.';
        errorMessage.classList.remove('hidden');
    } finally {
        setLoading(false);
    }
});
</script>
@endsection
