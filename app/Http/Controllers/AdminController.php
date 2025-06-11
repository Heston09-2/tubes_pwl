<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengunjung;
use App\Models\Notification; // Model notifikasi kustom

class AdminController extends Controller
{
    // Menampilkan dashboard admin beserta notifikasi yang belum dibaca
    public function dashboard()
    {
        $notifications = Notification::where('is_read', false) // Ambil notifikasi yang belum dibaca
                            ->where('user_id', auth()->id())   // Yang ditujukan ke user yang sedang login (admin)
                            ->latest()                         // Urutkan berdasarkan waktu terbaru
                            ->get();                           // Ambil semua hasil

        return view('admin.dashboard_admin', compact('notifications'));
    }

    // Menampilkan form input data pengunjung harian
    public function createPengunjung()
    {
        return view('admin.pengunjung.create'); // Menampilkan view form input data
    }

    // Menampilkan semua data pengunjung milik admin yang sedang login
    public function pengunjungIndex()
    {
        $data = Pengunjung::where('admin_id', auth()->id()) // Ambil data milik admin yang sedang login
            ->orderByDesc('tanggal')                        // Urutkan berdasarkan tanggal terbaru
            ->get();                                        // Ambil semua hasilnya

        return view('admin.pengunjung.index', compact('data'));
    }

    // Menyimpan data pengunjung baru
    public function storePengunjung(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|unique:pengunjung,tanggal', // Validasi agar tidak ada data duplikat per tanggal
            'jumlah' => 'required|integer|min:1',                   // Jumlah harus angka minimal 1
            'catatan' => 'nullable|string',                         // Catatan boleh kosong
        ]);

        $hargaTiket = 50000; // Harga tetap per pengunjung
        $total = $request->jumlah * $hargaTiket; // Hitung total pendapatan

        // Simpan data ke dalam tabel pengunjung
        Pengunjung::create([
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'harga_tiket' => $hargaTiket,
            'total_pendapatan' => $total,
            'catatan' => $request->catatan,
            'admin_id' => auth()->id(), // Admin yang mencatat
        ]);

        return redirect()->route('admin.pengunjung.index')->with('success', 'Data berhasil disimpan');
    }

    // Menandai bahwa data pengunjung sudah final (tidak bisa diubah)
    public function finalizePengunjung($id)
    {
        $pengunjung = Pengunjung::findOrFail($id);            // Cari data berdasarkan ID
        $pengunjung->update(['is_final' => true]);            // Ubah status menjadi final

        return back()->with('success', 'Data difinalisasi');
    }

    // Menampilkan form edit data pengunjung (jika belum final)
    public function editPengunjung($id)
    {
        $data = Pengunjung::where('id', $id)
            ->where('admin_id', auth()->id())        // Pastikan data milik admin yang login
            ->where('is_final', false)               // Hanya data yang belum difinalisasi yang bisa diedit
            ->firstOrFail();                         // 404 jika tidak ditemukan

        return view('admin.pengunjung.edit', compact('data'));
    }

    // Menyimpan perubahan dari form edit
    public function updatePengunjung(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
        ]);

        $hargaTiket = 50000;
        $total = $request->jumlah * $hargaTiket;

        $data = Pengunjung::where('id', $id)
            ->where('admin_id', auth()->id())
            ->where('is_final', false)
            ->firstOrFail();

        // Simpan data yang diperbarui
        $data->update([
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'harga_tiket' => $hargaTiket,
            'total_pendapatan' => $total,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.pengunjung.index')->with('success', 'Data berhasil diperbarui');
    }

    // Menghapus data pengunjung (jika belum difinalisasi)
    public function destroyPengunjung($id)
    {
        $pengunjung = Pengunjung::findOrFail($id); // Ambil data berdasarkan ID

        // Cek apakah data sudah final
        if ($pengunjung->is_final) {
            return redirect()->route('admin.pengunjung.index')->with('error', 'Data sudah final dan tidak bisa dihapus.');
        }

        $pengunjung->delete(); // Hapus data

        return redirect()->route('admin.pengunjung.index')->with('success', 'Data pengunjung berhasil dihapus.');
    }
}
