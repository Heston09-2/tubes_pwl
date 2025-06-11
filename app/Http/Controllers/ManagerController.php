<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Artwork;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ArtworkImport;
use App\Models\Ticket;
use App\Models\Pengunjung;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification;
use App\Models\views;
use App\Models\Pelajar;  // pastikan import model Pelajar di atas




class ManagerController extends Controller
{
    // Dashboard manager
public function dashboard()
{
     $notifications = Notification::where('is_read', false) // hanya notifikasi belum dibaca
                            ->where('user_id', auth()->id()) 
                            ->latest() // urut dari yang terbaru
                            ->get();

    return view('manager.dashboard', compact('notifications'));
}






    // Lihat semua user (kecuali manager sendiri)
    public function users()
    {
        $users = User::where('role', '!=', 'manager')->get();
        return view('manager.users', compact('users'));
    }






   public function show(Request $request)
{
    // Mulai query builder untuk model Artwork
    $query = Artwork::query();

    // Jika ada filter kategori dari request (dropdown, dll)
    if ($request->filled('category')) {
        // Tambahkan filter kategori ke query
        $query->where('category', $request->category);
    }

    // Jika ada input pencarian (search box)
    if ($request->filled('search')) {
        $search = $request->search;

        // Gunakan where bersarang (nested) untuk mencari berdasarkan:
        // - nama karya (name)
        // - kategori (category)
        // - pembuat (creator)
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('category', 'like', "%{$search}%")
              ->orWhere('creator', 'like', "%{$search}%");
        });
    }

    // Jalankan query dan ambil semua hasil sesuai filter di atas
    $artworks = $query->get();

    // Ambil semua kategori unik dari tabel artwork untuk keperluan filter (dropdown)
    $categories = Artwork::select('category')
                         ->distinct()           // Hanya ambil satu nilai unik per kategori
                         ->orderBy('category')  // Urutkan secara alfabetis
                         ->pluck('category');   // Ambil hanya nilainya sebagai array

    // Tampilkan hasil ke view 'manager.artworks.show' dan kirim data artworks dan categories
    return view('manager.artworks.show', compact('artworks', 'categories'));
}



    public function create()
    {
        return view('manager.artworks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'creator' => 'required',
            'year' => 'required|numeric',
            'origin' => 'required',
            'description' => 'required',
            
        ]);

        $artwork = new Artwork();
        $artwork->name = $request->name;
        $artwork->category = $request->category;
        $artwork->creator = $request->creator;
        $artwork->year = $request->year;
        $artwork->origin = $request->origin;
        $artwork->description = $request->description;

        // Menangani upload gambar
        if ($request->hasFile('image')) {
           $imagePath = $request->file('image')->store('images', 'public');
            $artwork->image = basename($imagePath); // Hanya simpan nama filenya saja

        }

        $artwork->save();

        return redirect()->route('manager.artworks.show')->with('success', 'Data  berhasil ditambahkan');
    }

    public function edit($id)
    {
        $artwork = Artwork::findOrFail($id);
        return view('manager.artworks.edit', compact('artwork'));
    }

    public function update(Request $request, $id)
{
    $artwork = Artwork::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'category' => 'required',
        'creator' => 'required',
        // 'year' tidak wajib, karena akan kita cek manual
        'origin' => 'required',
        'description' => 'required',
    ]);

    $artwork->name = $request->name;
    $artwork->category = $request->category;
    $artwork->creator = $request->creator;

    // Kalau year kosong, pakai tahun lama
    if ($request->filled('year')) {
        $artwork->year = $request->year;
    } 
    // else tahun tidak diubah

    $artwork->origin = $request->origin;
    $artwork->description = $request->description;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $artwork->image = $imagePath;
    }

    $artwork->save();

    return redirect()->route('manager.artworks.show')->with('success', 'Data berhasil diperbarui');
}


   public function destroy(string $id)
{
    // Cari data artwork berdasarkan ID
    $artwork = Artwork::find($id);

    // Jika data tidak ditemukan, tampilkan pesan debug (sementara)
    if (!$artwork) {
        // menampilkan pesan jika karya tidak ditemukan
        dd("Artwork dengan ID $id tidak ditemukan");
    }

    // Jika ditemukan, hapus data dari database
    $artwork->delete();

    // Redirect kembali ke halaman daftar artwork milik manager
    // Serta kirimkan pesan sukses bahwa data berhasil dihapus
    return redirect()->route('manager.artworks.show')->with('success', 'Data berhasil dihapus');
}

// Menghapus seluruh data artwork dari tabel
public function destroyAll()
{
    // truncate akan menghapus semua baris dari tabel artworks secara permanen
    // dan mereset auto-increment ID ke 1 (berbeda dengan delete())
    Artwork::truncate();

    // Redirect ke halaman daftar artwork manager dengan pesan sukses
    return redirect()->route('manager.artworks.show')->with('success', 'Semua Data Museum berhasil dihapus.');
}


