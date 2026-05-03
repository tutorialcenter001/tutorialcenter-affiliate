@extends('layouts.app', ['title' => 'Account Verification'])

@section('content')
<section class="flex min-h-screen items-center justify-center bg-[#f2f2f2] px-3 py-8 dark:bg-slate-950 sm:px-4 sm:py-12">
    <div class="w-full max-w-xl overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-900">

        <div class="bg-[#0b3a67] px-5 py-8 text-center text-white sm:px-8 sm:py-10">
            <img src="{{ asset('images/tc-logo.png') }}" alt="TC Logo" class="mx-auto mb-4 w-28">
            <h1 class="text-2xl font-extrabold sm:text-3xl">Account Verification</h1>
        </div>

        <div class="p-5 text-center sm:p-8">
            @if(isset($success))
                <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-green-100">
                    <span class="text-4xl text-green-600">✓</span>
                </div>

                <h2 class="mb-3 text-2xl font-bold text-[#0b3a67] dark:text-white">
                    Verification Successful
                </h2>

                <p class="mb-8 text-gray-600 dark:text-slate-400">
                    {{ $success }}
                </p>

                <a href="{{ route('login') }}"
                   class="inline-flex w-full justify-center rounded-xl bg-[#ed1c24] px-8 py-3 font-semibold text-white hover:opacity-90 sm:w-auto">
                    Go to Login
                </a>
            @endif

            @if(isset($error))
                <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-red-100">
                    <span class="text-4xl text-red-600">×</span>
                </div>

                <h2 class="mb-3 text-2xl font-bold text-[#0b3a67] dark:text-white">
                    Verification Failed
                </h2>

                <p class="mb-8 text-gray-600 dark:text-slate-400">
                    {{ $error }}
                </p>

                <a href="{{ route('verification.notice') }}"
                   class="inline-flex w-full justify-center rounded-xl bg-[#ed1c24] px-8 py-3 font-semibold text-white hover:opacity-90 sm:w-auto">
                    Try Again
                </a>
            @endif
        </div>
    </div>
</section>
@endsection
