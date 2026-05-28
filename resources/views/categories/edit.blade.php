<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('categories.index') }}" class="p-2 rounded-md text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                {{ __('Edit Kategori') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-6 p-4 sm:p-6 lg:p-8 max-w-xl mx-auto">
        <div class="bg-white rounded-lg shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-800">Ubah Kategori</h3>
                <p class="text-sm text-slate-500 mt-1">Perbarui nama kategori yang sudah ada.</p>
            </div>
            
            <div class="p-6">
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-lg mb-6">
                        <ul class="list-disc list-inside text-sm pl-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('categories.update', $category->id) }}" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="name" class="block font-medium text-sm text-slate-700 mb-1">Nama Kategori <span class="text-red-500">*</span></label>
                        <input id="name" class="block w-full border-slate-200 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-20 transition-colors" type="text" name="name" value="{{ old('name', $category->name) }}" required autofocus />
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 mt-6">
                        <a href="{{ route('categories.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">Batal</a>
                        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm shadow-blue-500/30 transition-colors inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Perbarui Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
