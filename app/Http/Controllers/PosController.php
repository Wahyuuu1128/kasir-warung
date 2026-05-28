<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\LowStockNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->where('stock', '>', 0)->get();
        return view('pos.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'total' => 'required|integer|min:0',
            'paid' => 'required|integer|min:0',
            'change' => 'required|integer|min:0',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|integer|min:0',
            'items.*.subtotal' => 'required|integer|min:0',
        ]);

        $transactionId = 0;
        DB::transaction(function () use ($validated, &$transactionId) {
            $transaction = Transaction::create([
                'total' => $validated['total'],
                'paid' => $validated['paid'],
                'change' => $validated['change'],
            ]);
            $transactionId = $transaction->id;

            foreach ($validated['items'] as $item) {
                $transaction->items()->create($item);

                // Kurangi stok
                $product = Product::find($item['product_id']);
                if ($product) {
                    $product->decrement('stock', $item['qty']);
                    $product->refresh();

                    // Cek stok menipis (<= 10)
                    if ($product->stock <= 10 && $product->stock >= 0) {
                        // Kirim notifikasi ke semua user (admin)
                        $users = User::all();
                        foreach ($users as $user) {
                            // Cek apakah sudah ada notifikasi unread untuk produk ini
                            $existing = $user->unreadNotifications()
                                ->where('data->product_id', $product->id)
                                ->first();
                            
                            if (!$existing) {
                                $user->notify(new LowStockNotification($product));
                            }
                        }
                    }
                }
            }
        });

        return response()->json(['message' => 'Transaksi berhasil', 'transaction_id' => $transactionId]);
    }

    public function receipt(Transaction $transaction)
    {
        $transaction->load('items.product');
        return view('pos.receipt', compact('transaction'));
    }
}
