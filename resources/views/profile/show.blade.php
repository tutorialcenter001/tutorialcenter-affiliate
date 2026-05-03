<x-dashboard-layout title="Profile">

    <x-dashboard-header :user="$user" />

    @php
        $affiliateName = trim($user->firstname . ' ' . $user->surname);
    @endphp

    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-4 text-sm font-semibold text-green-700 dark:border-green-900/60 dark:bg-green-950/40 dark:text-green-300 sm:px-5">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- Profile Card --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-6 xl:col-span-1">
            <div class="flex flex-col items-center text-center">
                <div class="flex h-28 w-28 shrink-0 items-center justify-center overflow-hidden rounded-full bg-[#0b3a67] text-4xl font-bold text-white">
                    @if($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile" class="h-full w-full object-cover">
                    @else
                        {{ strtoupper(substr($user->firstname, 0, 1)) }}
                    @endif
                </div>

                <h1 class="mt-4 max-w-full break-words text-2xl font-extrabold text-[#0b3a67] dark:text-white">
                    {{ $affiliateName }}
                </h1>

                <p class="mt-1 text-sm font-semibold text-[#ed1c24]">
                    {{ ucfirst($user->role) }}
                </p>

                <button
                    type="button"
                    data-modal-open="editProfileModal"
                    class="mt-6 w-full rounded-xl bg-[#0b3a67] px-5 py-3 text-sm font-semibold text-white transition hover:opacity-90"
                >
                    Edit Profile
                </button>
            </div>
        </div>

        <div class="space-y-6 xl:col-span-2">

            {{-- Profile Information --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-6">
                <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="min-w-0">
                        <h2 class="break-words text-2xl font-bold text-[#0b3a67] dark:text-white">
                            Profile Information
                        </h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
                            Your affiliate account details.
                        </p>
                    </div>

                    <button
                        type="button"
                        data-modal-open="accountModal"
                        class="w-full rounded-xl bg-[#ed1c24] px-5 py-3 text-sm font-semibold text-white transition hover:opacity-90 sm:w-auto"
                    >
                        Add Account
                    </button>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="rounded-xl bg-gray-50 p-4 dark:bg-slate-950">
                        <p class="text-xs text-gray-500 dark:text-slate-400">First Name</p>
                        <p class="mt-1 break-words font-semibold text-[#0b3a67] dark:text-white">
                            {{ $user->firstname }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-gray-50 p-4 dark:bg-slate-950">
                        <p class="text-xs text-gray-500 dark:text-slate-400">Surname</p>
                        <p class="mt-1 break-words font-semibold text-[#0b3a67] dark:text-white">
                            {{ $user->surname }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-gray-50 p-4 dark:bg-slate-950">
                        <p class="text-xs text-gray-500 dark:text-slate-400">Email</p>
                        <p class="mt-1 break-all font-semibold text-[#0b3a67] dark:text-white">
                            {{ $user->email }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-gray-50 p-4 dark:bg-slate-950">
                        <p class="text-xs text-gray-500 dark:text-slate-400">Phone</p>
                        <p class="mt-1 break-words font-semibold text-[#0b3a67] dark:text-white">
                            {{ $user->phone_number ?? 'Not provided' }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-gray-50 p-4 dark:bg-slate-950">
                        <p class="text-xs text-gray-500 dark:text-slate-400">Referral Code</p>
                        <p class="mt-1 break-all font-bold text-[#ed1c24]">
                            {{ $user->referral_code }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-gray-50 p-4 dark:bg-slate-950">
                        <p class="text-xs text-gray-500 dark:text-slate-400">Email Status</p>
                        <p class="mt-1 font-semibold text-[#0b3a67] dark:text-white">
                            {{ $user->email_verified_at ? 'Verified' : 'Not verified' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Bank Accounts --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-6">
                <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="min-w-0">
                        <h2 class="break-words text-2xl font-bold text-[#0b3a67] dark:text-white">
                            Bank Accounts
                        </h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
                            Saved payout accounts for withdrawals.
                        </p>
                    </div>

                    <button
                        type="button"
                        data-modal-open="accountModal"
                        class="w-full rounded-xl border border-[#0b3a67] px-5 py-3 text-sm font-semibold text-[#0b3a67] transition hover:bg-[#0b3a67] hover:text-white dark:border-slate-600 dark:text-white dark:hover:bg-slate-800 sm:w-auto"
                    >
                        Add Account
                    </button>
                </div>

                {{-- Mobile Cards --}}
                <div class="space-y-4 md:hidden">
                    @forelse($bankAccounts as $account)
                        <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-slate-800 dark:bg-slate-950">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <p class="break-words font-bold text-[#0b3a67] dark:text-white">
                                        {{ $account->bank_name }}
                                    </p>
                                    <p class="mt-1 break-words text-sm text-gray-500 dark:text-slate-400">
                                        {{ $affiliateName }}
                                    </p>
                                </div>

                                @if($account->is_default)
                                    <span class="shrink-0 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Default
                                    </span>
                                @else
                                    <span class="shrink-0 rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600 dark:bg-slate-800 dark:text-slate-300">
                                        Saved
                                    </span>
                                @endif
                            </div>

                            <div class="mt-4 rounded-xl bg-white p-3 dark:bg-slate-900">
                                <p class="text-xs text-gray-500 dark:text-slate-400">Account Number</p>
                                <p class="mt-1 break-all font-semibold text-[#ed1c24]">
                                    {{ $account->account_number }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-gray-300 p-8 text-center dark:border-slate-700">
                            <p class="text-sm text-gray-500 dark:text-slate-400">
                                No bank account added yet.
                            </p>
                        </div>
                    @endforelse
                </div>

                {{-- Desktop Table --}}
                <div class="hidden overflow-x-auto md:block">
                    <table class="w-full min-w-[48rem] text-left text-sm">
                        <thead>
                            <tr class="border-b border-gray-200 text-gray-500 dark:border-slate-800 dark:text-slate-400">
                                <th class="py-3 pr-4">Bank</th>
                                <th class="py-3 pr-4">Account Name</th>
                                <th class="py-3 pr-4">Account Number</th>
                                <th class="py-3">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($bankAccounts as $account)
                                <tr class="border-b border-gray-100 dark:border-slate-800">
                                    <td class="py-4 pr-4 font-medium text-[#0b3a67] dark:text-white">
                                        {{ $account->bank_name }}
                                    </td>
                                    <td class="py-4 pr-4 text-gray-500 dark:text-slate-400">
                                        {{ $affiliateName }}
                                    </td>
                                    <td class="py-4 pr-4 font-semibold text-[#ed1c24]">
                                        {{ $account->account_number }}
                                    </td>
                                    <td class="py-4">
                                        @if($account->is_default)
                                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                Default
                                            </span>
                                        @else
                                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600 dark:bg-slate-800 dark:text-slate-300">
                                                Saved
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-10 text-center text-gray-500 dark:text-slate-400">
                                        No bank account added yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- Edit Profile Modal --}}
    <div id="editProfileModal" class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-black/50 px-3 py-4 sm:px-4 sm:py-8">
        <div class="max-h-[calc(100vh-2rem)] w-full max-w-2xl overflow-y-auto rounded-2xl border border-gray-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-900">
            <div class="flex items-center justify-between gap-4 border-b border-gray-200 px-4 py-4 dark:border-slate-800 sm:px-6">
                <h2 class="break-words text-xl font-bold text-[#0b3a67] dark:text-white">
                    Edit Profile
                </h2>

                <button type="button" data-modal-close="editProfileModal" class="shrink-0 rounded-lg px-3 py-1 text-2xl leading-none text-gray-500 transition hover:bg-gray-100 dark:text-slate-300 dark:hover:bg-slate-800">
                    &times;
                </button>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="grid grid-cols-1 gap-5 p-4 sm:p-6 md:grid-cols-2">
                @csrf
                @method('PATCH')
                <input type="hidden" name="modal" value="profile">

                <div>
                    <label for="firstname" class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">First Name</label>
                    <input id="firstname" type="text" name="firstname" value="{{ old('firstname', $user->firstname) }}"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none transition focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    @error('firstname') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="surname" class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">Surname</label>
                    <input id="surname" type="text" name="surname" value="{{ old('surname', $user->surname) }}"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none transition focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    @error('surname') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="phone_number" class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">Phone</label>
                    <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" maxlength="11"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none transition focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    @error('phone_number') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="profile_picture" class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">Profile Picture</label>
                    <input id="profile_picture" type="file" name="profile_picture" accept=".jpg,.jpeg,.png,.gif"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none transition file:mr-4 file:rounded-lg file:border-0 file:bg-[#0b3a67] file:px-3 file:py-2 file:font-semibold file:text-white focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    @error('profile_picture') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col-reverse gap-3 sm:flex-row md:col-span-2">
                    <button type="button" data-modal-close="editProfileModal" class="w-full rounded-xl border border-gray-300 px-5 py-3 font-semibold text-[#0b3a67] transition hover:bg-gray-50 dark:border-slate-700 dark:text-white dark:hover:bg-slate-800 sm:w-auto">
                        Cancel
                    </button>
                    <button type="submit" class="w-full rounded-xl bg-[#ed1c24] px-5 py-3 font-semibold text-white transition hover:opacity-90 sm:w-auto">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Add Account Modal --}}
    <div id="accountModal" class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-black/50 px-3 py-4 sm:px-4 sm:py-8">
        <div class="max-h-[calc(100vh-2rem)] w-full max-w-xl overflow-y-auto rounded-2xl border border-gray-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-900">
            <div class="flex items-center justify-between gap-4 border-b border-gray-200 px-4 py-4 dark:border-slate-800 sm:px-6">
                <h2 class="break-words text-xl font-bold text-[#0b3a67] dark:text-white">
                    Add Account
                </h2>

                <button type="button" data-modal-close="accountModal" class="shrink-0 rounded-lg px-3 py-1 text-2xl leading-none text-gray-500 transition hover:bg-gray-100 dark:text-slate-300 dark:hover:bg-slate-800">
                    &times;
                </button>
            </div>

            <form method="POST" action="{{ route('profile.bank-accounts.store') }}" class="space-y-5 p-4 sm:p-6">
                @csrf
                <input type="hidden" name="modal" value="account">

                <div class="rounded-xl bg-gray-50 p-4 dark:bg-slate-950">
                    <p class="text-xs text-gray-500 dark:text-slate-400">Account Name</p>
                    <p class="mt-1 break-words font-semibold text-[#0b3a67] dark:text-white">
                        {{ $affiliateName }}
                    </p>
                    @error('account_name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="bank_name" class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">Bank Name</label>
                    <input id="bank_name" type="text" name="bank_name" value="{{ old('bank_name') }}" placeholder="Enter bank name"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none transition focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    @error('bank_name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="account_number" class="mb-2 block text-sm font-semibold text-[#0b3a67] dark:text-white">Account Number</label>
                    <input id="account_number" type="text" name="account_number" value="{{ old('account_number') }}" maxlength="10" inputmode="numeric" placeholder="0123456789"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 outline-none transition focus:border-[#0b3a67] focus:ring-2 focus:ring-[#0b3a67]/20 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    @error('account_number') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <label class="flex items-start gap-3 rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm font-semibold text-[#0b3a67] dark:border-slate-800 dark:bg-slate-950 dark:text-white">
                    <input type="checkbox" name="is_default" value="1" @checked(old('is_default')) class="mt-1 rounded border-gray-300 text-[#0b3a67] focus:ring-[#0b3a67]">
                    <span>Make default account</span>
                </label>

                <div class="flex flex-col-reverse gap-3 sm:flex-row">
                    <button type="button" data-modal-close="accountModal" class="w-full rounded-xl border border-gray-300 px-5 py-3 font-semibold text-[#0b3a67] transition hover:bg-gray-50 dark:border-slate-700 dark:text-white dark:hover:bg-slate-800 sm:w-auto">
                        Cancel
                    </button>
                    <button type="submit" class="w-full rounded-xl bg-[#ed1c24] px-5 py-3 font-semibold text-white transition hover:opacity-90 sm:w-auto">
                        Save Account
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function openModal(id) {
                const modal = document.getElementById(id);
                if (!modal) return;

                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            }

            function closeModal(id) {
                const modal = document.getElementById(id);
                if (!modal) return;

                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }

            document.querySelectorAll('[data-modal-open]').forEach(button => {
                button.addEventListener('click', function () {
                    openModal(this.dataset.modalOpen);
                });
            });

            document.querySelectorAll('[data-modal-close]').forEach(button => {
                button.addEventListener('click', function () {
                    closeModal(this.dataset.modalClose);
                });
            });

            document.querySelectorAll('#editProfileModal, #accountModal').forEach(modal => {
                modal.addEventListener('click', function (event) {
                    if (event.target === modal) {
                        closeModal(modal.id);
                    }
                });
            });

            const oldModal = @json(old('modal'));

            if (oldModal === 'profile') {
                openModal('editProfileModal');
            }

            if (oldModal === 'account') {
                openModal('accountModal');
            }
        });
    </script>

</x-dashboard-layout>