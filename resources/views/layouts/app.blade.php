<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kasir') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .ease-spring { transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: #94a3b8; }
    </style>
</head>
<body class="antialiased text-slate-800 bg-slate-50 flex h-screen overflow-hidden selection:bg-blue-600 selection:text-white" x-data="{ sidebarOpen: false }">
    
    @include('layouts.navigation')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden bg-slate-50 relative">
        
        <!-- Topbar -->
        <header class="bg-white/80 backdrop-blur-xl border-b border-slate-200/60 sticky top-0 z-30 flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16 transition-all shadow-sm shadow-slate-200/50">
            <div class="flex items-center gap-4">
                <!-- Mobile Menu Button -->
                <button @click="sidebarOpen = true" class="md:hidden p-2 text-slate-500 hover:text-blue-600 bg-slate-100/50 hover:bg-blue-50 focus:ring-2 focus:ring-blue-500 rounded-xl transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                
                @isset($header)
                    <div class="hidden sm:block">
                        {{ $header }}
                    </div>
                @endisset
            </div>

            <!-- Topbar Right Profile -->
            <div class="flex items-center gap-3">
                <!-- Notification Bell Dropdown -->
                @php
                    $notifications = Auth::user()->unreadNotifications->take(10);
                    $notifCount = $notifications->count();
                @endphp
                <div x-data="{ openNotif: false }" class="relative">
                    <button @click="openNotif = !openNotif" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-full transition relative focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        @if($notifCount > 0)
                            <span class="absolute top-0.5 right-0.5 w-4 h-4 bg-red-500 border-2 border-white rounded-full text-[9px] text-white font-bold flex items-center justify-center">{{ $notifCount > 9 ? '9+' : $notifCount }}</span>
                        @endif
                    </button>

                    <!-- Dropdown Panel -->
                    <div x-cloak x-show="openNotif" @click.away="openNotif = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-2xl border border-slate-100 overflow-hidden z-50" style="display:none;">
                        
                        <div class="px-4 py-3 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                            <h4 class="font-bold text-sm text-slate-800">Notifikasi</h4>
                            @if($notifCount > 0)
                                <form method="POST" action="{{ route('notifications.readAll') }}">
                                    @csrf
                                    <button type="submit" class="text-xs text-blue-600 hover:text-blue-800 font-medium">Tandai semua dibaca</button>
                                </form>
                            @endif
                        </div>

                        <div class="max-h-72 overflow-y-auto custom-scrollbar">
                            @forelse($notifications as $notification)
                                <form method="POST" action="{{ route('notifications.read', $notification->id) }}" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-3 hover:bg-blue-50 transition-colors border-b border-slate-50 flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0 mt-0.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-slate-800 leading-tight">{{ $notification->data['message'] ?? 'Notifikasi baru' }}</p>
                                            <p class="text-[11px] text-slate-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    </button>
                                </form>
                            @empty
                                <div class="px-4 py-8 text-center">
                                    <svg class="w-10 h-10 mx-auto text-slate-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                    <p class="text-sm text-slate-400 font-medium">Tidak ada notifikasi baru</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Profile Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 p-1.5 rounded-full hover:bg-slate-100 transition text-slate-600 border border-transparent focus:border-slate-200">
                            <span class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-500 text-white flex items-center justify-center font-bold text-sm shadow-md shadow-blue-500/20">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </span>
                            <span class="text-sm font-semibold hidden sm:block px-1">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-slate-400 hidden sm:block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-slate-700 font-medium hover:text-blue-600 hover:bg-blue-50/50 rounded-t-md px-4 py-2.5 flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            {{ __('Profile Saya') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-red-600 font-medium hover:text-red-700 hover:bg-red-50/50 rounded-b-md px-4 py-2.5 flex items-center gap-2 border-t border-slate-100">
                                <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto w-full custom-scrollbar selection:bg-blue-100">
            <!-- Mobile Header Fallback -->
            @isset($header)
                <div class="sm:hidden px-4 pt-6 pb-2 border-b border-slate-200">
                    {{ $header }}
                </div>
            @endisset
            
            {{ $slot }}
        </main>
    </div>
    @stack('scripts')
</body>
</html>
