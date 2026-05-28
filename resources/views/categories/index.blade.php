<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                {{ __('Kelola Kategori') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-lg transition-all shadow-sm shadow-blue-500/30 hover:shadow-md hover:shadow-blue-500/40 hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Kategori
            </a>
        </div>
    </x-slot>

    <div x-data="{ showDeleteModal: false, deleteUrl: '' }" class="space-y-6 p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-lg mb-6 flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex items-center gap-3 bg-slate-50/50">
                <div class="w-8 h-8 rounded bg-purple-100 text-purple-600 flex items-center justify-center shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
                <h3 class="font-bold text-slate-800 text-lg">Daftar Kategori</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[400px]">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-sm border-b border-slate-100">
                            <th class="py-3 px-5 font-semibold tracking-wider w-12">#</th>
                            <th class="py-3 px-5 font-semibold tracking-wider">Nama Kategori</th>
                            <th class="py-3 px-5 font-semibold tracking-wider text-center">Jumlah Barang</th>
                            <th class="py-3 px-5 font-semibold tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($categories as $index => $category)
                            <tr class="border-b border-slate-50 hover:bg-slate-50/80 transition-colors group">
                                <td class="py-3 px-5 text-slate-400 font-mono text-xs">{{ $index + 1 }}</td>
                                <td class="py-3 px-5">
                                    <span class="font-bold text-slate-800 text-base">{{ $category->name }}</span>
                                </td>
                                <td class="py-3 px-5 text-center">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                        {{ $category->products_count }} barang
                                    </span>
                                </td>
                                <td class="py-3 px-5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('categories.edit', $category->id) }}" class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            Edit
                                        </a>
                                        <button type="button" @click="showDeleteModal = true; deleteUrl = '{{ route('categories.destroy', $category->id) }}'" class="inline-flex items-center gap-1 text-xs font-bold text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-10 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                        <p class="text-base font-medium text-slate-500">Belum ada kategori.</p>
                                        <p class="text-sm">Klik tombol "Tambah Kategori" untuk memulai.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Delete Modal -->
        <div x-cloak x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showDeleteModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" @click="showDeleteModal = false" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showDeleteModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm w-full border border-slate-100">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start flex-col sm:flex-row">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-bold text-slate-800">Konfirmasi Hapus</h3>
                                <div class="mt-2 text-sm text-slate-500">
                                    <p>Anda yakin ingin menghapus kategori ini? Barang dalam kategori ini tidak akan terhapus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:px-6 flex flex-col-reverse sm:flex-row sm:justify-end gap-2 sm:gap-3">
                        <button type="button" @click="showDeleteModal = false" class="w-full sm:w-auto inline-flex justify-center items-center rounded-lg border border-slate-200 px-4 py-2 bg-white text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors">Tidak</button>
                        <form :action="deleteUrl" method="POST" class="w-full sm:w-auto m-0 p-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex justify-center items-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-red-600 text-sm font-medium text-white hover:bg-red-700 transition-colors">Ya, Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
