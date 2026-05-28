<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight tracking-tight">
                {{ __('Pengaturan Profil') }}
            </h2>
            <div class="text-sm text-gray-500 font-medium">
                Kelola informasi akun Anda
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Grid Layout for Profile Info & Update Password -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                
                <!-- Profile Information Container -->
                <div class="bg-white border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-2xl transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)]">
                    <div class="p-6 sm:p-10 w-full">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password Container -->
                <div class="bg-white border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-2xl transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)]">
                    <div class="p-6 sm:p-10 w-full">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

            </div>

            <!-- Delete Account Container -->
            <div class="bg-red-50/30 border border-red-100 shadow-[0_8px_30px_rgb(239,68,68,0.06)] sm:rounded-2xl transition-all duration-300 hover:shadow-[0_8px_30px_rgb(239,68,68,0.12)] hover:border-red-200">
                <div class="p-6 sm:p-10 w-full md:max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
