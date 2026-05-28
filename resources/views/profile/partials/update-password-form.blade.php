<section>
    <header>
        <h2 class="text-xl font-bold text-gray-900 tracking-tight">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500 font-medium">
            {{ __('Pastikan akun Anda menggunakan password yang acak dan panjang agar aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-gray-700 mb-1">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:bg-white transition-all duration-300 shadow-sm hover:border-blue-400 hover:shadow-md sm:text-sm">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-600 text-sm font-medium" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-gray-700 mb-1">Password Baru</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:bg-white transition-all duration-300 shadow-sm hover:border-blue-400 hover:shadow-md sm:text-sm">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-600 text-sm font-medium" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:bg-white transition-all duration-300 shadow-sm hover:border-blue-400 hover:shadow-md sm:text-sm">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-600 text-sm font-medium" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                Perbarui Password
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100"
                >Berhasil diubah.</p>
            @endif
        </div>
    </form>
</section>
