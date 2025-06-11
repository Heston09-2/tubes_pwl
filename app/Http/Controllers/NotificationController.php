<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Menandai satu notifikasi sebagai "sudah dibaca"
     */
    public function markAsRead($id)
    {
        // Ambil notifikasi berdasarkan ID yang dimiliki oleh user yang sedang login
        $notification = Auth::user()->notifications()->findOrFail($id);

        // Tandai notifikasi tersebut sebagai sudah dibaca (true)
        $notification->is_read = true;

        // Simpan perubahan ke database
        $notification->save();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Notifikasi ditandai sebagai dibaca.');
    }

    /**
     * Menghapus satu notifikasi dari database
     */
    public function destroy($id)
    {
        // Ambil user yang sedang login
        $user = auth()->user();

        // Cari notifikasi milik user yang sedang login berdasarkan ID
        $notification = $user->notifications()->findOrFail($id);

        // Hapus notifikasi dari database
        $notification->delete();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus.');
    }
}
