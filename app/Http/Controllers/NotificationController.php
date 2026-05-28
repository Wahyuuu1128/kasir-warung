<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead(Request $request, $id)
    {
        $notification = $request->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        // Redirect based on notification type
        $data = $notification->data;
        if (isset($data['product_id'])) {
            return redirect()->route('products.index')->with('success', 'Peringatan stok: ' . ($data['message'] ?? ''));
        }

        return redirect()->route('dashboard');
    }

    public function markAllAsRead(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Semua notifikasi telah dibaca.');
    }
}
