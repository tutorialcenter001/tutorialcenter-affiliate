@extends('layouts.app', ['title' => 'Login'])

@section('content')
<section class="min-h-screen bg-[#f2f2f2] px-4 py-12 dark:bg-slate-950 flex items-center justify-center">

    <div class="w-full max-w-md rounded-3xl border border-gray-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-900 p-8">

        <div class="text-center mb-6">
            <img src="{{ asset('images/tc-logo.png') }}" class="w-28 mx-auto mb-4">
            <h2 class="text-3xl font-bold text-[#0b3a67] dark:text-white">
                Login
            </h2>
            <p class="text-gray-500 dark:text-slate-400 text-sm">
                Access your affiliate dashboard
            </p>
        </div>

        <div id="errorMessage" class="hidden mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700"></div>

        <form id="loginForm" class="space-y-5">

            @csrf

            <div>
                <label class="block text-sm font-semibold text-[#0b3a67] dark:text-white mb-2">Email</label>
                <input type="email" name="email" placeholder="Enter your email"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                <p class="text-sm text-red-600 mt-2" data-error="email"></p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#0b3a67] dark:text-white mb-2">Password</label>

                <div class="relative">
                    <input id="passwordInput" type="password" name="password"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 pr-12 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                    <button type="button" id="togglePassword"
                        class="absolute right-3 top-3 text-gray-500">
                        👁
                    </button>
                </div>

                <p class="text-sm text-red-600 mt-2" data-error="password"></p>
            </div>

            <button id="submitBtn"
                class="w-full rounded-xl bg-[#ed1c24] py-3 font-semibold text-white flex justify-center items-center gap-2">

                <svg id="loader" class="hidden w-5 h-5 animate-spin" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="white" stroke-width="3" fill="none"/>
                </svg>

                <span id="btnText">Login</span>
            </button>

            <p class="text-center text-sm text-gray-500 dark:text-slate-400">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-[#0b3a67] font-semibold">Register</a>
            </p>

        </form>
    </div>

</section>

<script>
const form = document.getElementById('loginForm');
const btn = document.getElementById('submitBtn');
const loader = document.getElementById('loader');
const btnText = document.getElementById('btnText');
const errorBox = document.getElementById('errorMessage');

document.getElementById('togglePassword').onclick = () => {
    const input = document.getElementById('passwordInput');
    input.type = input.type === 'password' ? 'text' : 'password';
};

function clearErrors() {
    document.querySelectorAll('[data-error]').forEach(el => el.textContent = '');
    errorBox.classList.add('hidden');
}

function showErrors(errors) {
    Object.keys(errors).forEach(key => {
        const el = document.querySelector(`[data-error="${key}"]`);
        if (el) el.textContent = errors[key][0];
    });
}

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    clearErrors();
    btn.disabled = true;
    loader.classList.remove('hidden');
    btnText.textContent = 'Logging in...';

    try {
        const res = await fetch("{{ route('login.store') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: new FormData(form)
        });

        const data = await res.json();

        if (res.status === 200) {
            window.location.href = "{{ route('dashboard') }}";
        }

        else if (res.status === 422) {
            errorBox.classList.remove('hidden');
            errorBox.textContent = data.message;
            showErrors(data.errors);
        }

        else {
            errorBox.classList.remove('hidden');
            errorBox.textContent = data.message;
        }

    } catch (err) {
        errorBox.classList.remove('hidden');
        errorBox.textContent = "Network error. Try again.";
    }

    btn.disabled = false;
    loader.classList.add('hidden');
    btnText.textContent = 'Login';
});
</script>

@endsection