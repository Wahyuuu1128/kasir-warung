<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased overflow-hidden">
    <!-- Full Background with Image -->
    <div class="min-h-screen flex items-center justify-center relative bg-cover bg-center" style="background-image: url('{{ asset('images/warung-bg.png') }}');">
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

        <!-- Login Card -->
        <div class="relative z-10 w-full max-w-md bg-white rounded-2xl shadow-2xl p-8 mx-4 transform transition-all hover:scale-[1.01] duration-500">
            
            <!-- Branding -->
            <div class="flex flex-row items-center justify-center gap-3 mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Toserba" class="w-14 h-14 object-contain">
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight uppercase">Toserba</h1>
            </div>

            <div class="text-center mb-8">
                <p class="text-sm text-gray-500 font-medium">Selamat datang kembali! Silakan masuk ke akun Anda.</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div class="group relative">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1 transition-colors group-focus-within:text-blue-600">Email / Username</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:bg-white transition-all duration-300 shadow-sm hover:border-blue-400 hover:shadow-md sm:text-sm">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm font-medium" />
                </div>

                <!-- Password -->
                <div class="group relative">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1 transition-colors group-focus-within:text-blue-600">Password</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:bg-white transition-all duration-300 shadow-sm hover:border-blue-400 hover:shadow-md sm:text-sm">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm font-medium" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between pt-2">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition duration-200 cursor-pointer">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-600 cursor-pointer select-none">
                            Ingat saya
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-800 transition-colors duration-300">
                                Lupa password?
                            </a>
                        </div>
                    @endif
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 overflow-hidden transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg active:translate-y-0">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
