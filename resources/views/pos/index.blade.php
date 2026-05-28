<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Kasir (POS)') }}
        </h2>
    </x-slot>

    <!-- Hiding Scrollbars -->
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .qr-scan-animation {
            animation: scan 2s infinite;
        }
        @keyframes scan {
            0% { top: 0%; opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { top: 100%; opacity: 0; }
        }
    </style>

    <div class="space-y-6 p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto" x-data="pos({{ $products->toJson() }})">
        <div class="flex flex-col lg:flex-row gap-6">
            
            <!-- Left: Product List -->
            <div class="w-full lg:w-2/3 flex flex-col">
                <div class="bg-white rounded-lg shadow-sm border border-slate-100 p-5 flex-1 relative flex flex-col h-full min-h-[600px]">
                    <div class="flex justify-between items-center mb-4 pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-blue-100 text-blue-600 flex items-center justify-center shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            </div>
                            <h3 class="font-bold text-slate-800 text-lg">Pilih Barang</h3>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4 overflow-y-auto no-scrollbar content-start flex-1 absolute top-20 bottom-4 left-5 right-5 pb-4">
                        <template x-for="product in products" :key="product.id">
                            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 sm:p-4 flex flex-col items-center hover:bg-blue-50 hover:border-blue-200 hover:shadow-sm cursor-pointer transition-all duration-200 group relative" @click="addToCart(product)">
                                <!-- Add Badge Overlay -->
                                <div class="absolute inset-0 bg-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                                    <div class="bg-blue-600 text-white rounded-full p-2 shadow-lg transform scale-50 group-hover:scale-100 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </div>
                                </div>

                                <div class="w-20 h-20 sm:w-24 sm:h-24 mb-3 rounded-lg overflow-hidden bg-white border border-slate-100 shadow-sm shrink-0">
                                    <img x-show="product.image" :src="'/storage/' + product.image" class="w-full h-full object-cover">
                                    <div x-show="!product.image" class="w-full h-full flex items-center justify-center text-slate-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                </div>
                                <h4 class="font-bold text-slate-700 text-sm text-center leading-tight mb-1" x-text="product.name"></h4>
                                <p class="text-blue-600 font-extrabold text-sm" x-text="formatRupiah(product.price)"></p>
                            </div>
                        </template>
                        <template x-if="products.length === 0">
                            <div class="col-span-full py-12 text-center text-slate-500 flex flex-col items-center">
                                <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                Belum ada barang untuk dijual.
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Right: Cart Summary -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-lg shadow-sm border border-slate-100 p-5 flex flex-col h-full lg:h-[600px] sticky top-6">
                    <div class="flex justify-between items-center mb-4 pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-indigo-100 text-indigo-600 flex items-center justify-center shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <h3 class="font-bold text-slate-800 text-lg">Keranjang (<span x-text="cartTotalItems"></span>)</h3>
                        </div>
                        <button @click="if(confirm('Hapus semua barang di keranjang?')) cart = []" x-show="cart.length > 0" class="text-xs font-bold text-red-500 hover:text-red-700 hover:underline">Kosongkan</button>
                    </div>
                    
                    <!-- Cart Items -->
                    <div class="flex-1 overflow-y-auto no-scrollbar relative min-h-[200px]">
                        <template x-if="cart.length === 0">
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-slate-400">
                                <svg class="w-16 h-16 text-slate-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <p class="font-medium text-sm">Keranjang masih kosong</p>
                                <p class="text-xs mt-1">Silakan pilih barang di sebelah kiri</p>
                            </div>
                        </template>
                        
                        <div class="space-y-3 pb-4">
                            <template x-for="(item, index) in cart" :key="item.product_id">
                                <div class="bg-slate-50 border border-slate-100 rounded-lg p-3 flex flex-col gap-2 relative">
                                    <button @click="updateQty(index, -item.qty)" class="absolute top-2 right-2 text-slate-300 hover:text-red-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                    <div class="pr-6">
                                        <h4 class="font-bold text-slate-800 text-sm line-clamp-1" x-text="item.name"></h4>
                                        <p class="text-slate-500 text-xs mt-0.5" x-text="formatRupiah(item.price)"></p>
                                    </div>
                                    <div class="flex justify-between items-end mt-1">
                                        <div class="flex items-center gap-1 bg-white border border-slate-200 rounded p-0.5 shadow-sm">
                                            <button class="w-6 h-6 flex items-center justify-center rounded bg-slate-50 hover:bg-slate-200 text-slate-600 font-bold transition-colors" @click="updateQty(index, -1)">-</button>
                                            <span class="w-8 text-center text-xs font-bold text-slate-700" x-text="item.qty"></span>
                                            <button class="w-6 h-6 flex items-center justify-center rounded bg-blue-50 hover:bg-blue-200 text-blue-700 font-bold transition-colors" @click="updateQty(index, 1)">+</button>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-extrabold text-blue-600 text-sm" x-text="formatRupiah(item.subtotal)"></p>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Cart Footer / Quick Stats -->
                    <div class="mt-4 pt-4 border-t border-slate-200">
                        <div class="flex justify-between items-center mb-4 bg-slate-50 p-3 rounded-lg border border-slate-100">
                            <span class="font-bold text-slate-600 text-sm">TOTAL TAGIHAN</span>
                            <span class="font-black text-2xl text-blue-600 tracking-tight" x-text="formatRupiah(total)"></span>
                        </div>

                        <button @click="openPaymentModal()" 
                            :disabled="cart.length === 0"
                            class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 border border-transparent rounded-lg shadow-md shadow-blue-500/30 py-3.5 px-4 text-white font-bold hover:from-blue-700 hover:to-indigo-700 hover:-translate-y-0.5 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none disabled:shadow-none flex items-center justify-center gap-2">
                            Lanjutkan ke Pembayaran
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ======================= -->
        <!-- PAYMENT MODAL           -->
        <!-- ======================= -->
        <div x-cloak x-show="showPaymentModal" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
                <div x-show="showPaymentModal" x-transition.opacity @click="showPaymentModal = false; paymentMethod = 'CASH'" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>

                <div x-show="showPaymentModal" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 scale-95" 
                     x-transition:enter-end="opacity-100 scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 scale-100" 
                     x-transition:leave-end="opacity-0 scale-95" 
                     class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl w-full border border-slate-100">
                    
                    <div class="flex flex-col md:flex-row h-full">
                        <!-- Left: Order Summary -->
                        <div class="w-full md:w-5/12 bg-slate-50 p-6 sm:p-8 flex flex-col border-b md:border-b-0 md:border-r border-slate-200 max-h-[40vh] md:max-h-none overflow-y-auto">
                            <h3 class="font-bold text-slate-800 text-xl mb-6 flex items-center gap-2">
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Rincian Pesanan
                            </h3>
                            
                            <div class="flex-1 overflow-y-auto no-scrollbar space-y-4 mb-6 pr-2">
                                <template x-for="(item, index) in cart" :key="index">
                                    <div class="flex justify-between items-start text-sm">
                                        <div class="pr-2">
                                            <span class="font-bold text-slate-800" x-text="item.name"></span>
                                            <div class="text-slate-500 text-xs mt-0.5" x-text="item.qty + ' x ' + formatRupiah(item.price)"></div>
                                        </div>
                                        <div class="font-bold text-slate-700" x-text="formatRupiah(item.subtotal)"></div>
                                    </div>
                                </template>
                            </div>

                            <div class="mt-auto pt-4 border-t border-slate-200 border-dashed">
                                <div class="flex justify-between items-center bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                                    <span class="font-bold text-slate-500 text-sm uppercase tracking-wide">Total Pembayaran</span>
                                    <span class="font-black text-2xl text-blue-600" x-text="formatRupiah(total)"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Payment Action -->
                        <div class="w-full md:w-7/12 p-6 sm:p-8 bg-white flex flex-col relative">
                            <!-- Close Button -->
                            <button @click="showPaymentModal = false; paymentMethod = 'CASH'" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 bg-slate-50 hover:bg-slate-100 rounded-full p-2 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>

                            <h3 class="font-bold text-slate-800 text-xl mb-6">Metode Pembayaran</h3>
                            
                            <!-- Method Toggle -->
                            <div class="grid grid-cols-2 gap-3 mb-8 bg-slate-100 p-1.5 rounded-xl">
                                <button type="button" @click="paymentMethod = 'CASH'; updateChange()" class="py-2.5 px-4 rounded-lg font-bold text-sm transition-all flex items-center justify-center gap-2" :class="paymentMethod === 'CASH' ? 'bg-white text-blue-600 shadow-sm border border-slate-200/50' : 'text-slate-500 hover:text-slate-700'">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Tunai (Cash)
                                </button>
                                <button type="button" @click="paymentMethod = 'QR'; paid = total; updateChange()" class="py-2.5 px-4 rounded-lg font-bold text-sm transition-all flex items-center justify-center gap-2" :class="paymentMethod === 'QR' ? 'bg-white text-indigo-600 shadow-sm border border-slate-200/50' : 'text-slate-500 hover:text-slate-700'">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                    QRIS / Transfer
                                </button>
                            </div>

                            <!-- CASH SECTION -->
                            <div x-show="paymentMethod === 'CASH'" x-collapse>
                                <div class="mb-4">
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Uang Diterima (Rp)</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <span class="font-bold text-slate-500 text-xl">Rp</span>
                                        </div>
                                        <input type="number" x-model.number="paid" @input="updateChange()" class="block w-full pl-14 pr-4 py-4 rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-20 text-3xl font-black text-slate-800 transition-colors" min="0">
                                    </div>
                                </div>
                                
                                <!-- Quick Amount Templates -->
                                <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 mb-6">
                                    <button type="button" @click="paid = total; updateChange()" class="py-2 border border-slate-200 rounded-lg text-sm font-bold text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-colors bg-white">Uang Pas</button>
                                    <button type="button" @click="setPaid(20000)" class="py-2 border border-slate-200 rounded-lg text-sm font-bold text-teal-600 hover:bg-teal-50 hover:border-teal-200 transition-colors bg-white shadow-sm shadow-teal-500/5">20.000</button>
                                    <button type="button" @click="setPaid(50000)" class="py-2 border border-blue-200 rounded-lg text-sm font-bold text-blue-600 hover:bg-blue-50 hover:border-blue-300 transition-colors bg-white shadow-sm shadow-blue-500/5">50.000</button>
                                    <button type="button" @click="setPaid(100000)" class="py-2 border border-rose-200 rounded-lg text-sm font-bold text-rose-600 hover:bg-rose-50 hover:border-rose-300 transition-colors bg-white shadow-sm shadow-rose-500/5">100.000</button>
                                </div>

                                <!-- Change Summary -->
                                <div class="p-5 rounded-xl flex justify-between items-center transition-colors border" :class="change < 0 ? 'bg-red-50 border-red-100' : 'bg-green-50 border-green-200'">
                                    <span class="font-bold text-sm" :class="change < 0 ? 'text-red-700' : 'text-green-700'">Kembalian</span>
                                    <span class="font-black text-2xl" :class="change < 0 ? 'text-red-600' : 'text-green-600'" x-text="formatRupiah(Math.max(0, change))"></span>
                                </div>
                                <div x-show="change < 0" class="text-red-500 text-xs font-medium mt-2 text-right">Uang pembeli masih kurang.</div>
                            </div>

                            <!-- QR SECTION -->
                            <div x-show="paymentMethod === 'QR'" x-collapse style="display: none;">
                                <div class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-indigo-200 rounded-xl bg-indigo-50/50">
                                    <div class="relative w-48 h-48 bg-white p-3 rounded-xl shadow-sm border border-slate-200 mb-4 overflow-hidden">
                                        <!-- Dummy QR Visual -->
                                        <svg class="w-full h-full text-slate-800" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M3 3h8v8H3V3zm2 2v4h4V5H5zm10-2h8v8h-8V3zm2 2v4h4V5h-4zM3 13h8v8H3v-8zm2 2v4h4v-4H5zm13-2h-3v3h3v-3zm-3 5v3h3v-3h-3zm5-5h3v8h-3v-8zM14 13h2v2h-2v-2zm-2 2h2v2h-2v-2zm-2 2h2v2h-2v-2zm-2 2h2v2h-2v-2zm4 0h6v2h-6v-2z"></path>
                                        </svg>
                                        <!-- Scanner animation -->
                                        <div class="absolute left-0 right-0 h-1 bg-green-400 shadow-[0_0_8px_rgba(74,222,128,0.8)] qr-scan-animation"></div>
                                    </div>
                                    <p class="text-center text-slate-600 font-medium text-sm mb-1">Minta pembeli scan kode QR di atas</p>
                                    <p class="text-center font-bold text-indigo-600 text-lg">Total: <span x-text="formatRupiah(total)"></span></p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-auto pt-8">
                                <button @click="processTransaction()" 
                                    :disabled="isProcessing || cart.length === 0 || (paymentMethod === 'CASH' && change < 0)"
                                    class="w-full border border-transparent rounded-xl shadow-lg py-4 px-4 text-white font-bold text-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all flex items-center justify-center gap-2 group"
                                    :class="paymentMethod === 'QR' ? 'bg-indigo-600 hover:bg-indigo-700 shadow-indigo-500/30' : 'bg-green-600 hover:bg-green-700 shadow-green-500/30 disabled:bg-slate-300 disabled:shadow-none disabled:cursor-not-allowed'">
                                    
                                    <!-- Idle State -->
                                    <template x-if="!isProcessing">
                                        <span class="flex items-center gap-2">
                                            <span x-text="paymentMethod === 'QR' ? 'Pembayaran Selesai' : 'Proses Pesanan'"></span>
                                            <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </span>
                                    </template>
                                    
                                    <!-- Loading State -->
                                    <template x-if="isProcessing">
                                        <span class="flex items-center gap-2">
                                            <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                            Memproses...
                                        </span>
                                    </template>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ======================= -->
        <!-- SUCCESS MODAL           -->
        <!-- ======================= -->
        <div x-cloak x-show="showSuccessModal" style="display: none;" class="fixed inset-0 z-[110] overflow-y-auto" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
                <div x-show="showSuccessModal" class="fixed inset-0 bg-slate-900/80 backdrop-blur-md transition-opacity" aria-hidden="true"></div>

                <div x-show="showSuccessModal" 
                     x-transition:enter="ease-out duration-500" 
                     x-transition:enter-start="opacity-0 scale-50" 
                     x-transition:enter-end="opacity-100 scale-100" 
                     class="inline-block align-bottom bg-white rounded-3xl text-center overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full border border-slate-100 p-8 sm:p-10 relative">
                    
                    <!-- decorative bg effects -->
                    <div class="absolute -top-10 -left-10 w-40 h-40 bg-green-100 rounded-full blur-3xl pointer-events-none opacity-50"></div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-100 rounded-full blur-3xl pointer-events-none opacity-50"></div>

                    <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100 mb-6 relative z-10">
                        <svg class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                    </div>
                    
                    <h3 class="text-3xl font-black text-slate-800 mb-2 relative z-10">Transaksi Berhasil!</h3>
                    <p class="text-slate-500 font-medium mb-8 relative z-10">Pembayaran telah diterima dan pesanan tersimpan disistem.</p>
                    
                    <div x-show="!showWaInput" x-transition.opacity class="flex flex-col gap-3 relative z-10">
                        <button type="button" @click="printReceipt()" class="w-full py-4 px-6 rounded-xl border border-transparent shadow-md bg-blue-600 text-white font-bold text-lg hover:bg-blue-700 hover:-translate-y-1 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 flex items-center justify-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Cetak Struk Asli
                        </button>

                        <button type="button" @click="showWaInput = true" style="background-color: #25D366;" class="w-full py-4 px-6 rounded-xl border border-transparent shadow-md text-white font-bold text-lg hover:-translate-y-1 transition-transform focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 flex items-center justify-center gap-2">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.012 2c5.506 0 9.99 4.475 9.99 9.98 0 5.506-4.484 9.99-9.99 9.99a9.96 9.96 0 0 1-5.1-1.402l-4.996 1.309 1.328-4.868A9.92 9.92 0 0 1 2.022 11.98C2.022 6.475 6.505 2 12.012 2zm3.178 13.565c-.172.482-.999.914-1.432.966-.356.042-.81-.035-2.613-.746-2.155-.85-3.528-3.048-3.633-3.189-.104-.14-.868-1.155-.868-2.203 0-1.047.545-1.564.739-1.782.193-.217.42-.27.56-.27h.396c.14 0 .324-.053.513.411.192.463.56 1.37.611 1.474.053.104.088.228.018.368-.07.139-.105.227-.21.348-.105.121-.225.263-.314.368-.104.121-.213.253-.087.472.126.216.564.929 1.21 1.503.834.74 1.528.966 1.737 1.07.21.105.334.087.457-.053.123-.139.526-.612.666-.822.14-.21.28-.175.474-.105.193.07 1.226.577 1.436.682.21.105.352.157.404.244.053.088.053.508-.119.99z" /></svg>
                            Kirim Struk via WA
                        </button>

                        <button type="button" @click="finishTransaction()" class="w-full py-4 px-6 mt-2 rounded-xl border-2 border-slate-200 bg-white text-slate-700 font-bold text-lg hover:bg-slate-50 hover:border-slate-300 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
                            Selesai & Tutup
                        </button>
                    </div>

                    <!-- Tampilan Input WA (Menggantikan Tombol) -->
                    <div x-cloak x-show="showWaInput" x-transition.opacity class="text-left bg-slate-50 p-6 rounded-2xl border border-slate-200 relative z-10 w-full mt-2">
                        <h4 class="font-bold text-slate-800 text-lg mb-2">Kirim via WhatsApp</h4>
                        <p class="text-sm text-slate-500 mb-6" style="margin-bottom: 1.5rem;">Masukkan nomor HP pembeli. Kosongkan jika ingin memilih kontak manual.</p>
                        
                        <div class="relative" style="margin-bottom: 1.5rem;">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-6 h-6 text-slate-400" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.012 2c5.506 0 9.99 4.475 9.99 9.98 0 5.506-4.484 9.99-9.99 9.99a9.96 9.96 0 0 1-5.1-1.402l-4.996 1.309 1.328-4.868A9.92 9.92 0 0 1 2.022 11.98C2.022 6.475 6.505 2 12.012 2zm3.178 13.565c-.172.482-.999.914-1.432.966-.356.042-.81-.035-2.613-.746-2.155-.85-3.528-3.048-3.633-3.189-.104-.14-.868-1.155-.868-2.203 0-1.047.545-1.564.739-1.782.193-.217.42-.27.56-.27h.396c.14 0 .324-.053.513.411.192.463.56 1.37.611 1.474.053.104.088.228.018.368-.07.139-.105.227-.21.348-.105.121-.225.263-.314.368-.104.121-.213.253-.087.472.126.216.564.929 1.21 1.503.834.74 1.528.966 1.737 1.07.21.105.334.087.457-.053.123-.139.526-.612.666-.822.14-.21.28-.175.474-.105.193.07 1.226.577 1.436.682.21.105.352.157.404.244.053.088.053.508-.119.99z" /></svg>
                            </div>
                            <input type="tel" x-model="waPhone" @keydown.enter="processSendWA()" class="block w-full pr-4 py-3 border border-slate-300 rounded-xl shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-20 font-bold text-slate-800 transition-colors" placeholder="Contoh: 0812345678" style="padding-left: 3.5rem;">
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 mt-2">
                            <button type="button" @click="showWaInput = false" class="py-3 px-5 rounded-xl border-2 border-slate-200 bg-white font-bold text-slate-600 hover:bg-slate-50 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-300">
                                Kembali
                            </button>
                            <button type="button" @click="processSendWA()" style="background-color: #25D366;" class="py-3 px-6 rounded-xl shadow-md text-white font-bold hover:-translate-y-0.5 transition-transform flex items-center gap-2 focus:outline-none focus:ring-2 focus:ring-green-500 border border-transparent">
                                Kirim WA
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </div>
            </div>
        </div>

    </div>

    <!-- Alpine Component Logic -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('pos', (initialProducts) => ({
                products: initialProducts,
                cart: [],
                paid: 0,
                change: 0,
                
                // UI States
                showPaymentModal: false,
                showSuccessModal: false,
                showWaInput: false,
                waPhone: '',
                paymentMethod: 'CASH', // 'CASH' or 'QR'
                isProcessing: false,
                lastTransactionId: null,

                get total() {
                    return this.cart.reduce((sum, item) => sum + item.subtotal, 0);
                },

                get cartTotalItems() {
                    return this.cart.reduce((sum, item) => sum + item.qty, 0);
                },

                addToCart(product) {
                    const existingIndex = this.cart.findIndex(i => i.product_id === product.id);
                    if (existingIndex > -1) {
                        this.cart[existingIndex].qty++;
                        this.cart[existingIndex].subtotal = this.cart[existingIndex].qty * this.cart[existingIndex].price;
                    } else {
                        this.cart.push({
                            product_id: product.id,
                            name: product.name,
                            price: product.price,
                            qty: 1,
                            subtotal: product.price
                        });
                    }
                    this.updateChange();
                },

                updateQty(index, changeVal) {
                    this.cart[index].qty += changeVal;
                    if (this.cart[index].qty <= 0) {
                        this.cart.splice(index, 1);
                    } else {
                        this.cart[index].subtotal = this.cart[index].qty * this.cart[index].price;
                    }
                    if(this.cart.length === 0) {
                        this.showPaymentModal = false;
                    }
                    this.updateChange();
                },

                formatRupiah(number) {
                    return 'Rp ' + (number || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                },

                setPaid(amount) {
                    this.paid = amount;
                    this.updateChange();
                },

                updateChange() {
                    // Update change based on method constraints
                    if (this.paymentMethod === 'QR') {
                        this.paid = this.total;
                    }
                    this.change = this.paid - this.total;
                },

                openPaymentModal() {
                    this.paymentMethod = 'CASH';
                    this.paid = 0;
                    this.change = -this.total;
                    this.showPaymentModal = true;
                },

                async processTransaction() {
                    if (this.cart.length === 0) return;
                    if (this.paymentMethod === 'CASH' && this.change < 0) return;

                    this.isProcessing = true;

                    try {
                        const response = await fetch('{{ route('pos.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                total: this.total,
                                paid: this.paid,
                                change: Math.max(0, this.change),
                                items: this.cart
                            })
                        });

                        const data = await response.json();
                        this.isProcessing = false;
                        
                        if (response.ok) {
                            this.lastTransactionId = data.transaction_id;
                            this.showPaymentModal = false;
                            
                            // Let the animation finish before showing success modal
                            setTimeout(() => {
                                this.showSuccessModal = true;
                            }, 300);

                        } else {
                            alert('Terjadi kesalahan: ' + (data.message || 'Gagal menyimpan transaksi'));
                        }
                    } catch (error) {
                        this.isProcessing = false;
                        alert('Terjadi kesalahan jaringan.');
                    }
                },

                printReceipt() {
                    if(this.lastTransactionId) {
                        // Open receipt in new tab and auto print
                        window.open(`/pos/receipt/${this.lastTransactionId}`, '_blank');
                    }
                },

                processSendWA() {
                    let phone = this.waPhone;
                    this.showWaInput = false; // close the input form, go back to buttons
                    
                    let number = phone.replace(/\D/g, ''); // strip out non-digits
                    if (number.startsWith('0')) {
                        number = '62' + number.substring(1); // convert 0 to 62 (Indonesia)
                    }
                    
                    let text = `*TOSERBA JAYA*\n_Sistem Point of Sale_\n\n`;
                    text += `*STRUK PEMBELIAN*\n`;
                    if(this.lastTransactionId) text += `ID Transaksi: #TX-${this.lastTransactionId}\n`;
                    text += `Tanggal: ${new Date().toLocaleString('id-ID')}\n`;
                    text += `--------------------------------\n`;
                    
                    this.cart.forEach(item => {
                        text += `▪ ${item.name}\n  ${item.qty} x ${this.formatRupiah(item.price)} = *${this.formatRupiah(item.subtotal)}*\n`;
                    });
                    
                    text += `--------------------------------\n`;
                    text += `*TotalTagihan : ${this.formatRupiah(this.total)}*\n`;
                    if (this.paymentMethod === 'CASH') {
                        text += `Tunai Diterima : ${this.formatRupiah(this.paid)}\n`;
                        text += `Kembalian      : ${this.formatRupiah(this.change)}\n`;
                    } else {
                        text += `Metode Bayar   : QRIS / Transfer\n`;
                    }
                    text += `\n_Terima kasih telah berbelanja di tempat kami!_\n🙏😊`;
                    
                    let url = `https://wa.me/${number}?text=${encodeURIComponent(text)}`;
                    window.open(url, '_blank');
                },

                finishTransaction() {
                    // Reset and close
                    this.showSuccessModal = false;
                    this.showWaInput = false;
                    this.cart = [];
                    this.paid = 0;
                    this.change = 0;
                    this.lastTransactionId = null;
                }
            }));
        });
    </script>
</x-app-layout>