// Menghapus semua karya berdasarkan kategori tertentu
public function destroyByCategory(Request $request)
{
    // Validasi agar input kategori wajib diisi dan berupa string
    $request->validate([
        'category' => 'required|string',
    ]);

    // Hapus semua data artwork yang memiliki kategori sesuai input
    $deletedCount = Artwork::where('category', $request->category)->delete();

    // Jika tidak ada data yang dihapus, tampilkan pesan error
    if ($deletedCount === 0) {
        return redirect()->route('manager.artworks.show')->with('error', 'Tidak ada data pada kategori tersebut.');
    }

    // Jika ada data yang dihapus, tampilkan pesan sukses
    return redirect()->route('manager.artworks.show')->with('success', 'Data dalam kategori tersebut berhasil dihapus.');
}




    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048',
        ], [
            'file.required' => 'Harap unggah file terlebih dahulu.',
            'file.mimes' => 'Format file harus .xlsx atau .csv.',
            'file.max' => 'Ukuran file maksimal 2MB.',
        ]);
        //imort data melalui excel ke database
        try {
            Excel::import(new ArtworkImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data  berhasil diimpor.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessage = 'Gagal mengimpor data: ';
            foreach ($failures as $failure) {
                $errorMessage .= "Baris {$failure->row()}: " . implode(', ', $failure->errors()) . '. ';
            }
            return redirect()->back()->with('error', $errorMessage);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }

    // Menampilkan semua karya seni yang berstatus "pending" (menunggu persetujuan)
public function pendingArtworks()
{
    // Ambil semua data artwork yang status-nya "pending"
    $pendingArtworks = Artwork::where('status', 'pending')->get();

    // Tampilkan ke view khusus manager untuk melihat data pending
    return view('manager.artworks.pending-artworks', compact('pendingArtworks'));
}

// Menyetujui satu karya seni berdasarkan ID
public function approveArtwork($id)
{
    // Cari artwork berdasarkan ID, gagal maka 404
    $artwork = Artwork::findOrFail($id);

    // Ubah status karya menjadi "approved"
    $artwork->status = 'approved';

    // Simpan perubahan ke database
    $artwork->save();

    // Kembali ke halaman sebelumnya dengan notifikasi sukses
    return redirect()->back()->with('success', 'Data dari admin disetujui');
}


// Menolak satu karya seni berdasarkan ID
public function rejectArtwork($id)
{
    // Cari artwork berdasarkan ID
    $artwork = Artwork::findOrFail($id);

    // Ubah status karya menjadi "rejected"
    $artwork->status = 'rejected';

    // Simpan perubahan
    $artwork->save();

    // Kembali ke halaman sebelumnya dengan notifikasi penolakan
    return redirect()->back()->with('success', 'Karya ditolak');
}

// Menyetujui semua karya seni yang masih berstatus pending
public function approveAll()
{
    // Update semua artwork yang berstatus "pending" menjadi "approved"
    Artwork::where('status', 'pending')->update(['status' => 'approved']);

    // Redirect dengan pesan sukses
    return redirect()->back()->with('success', 'Semua data berhasil disetujui.');
}


// Menghapus semua karya seni yang masih berstatus pending
public function deleteAllPending()
{
    // Hapus semua artwork dengan status "pending" dari database
    Artwork::where('status', 'pending')->delete();

    // Redirect dengan pesan sukses
    return redirect()->back()->with('success', 'Semua data pending berhasil dihapus.');
}

public function ticketHistory()
{
    // Ambil semua tiket dengan informasi user yang memesan
    $tickets = Ticket::with('user')->orderBy('created_at', 'desc')->get();

    return view('manager.tickets.history', compact('tickets'));
}


public function statistics()
{
    // Hitung total seluruh karya seni dalam tabel artworks
    $totalArtworks = Artwork::count();

    // Hitung total semua views dari seluruh karya seni (jumlah kumulatif views)
    $totalViews = \DB::table('views')->count();

    // Cari 10 karya dengan jumlah views terbanyak menggunakan relasi views
    $topViewedArtworks = Artwork::withCount('views') // Menghitung jumlah view per artwork
        ->orderByDesc('views_count')                // Urutkan berdasarkan jumlah view terbanyak
        ->take(10)                                  // Ambil hanya 10 teratas
        ->get();

    // Hitung jumlah karya per kategori, ambil kategori dan jumlahnya
    $artworksByCategory = Artwork::select('category')
        ->selectRaw('count(*) as total')  // Hitung total per kategori
        ->groupBy('category')              // Kelompokkan berdasarkan kategori
        ->get();

    // Cari 10 pembuat karya (creator) dengan jumlah karya terbanyak
    $artworksByCreator = Artwork::select('creator')
        ->selectRaw('count(*) as total')  // Hitung total karya per creator
        ->groupBy('creator')               // Kelompokkan berdasarkan creator
        ->orderByDesc('total')             // Urutkan dari jumlah terbanyak
        ->limit(10)                       // Batasi hanya 10 teratas
        ->get();

    // Hitung jumlah karya berdasarkan statusnya (approved, pending, rejected, dll)
    $artworksByStatus = Artwork::select('status')
        ->selectRaw('count(*) as total')  // Hitung total per status
        ->groupBy('status')                // Kelompokkan berdasarkan status
        ->get();

    // Hitung jumlah karya dengan status pending
    $pendingArtworks = Artwork::where('status', 'pending')->count();

    // Hitung jumlah karya dengan status approved
    $approvedArtworks = Artwork::where('status', 'approved')->count();

    // Cari 10 negara asal karya seni dengan jumlah terbanyak
    $topOrigins = Artwork::select('origin')
        ->selectRaw('count(*) as total')  // Hitung total karya per asal negara
        ->groupBy('origin')               // Kelompokkan berdasarkan asal
        ->orderByDesc('total')            // Urutkan dari terbanyak
        ->limit(10)                      // Batasi hanya 10 teratas
        ->get();

    // Statistik tiket: jumlah tiket yang sudah terjual
    $totalTicketsSold = Ticket::sum('quantity');

    // Statistik tiket: total pendapatan dari penjualan tiket
    $totalRevenue = Ticket::sum('total_price');

    // Statistik user: hitung total semua user (admin, manager, user)
    $totalAll = User::count();

    // Hitung jumlah user dengan role admin
    $totalAdmins = User::where('role', 'admin')->count();

    // Hitung jumlah user dengan role manager
    $totalManagers = User::where('role', 'manager')->count();

    // Hitung jumlah user dengan role biasa (user)
    $totalUsers = User::where('role', 'user')->count();

    // Cari 10 karya/artwork dengan jumlah favorit terbanyak
    $topFavoritedArtworks = Artwork::withCount('favorites')    // Hitung jumlah favorit per karya
        ->orderByDesc('favorites_count')                       // Urutkan dari yang terbanyak
        ->limit(10)                                            // Batasi hanya 10 teratas
        ->get();

    return view('manager.statistics', compact(
        'totalArtworks', 'totalViews', 'topViewedArtworks',
        'artworksByCategory', 'artworksByCreator', 'artworksByStatus',
        'pendingArtworks', 'approvedArtworks',
        'topOrigins', 'topFavoritedArtworks',
        'totalTicketsSold', 'totalRevenue',
        'totalAdmins', 'totalManagers', 'totalUsers', 'totalAll'
    ));
}




public function laporanPengunjung()
{
    $data = Pengunjung::with('admin')
        ->where('is_final', true)
        ->orderByDesc('tanggal')
        ->get();

    return view('manager.laporan.pengunjung', compact('data'));
}

//manage pelajar

// Tampilkan daftar semua pelajar
public function pelajarIndex()
{
    $pelajars = Pelajar::all();
    return view('manager.pelajar.index', compact('pelajars'));
}

// Tampilkan form tambah pelajar baru
public function pelajarCreate()
{
    return view('manager.pelajar.create');
}

// Simpan data pelajar baru
public function pelajarStore(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:pelajars,email',
        'password' => 'required|string|min:6|confirmed',

        
        // tambahkan validasi lain sesuai kolom pelajar
    ]);

    Pelajar::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => bcrypt($request->password), // Enkripsi password
        // isi kolom lain jika ada
    ]);

    return redirect()->route('manager.pelajar.index')->with('success', 'Data pelajar berhasil ditambahkan.');
}

// Tampilkan form edit data pelajar
public function pelajarEdit($id)
{
    $pelajar = Pelajar::findOrFail($id);
    return view('manager.pelajar.edit', compact('pelajar'));
}

// Update data pelajar
public function pelajarUpdate(Request $request, $id)
{
    $pelajar = Pelajar::findOrFail($id);

    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:pelajars,email,' . $pelajar->id,
        'password' => 'nullable|string|min:6|confirmed',
       
    ]);

    $pelajar->update([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => $request->filled('password') ? bcrypt($request->password) : $pelajar->password, // Hanya update jika password diisi
      
    ]);

    return redirect()->route('manager.pelajar.index')->with('success', 'Data pelajar berhasil diperbarui.');
}

// Hapus data pelajar
public function pelajarDestroy($id)
{
    $pelajar = Pelajar::findOrFail($id);
    $pelajar->delete();

    return redirect()->route('manager.pelajar.index')->with('success', 'Data pelajar berhasil dihapus.');
}



}




