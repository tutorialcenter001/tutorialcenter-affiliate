@extends('layouts.app', ['title' => 'Register'])

@section('content')
<section class="min-h-screen bg-[#f2f2f2] px-3 py-8 dark:bg-slate-950 sm:px-4 sm:py-12">
    <div class="mx-auto grid max-w-6xl overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-900 lg:grid-cols-2">

        <div class="flex flex-col justify-center bg-[#0b3a67] p-6 text-white sm:p-10 lg:p-14">
            <img src="{{ asset('images/tc-logo.png') }}" alt="TC Logo" class="mb-8 w-32 sm:w-40">

            <h1 class="mb-4 text-3xl font-extrabold sm:text-4xl lg:text-5xl">
                Join <span class="text-[#ed1c24]">TC Affiliates</span>
            </h1>

            <p class="mb-8 leading-relaxed text-gray-200">
                Create your affiliate account, choose your referral code, verify your email, and start tracking your growth.
            </p>

            <ul class="space-y-4 text-gray-100">
                <li>✔ Create your affiliate profile</li>
                <li>✔ Choose your own referral code</li>
                <li>✔ Verify your email with a token</li>
                <li>✔ Access your dashboard</li>
            </ul>
        </div>

        <div class="p-5 sm:p-8 lg:p-12">
            <h2 class="mb-2 text-2xl font-bold text-[#0b3a67] dark:text-white sm:text-3xl">
                Create Account
            </h2>

            <p class="mb-6 text-gray-500 dark:text-slate-400">
                Fill in your details below to register.
            </p>

            <div id="errorMessage" class="mb-4 hidden rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700"></div>

            <form id="registerForm" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label class="mb-3 block text-sm font-semibold text-[#0b3a67] dark:text-white">Profile Picture</label>

                    <label id="dropArea"
                        class="mx-auto flex h-36 w-36 cursor-pointer flex-col items-center justify-center overflow-hidden rounded-full border-2 border-dashed border-gray-300 bg-gray-50 text-center transition hover:border-[#0b3a67] hover:bg-gray-100 dark:border-slate-700 dark:bg-slate-950 dark:hover:border-[#ed1c24]">

                        <img id="imagePreview" src="" alt="Profile preview" class="hidden h-full w-full object-cover">

                        <div id="uploadPlaceholder" class="px-4">
                            <svg class="mx-auto mb-2 h-8 w-8 text-[#0b3a67] dark:text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 16V4m0 0L8 8m4-4l4 4M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                            </svg>
                            <p class="text-xs font-semibold text-[#0b3a67] dark:text-slate-300">Upload</p>
                            <p class="text-[11px] text-gray-500 dark:text-slate-400">Drag & drop</p>
                        </div>

                        <input id="profilePictureInput" type="file" name="profile_picture" accept=".jpg,.jpeg,.png,.gif" class="hidden">
                    </label>

                    <p class="mt-2 text-center text-xs text-gray-500 dark:text-slate-400">
                        JPG, PNG, JPEG, or GIF. Max 2MB.
                    </p>
                    <p class="mt-2 text-center text-sm text-red-600" data-error="profile_picture"></p>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">First Name</label>
                        <input type="text" name="firstname" placeholder="First name"
                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                        <p class="mt-2 text-sm text-red-600" data-error="firstname"></p>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">Surname</label>
                        <input type="text" name="surname" placeholder="Surname"
                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                        <p class="mt-2 text-sm text-red-600" data-error="surname"></p>
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">Email</label>
                    <input type="email" name="email" placeholder="Email address"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    <p class="mt-2 text-sm text-red-600" data-error="email"></p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">Phone Number</label>
                    <input type="text" name="phone_number" maxlength="11" placeholder="Example: 08012345678"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    <p class="mt-1 text-xs text-gray-500 dark:text-slate-400">
                        Optional. Must be 11 digits and start with 070, 080, 081, 090, or 091.
                    </p>
                    <p class="mt-2 text-sm text-red-600" data-error="phone_number"></p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">Referral Code</label>
                    <input type="text" name="referral_code" placeholder="Choose your referral code"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    <p class="mt-1 text-xs text-gray-500 dark:text-slate-400">Must be unique.</p>
                    <p class="mt-2 text-sm text-red-600" data-error="referral_code"></p>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">Password</label>

                        <div class="relative">
                            <input id="passwordInput" type="password" name="password" placeholder="Password"
                                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 pr-12 outline-none focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            <button type="button" data-toggle-password="passwordInput"
                                class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-[#0b3a67] dark:text-slate-400 dark:hover:text-white">
                                <svg class="eye-open h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>

                                <svg class="eye-closed hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M3 3l18 18" />
                                </svg>
                            </button>
                        </div>

                        <p class="mt-2 text-sm text-red-600" data-error="password"></p>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">Confirm Password</label>

                        <div class="relative">
                            <input id="passwordConfirmationInput" type="password" name="password_confirmation" placeholder="Confirm password"
                                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 pr-12 outline-none focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white">

                            <button type="button" data-toggle-password="passwordConfirmationInput"
                                class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-[#0b3a67] dark:text-slate-400 dark:hover:text-white">
                                <svg class="eye-open h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>

                                <svg class="eye-closed hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M3 3l18 18" />
                                </svg>
                            </button>
                        </div>

                        <p class="mt-2 text-sm text-red-600" data-error="password_confirmation"></p>
                    </div>
                </div>

                <input type="hidden" name="role" value="affiliate">
                <p class="mt-2 text-sm text-red-600" data-error="role"></p>

                <button id="submitBtn" type="submit"
                    class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#ed1c24] py-3.5 font-semibold text-white transition hover:opacity-90 disabled:cursor-not-allowed disabled:opacity-60">

                    <svg id="submitLoader" class="hidden h-5 w-5 animate-spin text-white" viewBox="0 0 24 24" fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                        </path>
                    </svg>

                    <span id="submitBtnText">Create Account</span>
                </button>

                <p class="text-center text-sm text-gray-500 dark:text-slate-400">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-semibold text-[#0b3a67] hover:text-[#ed1c24] dark:text-white">
                        Login
                    </a>
                </p>
            </form>
        </div>
    </div>
</section>


<script>
    const registerForm = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitBtnText = document.getElementById('submitBtnText');
    const submitLoader = document.getElementById('submitLoader');
    const errorMessage = document.getElementById('errorMessage');

    const dropArea = document.getElementById('dropArea');
    const fileInput = document.getElementById('profilePictureInput');
    const imagePreview = document.getElementById('imagePreview');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');

    function setLoading(isLoading) {
        submitBtn.disabled = isLoading;
        submitBtnText.textContent = isLoading ? 'Creating Account...' : 'Create Account';
        submitLoader.classList.toggle('hidden', !isLoading);
    }

    function clearErrors() {
        document.querySelectorAll('[data-error]').forEach(el => el.textContent = '');
        document.querySelectorAll('input, select, textarea').forEach(input => {
            input.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
        });

        errorMessage.classList.add('hidden');
        errorMessage.textContent = '';
    }

    function markInputAsInvalid(name) {
        const input = document.querySelector(`[name="${name}"]`);

        if (!input) return null;

        input.classList.add('border-red-500', 'ring-2', 'ring-red-200');

        return input;
    }

    function scrollToElement(element) {
        if (!element) return;

        const target = element.closest('div') || element;

        target.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });

        setTimeout(() => {
            if (element.focus && element.type !== 'file' && element.type !== 'hidden') {
                element.focus({
                    preventScroll: true
                });
            }
        }, 450);
    }

    function showErrors(errors) {
        let firstInvalidInput = null;

        Object.keys(errors).forEach(key => {
            const field = document.querySelector(`[data-error="${key}"]`);

            if (field) {
                field.textContent = errors[key][0];
            }

            const invalidInput = markInputAsInvalid(key);

            if (!firstInvalidInput && invalidInput) {
                firstInvalidInput = invalidInput;
            }

            if (key === 'profile_picture') {
                dropArea.classList.add('border-red-500', 'ring-2', 'ring-red-200');
                if (!firstInvalidInput) {
                    firstInvalidInput = dropArea;
                }
            }
        });

        scrollToElement(firstInvalidInput || errorMessage);
    }

    function previewImage(file) {
        if (!file) return;

        document.querySelector('[data-error="profile_picture"]').textContent = '';
        dropArea.classList.remove('border-red-500', 'ring-2', 'ring-red-200');

        if (!file.type.startsWith('image/')) {
            document.querySelector('[data-error="profile_picture"]').textContent = 'Please upload a valid image file.';
            dropArea.classList.add('border-red-500', 'ring-2', 'ring-red-200');
            scrollToElement(dropArea);
            return;
        }

        const reader = new FileReader();

        reader.onload = function(event) {
            imagePreview.src = event.target.result;
            imagePreview.classList.remove('hidden');
            uploadPlaceholder.classList.add('hidden');
        };

        reader.readAsDataURL(file);
    }

    fileInput.addEventListener('change', function() {
        previewImage(this.files[0]);
    });

    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, function(event) {
            event.preventDefault();
            event.stopPropagation();
            dropArea.classList.add('border-[#ed1c24]', 'bg-red-50', 'dark:bg-slate-800');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, function(event) {
            event.preventDefault();
            event.stopPropagation();
            dropArea.classList.remove('border-[#ed1c24]', 'bg-red-50', 'dark:bg-slate-800');
        });
    });

    dropArea.addEventListener('drop', function(event) {
        const file = event.dataTransfer.files[0];

        if (!file) return;

        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        fileInput.files = dataTransfer.files;

        previewImage(file);
    });

    document.querySelectorAll('[data-toggle-password]').forEach(button => {
        button.addEventListener('click', function() {
            const input = document.getElementById(this.dataset.togglePassword);
            const eyeOpen = this.querySelector('.eye-open');
            const eyeClosed = this.querySelector('.eye-closed');

            if (!input) return;

            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';

            eyeOpen.classList.toggle('hidden', isPassword);
            eyeClosed.classList.toggle('hidden', !isPassword);
        });
    });

    registerForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        clearErrors();
        setLoading(true);

        try {
            const response = await fetch(`{{ route('register.store') }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin',
                body: new FormData(registerForm)
            });

            const text = await response.text();

            let data = {};
            try {
                data = JSON.parse(text);
            } catch (e) {
                console.error(text);
                throw new Error('Server returned a non-JSON response.');
            }

            if (response.status === 201) {
                window.location.href = `{{ route('verification.notice') }}?email=${encodeURIComponent(data.user.email)}`;
                return;
            }

            if (response.status === 422) {
                errorMessage.textContent = data.message || 'Validation failed. Please check the highlighted fields.';
                errorMessage.classList.remove('hidden');
                showErrors(data.errors || {});
                return;
            }

            errorMessage.textContent = data.message || data.error || 'Something went wrong.';
            errorMessage.classList.remove('hidden');
            scrollToElement(errorMessage);

        } catch (error) {
            errorMessage.textContent = error.message || 'Unable to register right now. Please try again.';
            errorMessage.classList.remove('hidden');
            scrollToElement(errorMessage);
        } finally {
            setLoading(false);
        }
    });
</script>
@endsection
