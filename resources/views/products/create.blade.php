<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('products.index') }}" class="p-2 rounded-md text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                {{ __('Tambah Barang Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-6 p-4 sm:p-6 lg:p-8 max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-800">Informasi Barang</h3>
                <p class="text-sm text-slate-500 mt-1">Masukkan rincian barang baru yang ingin ditambahkan ke inventaris.</p>
            </div>
            
            <div class="p-6">
                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-lg mb-6">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="font-bold text-sm">Terdapat kesalahan pengisian:</span>
                        </div>
                        <ul class="list-disc list-inside text-sm pl-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <!-- Nama -->
                    <div>
                        <label for="name" class="block font-medium text-sm text-slate-700 mb-1">Nama Barang <span class="text-red-500">*</span></label>
                        <input id="name" class="block w-full border-slate-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-20 transition-colors" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Contoh: Sabun Mandi Lifebuoy" />
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category_id" class="block font-medium text-sm text-slate-700 mb-1">Kategori</label>
                        <select id="category_id" name="category_id" class="block w-full border-slate-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-20 transition-colors">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Harga & Stok (Grid) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="price" class="block font-medium text-sm text-slate-700 mb-1">Harga Satuan (Rp) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-slate-500 sm:text-sm font-medium">Rp</span>
                                </div>
                                <input id="price" class="block w-full pl-10 border-slate-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-20 transition-colors" type="number" name="price" value="{{ old('price') }}" required min="0" placeholder="10000" />
                            </div>
                        </div>
                        <div>
                            <label for="stock" class="block font-medium text-sm text-slate-700 mb-1">Stok Awal <span class="text-red-500">*</span></label>
                            <input id="stock" class="block w-full border-slate-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-20 transition-colors" type="number" name="stock" value="{{ old('stock', 0) }}" required min="0" placeholder="50" />
                        </div>
                    </div>

                    <!-- Gambar (dengan Drag & Drop dan Preview) -->
                    <div x-data="{ 
                            isDragging: false, 
                            previewUrl: null, 
                            handleDrop(e) {
                                this.isDragging = false;
                                if (e.dataTransfer.files.length > 0) {
                                    this.$refs.fileInput.files = e.dataTransfer.files;
                                    this.updatePreview(this.$refs.fileInput);
                                }
                            },
                            updatePreview(input) {
                                if (input.files && input.files[0]) {
                                    let reader = new FileReader();
                                    reader.onload = (e) => {
                                        this.previewUrl = e.target.result;
                                    };
                                    reader.readAsDataURL(input.files[0]);
                                }
                            },
                            clearPreview() {
                                this.previewUrl = null;
                                this.$refs.fileInput.value = '';
                            }
                        }">
                        <label for="image" class="block font-medium text-sm text-slate-700 mb-1">Foto Barang (Opsional)</label>
                        
                        <div 
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-lg bg-slate-50/50 hover:bg-slate-50 transition-colors relative group"
                            :class="isDragging ? 'border-blue-500 bg-blue-50' : 'border-slate-300'"
                            @dragover.prevent="isDragging = true"
                            @dragleave.prevent="isDragging = false"
                            @drop.prevent="handleDrop($event)"
                        >
                            <div class="space-y-1 text-center" x-show="!previewUrl">
                                <svg class="mx-auto h-12 w-12 text-slate-300 group-hover:text-blue-400 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-slate-600 justify-center">
                                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 px-1">
                                        <span>Upload file</span>
                                        <input id="image" x-ref="fileInput" name="image" type="file" class="sr-only" accept="image/*" @change="updatePreview($event.target)">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-slate-400">
                                    PNG, JPG up to 2MB
                                </p>
                            </div>
                            
                            <!-- Preview Template -->
                            <div x-show="previewUrl" class="w-full flex-col items-center justify-center" style="display: none;">
                                <div class="relative w-32 h-32 mx-auto mb-3 rounded-lg overflow-hidden border border-slate-200">
                                    <img :src="previewUrl" class="object-cover w-full h-full" alt="Preview" />
                                </div>
                                <button type="button" @click.prevent="clearPreview()" class="text-xs text-red-500 hover:text-red-700 font-medium">Hapus foto</button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 mt-6">
                        <a href="{{ route('products.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:text-slate-800 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm shadow-blue-500/30 transition-colors border border-transparent inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Simpan Barang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
