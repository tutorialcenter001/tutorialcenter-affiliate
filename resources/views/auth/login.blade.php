@extends('layouts.app', ['title' => 'Login'])

@section('content')
<section class="flex min-h-screen items-center justify-center bg-[#f2f2f2] px-4 py-12 dark:bg-slate-950">

    <div class="w-full max-w-md rounded-3xl border border-gray-200 bg-white p-8 shadow-2xl dark:border-slate-800 dark:bg-slate-900">

        <div class="mb-6 text-center">
            <img src="{{ asset('images/tc-logo.png') }}" alt="TC Logo" class="mx-auto mb-4 w-28">

            <h2 class="text-3xl font-bold text-[#0b3a67] dark:text-white">
                Login
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
                Access your TC affiliate dashboard
            </p>
        </div>

        <div id="errorMessage" class="mb-4 hidden rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"></div>

        <form id="loginForm" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">
                    Email Address
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none transition focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                >

                <p class="mt-2 text-sm text-red-600" data-error="email"></p>
            </div>

            <div>
                <label for="passwordInput" class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">
                    Password
                </label>

                <div class="relative">
                    <input
                        id="passwordInput"
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 pr-12 outline-none transition focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                    >

                    <button
                        type="button"
                        id="togglePassword"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-500 transition hover:text-[#0b3a67] dark:text-slate-400 dark:hover:text-white"
                        aria-label="Show password"
                    >
                        <svg id="eyeOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>

                        <svg id="eyeClosed" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M3 3l18 18" />
                        </svg>
                    </button>
                </div>

                <p class="mt-2 text-sm text-red-600" data-error="password"></p>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-sm text-gray-500 dark:text-slate-400">
                    <input
                        type="checkbox"
                        name="remember"
                        class="rounded border-gray-300 text-[#0b3a67] focus:ring-[#0b3a67]"
                    >
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm font-semibold text-[#0b3a67] transition hover:text-[#ed1c24] dark:text-white">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button
                id="submitBtn"
                type="submit"
                class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#ed1c24] py-3.5 font-semibold text-white transition hover:opacity-90 disabled:cursor-not-allowed disabled:opacity-60"
            >
                <svg id="submitLoader" class="hidden h-5 w-5 animate-spin text-white" viewBox="0 0 24 24" fill="none">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                    </path>
                </svg>

                <span id="btnText">Login</span>
            </button>

            <p class="text-center text-sm text-gray-500 dark:text-slate-400">
                Don’t have an account?
                <a href="{{ route('register') }}"
                   class="font-semibold text-[#0b3a67] transition hover:text-[#ed1c24] dark:text-white">
                    Register
                </a>
            </p>
        </form>
    </div>

</section>

<script>
    const form = document.getElementById('loginForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitLoader = document.getElementById('submitLoader');
    const btnText = document.getElementById('btnText');
    const errorBox = document.getElementById('errorMessage');

    const passwordInput = document.getElementById('passwordInput');
    const togglePassword = document.getElementById('togglePassword');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');

    togglePassword.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';

        passwordInput.type = isPassword ? 'text' : 'password';

        eyeOpen.classList.toggle('hidden', isPassword);
        eyeClosed.classList.toggle('hidden', !isPassword);

        togglePassword.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
    });

    function setLoading(isLoading) {
        submitBtn.disabled = isLoading;
        submitLoader.classList.toggle('hidden', !isLoading);
        btnText.textContent = isLoading ? 'Logging in...' : 'Login';
    }

    function clearErrors() {
        document.querySelectorAll('[data-error]').forEach(el => el.textContent = '');
        document.querySelectorAll('input').forEach(input => {
            input.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
        });

        errorBox.classList.add('hidden');
        errorBox.textContent = '';
    }

    function showErrors(errors) {
        Object.keys(errors).forEach(key => {
            const errorField = document.querySelector(`[data-error="${key}"]`);
            const input = document.querySelector(`[name="${key}"]`);

            if (errorField) {
                errorField.textContent = errors[key][0];
            }

            if (input) {
                input.classList.add('border-red-500', 'ring-2', 'ring-red-200');
            }
        });
    }

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        clearErrors();
        setLoading(true);

        try {
            const response = await fetch(`{{ route('login.store') }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin',
                body: new FormData(form)
            });

            const text = await response.text();

            let data = {};
            try {
                data = JSON.parse(text);
            } catch (error) {
                console.error(text);
                throw new Error('Server returned a non-JSON response.');
            }

            if (response.status === 200) {
                window.location.href = data.redirect || `{{ route('dashboard') }}`;
                return;
            }

            errorBox.textContent = data.message || 'Login failed. Please try again.';
            errorBox.classList.remove('hidden');

            if (response.status === 422) {
                showErrors(data.errors || {});
            }

        } catch (error) {
            errorBox.textContent = error.message || 'Network error. Please try again.';
            errorBox.classList.remove('hidden');
        } finally {
            setLoading(false);
        }
    });
</script>
@endsection