<aside x-data="{ collapsed: localStorage.getItem('sidebar_collapsed') === 'true' }" 
       x-init="$watch('collapsed', val => localStorage.setItem('sidebar_collapsed', val))"
       :class="{'w-64': !collapsed, 'w-20': collapsed, '-translate-x-full': !sidebarOpen}"
       class="fixed md:relative inset-y-0 left-0 z-50 bg-white/90 backdrop-blur-2xl border-r border-slate-200/60 shadow-2xl md:shadow-none md:translate-x-0 flex flex-col transition-all duration-300 ease-spring">
    
    <!-- Sidebar Header -->
    <div class="h-16 flex items-center shrink-0" :class="collapsed ? 'justify-center' : 'justify-between px-4'">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 overflow-hidden" :class="collapsed ? 'justify-center w-full' : 'ml-1'">
            <!-- Cart Icon (Replaces Laravel Logo) -->
            <div class="w-9 h-9 rounded-lg bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center shadow-md shadow-blue-500/30 shrink-0 cursor-pointer" @click.prevent="if(collapsed) collapsed = false; else window.location.href='{{ route('dashboard') }}'">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
            </div>
            
            <span class="font-extrabold text-xl tracking-tighter bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent transition-opacity duration-300" 
                  :class="{'opacity-0 hidden': collapsed, 'opacity-100': !collapsed}">
                Toserba
            </span>
        </a>
        
        <!-- Toggle Collapse (Desktop Floating Button) -->
        <button @click="collapsed = !collapsed" 
                class="hidden md:flex items-center justify-center w-6 h-6 rounded-full bg-white border border-slate-200 text-slate-400 hover:text-blue-600 hover:border-blue-300 shadow-sm transition-all absolute -right-3 top-5 z-50 focus:outline-none focus:ring-2 focus:ring-blue-100">
            <svg class="w-3.5 h-3.5 transition-transform duration-300" :class="collapsed ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
        </button>

        <!-- Close Mobile -->
        <button @click="sidebarOpen = false" class="md:hidden p-1.5 text-slate-400 hover:bg-red-50 hover:text-red-500 rounded transition shrink-0" :class="collapsed ? 'hidden' : 'block'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 overflow-y-auto py-6 px-3 space-y-1 custom-scrollbar">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="flex items-center py-2.5 rounded-lg transition-all duration-200 group relative {{ request()->routeIs('dashboard') ? 'bg-blue-600 shadow-sm shadow-blue-500/20 text-white' : 'hover:bg-slate-100 hover:text-blue-600 text-slate-500' }}"
           :class="collapsed ? 'justify-center px-0' : 'px-3'">
            <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-105 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            <span class="ml-3 text-sm font-medium tracking-wide whitespace-nowrap {{ request()->routeIs('dashboard') ? 'text-white' : 'group-hover:text-blue-700' }}" :class="{'opacity-0 hidden': collapsed, 'opacity-100': !collapsed}">Dashboard</span>
            <div x-show="collapsed" style="display: none;" class="absolute left-14 bg-slate-800 text-white text-xs font-medium px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap z-50">Dashboard</div>
        </a>

        <!-- Barang -->
        <a href="{{ route('products.index') }}" 
           class="flex items-center py-2.5 rounded-lg transition-all duration-200 group relative {{ request()->routeIs('products.*') ? 'bg-blue-600 shadow-sm shadow-blue-500/20 text-white' : 'hover:bg-slate-100 hover:text-blue-600 text-slate-500' }}"
           :class="collapsed ? 'justify-center px-0' : 'px-3'">
            <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-105 {{ request()->routeIs('products.*') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            <span class="ml-3 text-sm font-medium tracking-wide whitespace-nowrap {{ request()->routeIs('products.*') ? 'text-white' : 'group-hover:text-blue-700' }}" :class="{'opacity-0 hidden': collapsed, 'opacity-100': !collapsed}">Kelola Barang</span>
            <div x-show="collapsed" style="display: none;" class="absolute left-14 bg-slate-800 text-white text-xs font-medium px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap z-50">Kelola Barang</div>
        </a>

        <!-- Kategori -->
        <a href="{{ route('categories.index') }}" 
           class="flex items-center py-2.5 rounded-lg transition-all duration-200 group relative {{ request()->routeIs('categories.*') ? 'bg-blue-600 shadow-sm shadow-blue-500/20 text-white' : 'hover:bg-slate-100 hover:text-blue-600 text-slate-500' }}"
           :class="collapsed ? 'justify-center px-0' : 'px-3'">
            <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-105 {{ request()->routeIs('categories.*') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            <span class="ml-3 text-sm font-medium tracking-wide whitespace-nowrap {{ request()->routeIs('categories.*') ? 'text-white' : 'group-hover:text-blue-700' }}" :class="{'opacity-0 hidden': collapsed, 'opacity-100': !collapsed}">Kelola Kategori</span>
            <div x-show="collapsed" style="display: none;" class="absolute left-14 bg-slate-800 text-white text-xs font-medium px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap z-50">Kelola Kategori</div>
        </a>

        <!-- Kasir -->
        <a href="{{ route('pos.index') }}" 
           class="flex items-center py-2.5 rounded-lg transition-all duration-200 group relative {{ request()->routeIs('pos.*') ? 'bg-blue-600 shadow-sm shadow-blue-500/20 text-white' : 'hover:bg-slate-100 hover:text-blue-600 text-slate-500' }}"
           :class="collapsed ? 'justify-center px-0' : 'px-3'">
            <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-105 {{ request()->routeIs('pos.*') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <span class="ml-3 text-sm font-medium tracking-wide whitespace-nowrap {{ request()->routeIs('pos.*') ? 'text-white' : 'group-hover:text-blue-700' }}" :class="{'opacity-0 hidden': collapsed, 'opacity-100': !collapsed}">Menu Kasir</span>
            <div x-show="collapsed" style="display: none;" class="absolute left-14 bg-slate-800 text-white text-xs font-medium px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap z-50">Menu Kasir</div>
        </a>
    </div>

    <!-- Bottom Decoration -->
    <div class="px-2 pb-4 border-t border-slate-200/60 transition-opacity duration-300 min-h-[100px] flex items-center justify-center" :class="collapsed ? 'opacity-0 invisible h-0' : 'opacity-100 visible p-4'">
        <div class="bg-slate-50 rounded-lg p-3 border border-slate-200 relative overflow-hidden w-full">
            <h4 class="text-xs font-bold text-slate-700 mb-1">Toserba POS Pro</h4>
            <p class="text-[10px] text-slate-500 font-medium leading-relaxed mb-2 w-full">Sistem point of sale cerdas & inventaris lengkap.</p>
            <div class="flex items-center justify-between mt-1">
                <span class="inline-flex items-center px-1.5 py-0.5 bg-slate-200 text-slate-600 text-[10px] font-bold rounded">v2026.1</span>
            </div>
        </div>
    </div>
</aside>

<!-- Mobile Overlay -->
<div x-show="sidebarOpen" 
     @click="sidebarOpen = false"
     x-transition.opacity.duration.300ms
     class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 md:hidden" style="display: none;"></div>
