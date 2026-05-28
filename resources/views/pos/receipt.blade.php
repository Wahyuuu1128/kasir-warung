<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace; /* Monospace is best for thermal */
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }
        .receipt-container {
            width: 80mm; /* Standard thermal printer width */
            margin: 0 auto;
            padding: 10px;
            box-sizing: border-box;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .font-bold { font-weight: bold; }
        .border-t { border-top: 1px dashed #000; }
        .border-b { border-bottom: 1px dashed #000; }
        .mb-1 { margin-bottom: 5px; }
        .mb-2 { margin-bottom: 10px; }
        .mt-1 { margin-top: 5px; }
        .mt-2 { margin-top: 10px; }
        .py-1 { padding-top: 5px; padding-bottom: 5px; }
        .py-2 { padding-top: 10px; padding-bottom: 10px; }
        .flex { display: flex; }
        .justify-between { justify-content: space-between; }
        
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 4px 0; vertical-align: top; }
        
        .header { margin-bottom: 15px; }
        .header h1 { margin: 0 0 5px 0; font-size: 18px; text-transform: uppercase; }
        .header p { margin: 0; font-size: 12px; }

        .items-table td.qty { width: 20%; }
        .items-table td.desc { width: 50%; }
        .items-table td.amount { width: 30%; text-align: right; }

        .totals { margin-top: 10px; }
        
        .footer { margin-top: 20px; font-size: 12px; }

        /* Print Specifics */
        @media print {
            body { background: none; }
            @page { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="setTimeout(function(){ window.print(); }, 500);">
    
    <div class="receipt-container">
        
        <!-- Action Button for Web View -->
        <div class="text-center mb-2 no-print">
            <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; background-color: #2563eb; color: white; border: none; border-radius: 5px; cursor: pointer;">
                Print Ulang Struk
            </button>
            <br><br>
        </div>

        <div class="header text-center border-b pb-2">
            <h1>TOSERBA JAYA</h1>
            <p>Jl. Contoh No. 123, Kota Anda</p>
            <p>Telp: 0812-3456-7890</p>
        </div>

        <div class="mb-2" style="font-size: 12px;">
            <div class="flex justify-between">
                <span>Struk:</span>
                <span>#TRX-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="flex justify-between">
                <span>Tanggal:</span>
                <span>{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between">
                <span>Kasir:</span>
                <span>{{ Auth::user()->name }}</span>
            </div>
        </div>

        <div class="border-t border-b py-1 mb-2">
            <table class="items-table text-left">
                <tbody>
                    @foreach($transaction->items as $item)
                    <tr>
                        <td colspan="3" class="desc font-bold">{{ $item->product->name }}</td>
                    </tr>
                    <tr>
                        <td class="qty">{{ $item->qty }} x</td>
                        <td>{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="amount">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="totals text-right" style="font-size: 13px;">
            <div class="flex justify-between mb-1">
                <span>Total Belanja:</span>
                <span class="font-bold">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between mb-1">
                <span>Tunai / Bayar:</span>
                <span>Rp {{ number_format($transaction->paid, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between mt-1 pt-1 border-t">
                <span>Kembali:</span>
                <span>Rp {{ number_format($transaction->change, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="footer text-center border-t py-2">
            <p class="font-bold">Terima Kasih!</p>
            <p>Barang yang sudah dibeli<br>tidak dapat dikembalikan.</p>
        </div>
        
    </div>

</body>
</html>
