<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-red-600 tracking-tight">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-red-500/80 font-medium">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-6 py-3 border border-red-200 rounded-xl shadow-sm text-sm font-bold text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-md"
    >
        Hapus Akun Permanen
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-white rounded-2xl">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-gray-900 tracking-tight">
                {{ __('Apakah Anda yakin ingin menghapus akun ini?') }}
            </h2>

            <p class="mt-2 text-sm text-gray-500 font-medium">
                {{ __('Setelah akun dihapus, tidak ada jalan kembali. Demi keamanan, silakan masukkan password Anda untuk mengonfirmasi.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">Password</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 focus:bg-white transition-all duration-300 shadow-sm hover:border-red-400 sm:text-sm"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-600 text-sm font-medium" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="inline-flex items-center px-5 py-2.5 border border-gray-300 rounded-xl shadow-sm text-sm font-bold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                    Batal
                </button>

                <button type="submit" class="inline-flex items-center px-5 py-2.5 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 transform hover:-translate-y-0.5">
                    Ya, Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
