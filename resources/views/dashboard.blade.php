<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        /* Sembunyikan scrollbar tapi tetap bisa di-scroll horizontal */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <!-- Wrapper utama dengan margin/padding dari layar tepi -->
    <div class="space-y-6 p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        
        <!-- Greetings Section -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between shadow-md shadow-blue-500/20 text-white relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="relative z-10">
                <h3 class="text-2xl font-bold mb-1">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                <p class="text-blue-100 text-sm sm:text-base">Berikut adalah ringkasan performa Toserba Anda minggu ini.</p>
            </div>
            <div class="mt-5 md:mt-0 relative z-10 w-full md:w-auto">
                <a href="{{ route('pos.index') }}" class="flex justify-center items-center gap-2 bg-white text-blue-600 px-5 py-3 rounded-lg font-bold hover:bg-slate-50 transition-colors shadow-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 w-full md:w-auto">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Buka Kasir Sekarang
                </a>
            </div>
        </div>

        <!-- Stats Section (Mobile Horizontal Scrollable) -->
        <div class="flex sm:grid sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 overflow-x-auto no-scrollbar pb-2 sm:pb-0 snap-x snap-mandatory">
            
            <!-- Total Products -->
            <div class="min-w-[80vw] sm:min-w-0 bg-white rounded-lg shadow-sm border border-slate-100 p-5 sm:p-6 flex items-center justify-between transition-transform duration-300 hover:-translate-y-1 hover:shadow-md shrink-0 snap-center">
                <div>
                    <h3 class="text-slate-500 text-sm font-medium mb-1">Total Barang</h3>
                    <p class="text-2xl sm:text-3xl font-bold text-slate-800">{{ $totalProducts }} <span class="text-xs sm:text-sm font-medium text-slate-400">item</span></p>
                </div>
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-md bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
            </div>
            
            <!-- Today Transactions -->
            <div class="min-w-[80vw] sm:min-w-0 bg-white rounded-lg shadow-sm border border-slate-100 p-5 sm:p-6 flex items-center justify-between transition-transform duration-300 hover:-translate-y-1 hover:shadow-md shrink-0 snap-center">
                <div>
                    <h3 class="text-slate-500 text-sm font-medium mb-1">Transaksi Hari Ini</h3>
                    <p class="text-2xl sm:text-3xl font-bold text-slate-800">{{ $todayTransactions }} <span class="text-xs sm:text-sm font-medium text-slate-400">struk</span></p>
                </div>
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-md bg-indigo-50 flex items-center justify-center text-indigo-600 shrink-0">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
            </div>
            
            <!-- Today Revenue -->
            <div class="min-w-[80vw] sm:min-w-0 bg-white rounded-lg shadow-sm border border-slate-100 p-5 sm:p-6 flex items-center justify-between transition-transform duration-300 hover:-translate-y-1 hover:shadow-md shrink-0 snap-center relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-green-50/50 rounded-full blur-xl z-0 pointer-events-none"></div>
                <div class="relative z-10">
                    <h3 class="text-slate-500 text-sm font-medium mb-1">Pendapatan Hari Ini</h3>
                    <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-green-600">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-md bg-green-50 flex items-center justify-center text-green-600 relative z-10 shrink-0 ml-2">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Charts Section (Mobile Horizontal Scrollable) -->
        <div class="flex lg:grid lg:grid-cols-2 gap-4 sm:gap-6 pb-2 overflow-x-auto no-scrollbar snap-x snap-mandatory">
            <!-- Revenue Chart -->
            <div class="min-w-[90vw] lg:min-w-0 bg-white rounded-lg shadow-sm border border-slate-100 p-5 sm:p-6 shrink-0 snap-center">
                <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                    <h3 class="font-bold text-slate-800 text-base sm:text-lg">Grafik Pendapatan</h3>
                    <span class="text-[10px] sm:text-xs font-medium text-slate-400 bg-slate-100 px-2 py-1 rounded">7 Hari Terakhir</span>
                </div>
                <div class="w-full h-64 sm:h-72">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- Sales Count Chart -->
            <div class="min-w-[90vw] lg:min-w-0 bg-white rounded-lg shadow-sm border border-slate-100 p-5 sm:p-6 shrink-0 snap-center">
                <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                    <h3 class="font-bold text-slate-800 text-base sm:text-lg">Grafik Transaksi</h3>
                    <span class="text-[10px] sm:text-xs font-medium text-slate-400 bg-slate-100 px-2 py-1 rounded">7 Hari Terakhir</span>
                </div>
                <div class="w-full h-64 sm:h-72">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Extra Feature: Recent Transactions Table -->
        <div class="bg-white rounded-lg shadow-sm border border-slate-100 overflow-hidden mb-8">
            <div class="p-5 sm:p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded bg-blue-100 text-blue-600 flex items-center justify-center shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-base sm:text-lg">Transaksi Terbaru (Real-time)</h3>
                </div>
                <a href="{{ route('pos.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline px-2 py-1 bg-blue-50 rounded transition-colors hidden sm:inline-block">Kembali ke Kasir</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[500px]">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-xs sm:text-sm border-b border-slate-100">
                            <th class="py-3 px-5 sm:p-4 font-semibold uppercase tracking-wider">ID Transaksi</th>
                            <th class="py-3 px-5 sm:p-4 font-semibold uppercase tracking-wider">Tanggal & Waktu</th>
                            <th class="py-3 px-5 sm:p-4 font-semibold uppercase tracking-wider text-right">Nilai Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs sm:text-sm">
                        @forelse($recentTransactions as $transaction)
                        <tr class="border-b border-slate-50 hover:bg-slate-50 transition-colors group">
                            <td class="py-3 px-5 sm:p-4 font-semibold text-slate-700">
                                <span class="bg-indigo-50 text-indigo-700 px-2 py-1 rounded font-mono text-xs">#TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="py-3 px-5 sm:p-4 text-slate-500 flex items-center gap-2">
                                <svg class="w-4 h-4 text-slate-300 group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $transaction->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="py-3 px-5 sm:p-4 text-right font-bold text-green-600">
                                Rp {{ number_format($transaction->total, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="p-8 text-center text-slate-400">
                                <svg class="w-12 h-12 mx-auto text-slate-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                Belum ada transaksi yang tercatat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const labels = {!! json_encode($labels) !!};
            const revenueData = {!! json_encode($revenueData) !!};
            const salesData = {!! json_encode($salesData) !!};

            // Setup proper Chart defaults
            Chart.defaults.font.family = "'Inter', sans-serif";
            Chart.defaults.color = '#64748b'; // slate-500

            // Revenue Chart (Area Line)
            const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
            
            // Create Gradient
            const gradientRevenue = ctxRevenue.createLinearGradient(0, 0, 0, 300);
            gradientRevenue.addColorStop(0, 'rgba(37, 99, 235, 0.2)'); // blue-600 lighter
            gradientRevenue.addColorStop(1, 'rgba(37, 99, 235, 0)');

            new Chart(ctxRevenue, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: revenueData,
                        borderColor: '#2563eb', // blue-600
                        backgroundColor: gradientRevenue,
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#2563eb',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 12,
                            titleFont: { size: 12, weight: 'normal' },
                            bodyFont: { size: 14, weight: 'bold' },
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return ' Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    if(value === 0) return 0;
                                    return value >= 1000 ? (value/1000) + 'k' : value;
                                },
                                font: { size: 11 }
                            },
                            grid: { borderDash: [4, 4], color: '#f1f5f9' },
                            border: { display: false }
                        },
                        x: { 
                            grid: { display: false },
                            ticks: { font: { size: 11 }, maxRotation: 45, minRotation: 0 },
                            border: { display: false }
                        }
                    },
                    interaction: { intersect: false, mode: 'index' },
                }
            });

            // Sales Chart (Bar)
            const ctxSales = document.getElementById('salesChart').getContext('2d');
            
            // Create Gradient for Bars
            const gradientSales = ctxSales.createLinearGradient(0, 0, 0, 300);
            gradientSales.addColorStop(0, '#6366f1'); // indigo-500
            gradientSales.addColorStop(1, '#818cf8'); // indigo-400

            new Chart(ctxSales, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Transaksi',
                        data: salesData,
                        backgroundColor: gradientSales,
                        hoverBackgroundColor: '#4f46e5',
                        borderRadius: 6,
                        borderSkipped: false,
                        barPercentage: 0.5,
                        categoryPercentage: 0.8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 12,
                            titleFont: { size: 12, weight: 'normal' },
                            bodyFont: { size: 14, weight: 'bold' },
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1, font: { size: 11 } },
                            grid: { borderDash: [4, 4], color: '#f1f5f9' },
                            border: { display: false }
                        },
                        x: { 
                            grid: { display: false },
                            ticks: { font: { size: 11 }, maxRotation: 45, minRotation: 0 },
                            border: { display: false }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
