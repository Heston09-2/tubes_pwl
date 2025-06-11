<?php


namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ArtworkImport;
use App\Models\View;
use Illuminate\Support\Facades\DB;

class ArtworkController extends Controller
{
    // Menampilkan dashboard dengan data acak per kategori, data lainnya, dan statistik
   public function index()
{
    // Ambil satu data acak dari setiap kategori karya seni yang berstatus 'approved'
    $artworksTop = Artwork::select('id', 'category', 'name', 'image') // hanya ambil kolom tertentu
        ->where('status', 'approved')                                  // hanya karya yang sudah disetujui
        ->inRandomOrder()                                              // urutkan secara acak
        ->get()                                                        // ambil semua data
        ->unique('category');                                          // ambil hanya satu data unik per kategori

    // Ambil sisa data selain dari yang ada di $artworksTop
    $artworksBottom = Artwork::where('status', 'approved')            // hanya karya yang sudah disetujui
        ->whereNotIn('id', $artworksTop->pluck('id'))                  // kecualikan data yang sudah diambil di atas
        ->inRandomOrder()                                              // acak urutan
        ->get();                                                       // ambil semua data

    // Ambil 7 karya dengan jumlah views terbanyak (rekomendasi)
    $recommendedArtworks = Artwork::where('status', 'approved')       // hanya karya yang sudah disetujui
        ->withCount('views')                                          // hitung jumlah relasi 'views' untuk setiap karya
        ->orderByDesc('views_count')                                  // urutkan dari yang paling banyak views
        ->take(7)                                                     // ambil hanya 7 data teratas
        ->get();                                                      // ambil datanya

    // Statistik:

    // Hitung total karya yang sudah disetujui
    $totalArtworks = Artwork::where('status', 'approved')->count();

    // Hitung jumlah kategori unik dari karya yang sudah disetujui
    $totalCategories = Artwork::where('status', 'approved')->distinct()->count('category');

    // Hitung rata-rata jumlah data per kategori (dibulatkan ke 2 angka desimal)
    $averageDataPerCategory = $totalCategories > 0 
        ? round($totalArtworks / $totalCategories, 2) 
        : 0;

    // Hitung jumlah pembuat unik (creator) yang tidak null
    $totalCreators = Artwork::where('status', 'approved')
        ->whereNotNull('creator')
        ->distinct()
        ->count('creator');

    // Hitung jumlah asal negara/daerah unik (origin)
    $totalCountries = Artwork::where('status', 'approved')->distinct()->count('origin');

    // Kirim semua data ke view 'dashboard' sebagai variabel yang bisa digunakan di blade
    return view('dashboard', compact(
        'artworksTop',
        'artworksBottom',
        'recommendedArtworks',
        'totalArtworks',
        'totalCategories',
        'averageDataPerCategory',
        'totalCreators',
        'totalCountries'
    ));
}


    // Detail karya + tambah views
   public function detail($id)
{
    // Ambil satu data karya berdasarkan id dan status 'approved'
    // Jika tidak ditemukan, akan menampilkan halaman 404
    $artwork = Artwork::where('id', $id)
        ->where('status', 'approved')
        ->firstOrFail();

    // Simpan data view baru saat halaman detail dibuka
    // Artinya: setiap kali pengguna mengunjungi halaman detail, data view dicatat
    View::create([
        'artwork_id' => $id,     // menyimpan ID karya yang dilihat
          
    ]);
    // Hitung total jumlah views dari tabel 'views' berdasarkan artwork_id
    $totalViews = View::where('artwork_id', $id)->count();

    // Kirim data karya dan total views ke halaman blade 'artwork.detail'
    return view('artwork.detail', compact('artwork', 'totalViews'));
}

    // Halaman welcome dengan jumlah karya + 7 terbaru
    public function welcome()
{
    // Hitung total karya yang berstatus 'approved' (disetujui)
    $artworksCount = Artwork::where('status', 'approved')->count();

    // Ambil 7 karya terbaru yang sudah disetujui, berdasarkan waktu dibuat (created_at)
    $artworks = Artwork::where('status', 'approved')    // hanya karya yang approved
        ->orderBy('created_at', 'desc')                 // urutkan dari yang terbaru
        ->take(7)                                       // ambil hanya 7 data teratas
        ->get();                                        // eksekusi query dan ambil hasilnya

    // Kirim data jumlah karya dan daftar 7 karya terbaru ke halaman 'welcome'
    return view('welcome', compact('artworks', 'artworksCount'));
}

    // Halaman admin untuk melihat karya yang sudah disetujui, dengan filter
    public function show(Request $request)
{
    // Ambil data karya seni (artworks) yang sudah disetujui (status = 'approved') sebagai query awal
    $query = Artwork::where('status', 'approved');

    // Jika terdapat input pencarian (search) dari request, filter data berdasarkan nama karya yang mengandung kata tersebut
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Jika terdapat input kategori dari request, filter data berdasarkan kategori tersebut
    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    // Eksekusi query untuk mengambil semua data karya seni yang telah difilter
    $artworks = $query->get();

    // Ambil daftar kategori unik dari karya seni yang sudah disetujui
    $categories = Artwork::where('status', 'approved')
        ->select('category')->distinct()->pluck('category');

    // Tampilkan view 'admin.show' sambil mengirimkan data artworks dan categories ke dalam view
    return view('admin.show', compact('artworks', 'categories'));
}


    // Menampilkan karya yang statusnya pending
    public function showPending()
    {
        $artworks = Artwork::where('status', 'pending')->get();
        return view('admin.pending', compact('artworks'));
    }

    // Menampilkan karya yang statusnya rejected
    public function showRejected()
    {
        $artworks = Artwork::where('status', 'rejected')->get();
        return view('admin.rejected', compact('artworks'));
    }

    // Form tambah karya
    // Tampilkan halaman form untuk menambahkan karya baru
public function create()
{
    return view('admin.create');
}

// Simpan karya baru dengan validasi dan upload gambar
public function store(Request $request)
{
    // Validasi input dari form
    $request->validate([
        'name' => 'required',                  // Nama karya wajib diisi
        'category' => 'required',              // Kategori wajib diisi
        'creator' => 'required',               // Nama pembuat wajib diisi
        'year' => 'required|numeric',          // Tahun wajib diisi dan harus berupa angka
        'origin' => 'required',                // Asal karya wajib diisi
        'description' => 'required',           // Deskripsi wajib diisi
        'image' => 'nullable|image|max:2048',  // Gambar bersifat opsional, harus berupa file gambar, ukuran maks 2MB
    ]);

    // Buat objek Artwork baru dan isi data dari input
    $artwork = new Artwork();
    $artwork->name = $request->name;
    $artwork->category = $request->category;
    $artwork->creator = $request->creator;
    $artwork->year = $request->year;
    $artwork->origin = $request->origin;
    $artwork->description = $request->description;

    // Jika  mengunggah gambar, simpan ke dalam folder 'public/images'
    if ($request->hasFile('image')) {
        $file = $request->file('image');                       // Ambil file gambar dari request
        $originalName = $file->getClientOriginalName();        // Ambil nama asli file
        $file->storeAs('images', $originalName, 'public');     // Simpan gambar ke folder 'storage/app/public/images'
        $artwork->image = $originalName;                       // Simpan nama file ke kolom 'image' pada database
    }

    // Set status awal karya menjadi 'pending' (menunggu persetujuan manager)
    $artwork->status = 'pending';

    // Simpan data karya ke database
    $artwork->save();

    // Redirect ke halaman admin.show dengan pesan sukses
    return redirect()->route('admin.show')->with('success', 'Data berhasil ditambahkan dan menunggu persetujuan manager');
}

    // Form edit karya
    public function edit($id)
    {
        $artwork = Artwork::findOrFail($id);
        return view('admin.edit', compact('artwork'));
    }

    // Update karya dengan validasi dan upload gambar
    public function update(Request $request, $id)
{
    // Ambil data karya berdasarkan ID, jika tidak ditemukan maka akan menampilkan 404
    $artwork = Artwork::findOrFail($id);

    // Validasi input dari form
    $request->validate([
        'name' => 'required',                  // Nama karya wajib diisi
        'category' => 'required',              // Kategori wajib diisi
        'creator' => 'required',               // Nama pembuat wajib diisi
        'year' => 'nullable|numeric',          // Tahun boleh kosong tapi harus berupa angka jika diisi
        'origin' => 'required',                // Asal karya wajib diisi
        'description' => 'required',           // Deskripsi wajib diisi
    ]);

    // Update data karya berdasarkan input dari form
    $artwork->name = $request->name;
    $artwork->category = $request->category;
    $artwork->creator = $request->creator;

    // Jika tahun diisi, maka update kolom tahun
    if ($request->filled('year')) {
        $artwork->year = $request->year;
    }

    $artwork->origin = $request->origin;
    $artwork->description = $request->description;

    // Jika user mengunggah gambar baru, simpan dan update kolom image
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public'); // Simpan gambar ke folder 'storage/app/public/images'
        $artwork->image = basename($imagePath); // Simpan nama file saja ke kolom image
    }

    // Simpan perubahan ke database
    $artwork->save();

    // Redirect ke halaman admin.show dengan pesan sukses
    return redirect()->route('admin.show')->with('success', 'Data berhasil diperbarui');
}


    // Import karya dari file Excel
    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv|max:2048',
    ], [
        // Pesan error kustom jika validasi gagal
        'file.required' => 'Harap unggah file terlebih dahulu.',
        'file.mimes' => 'Format file harus .xlsx atau .csv.',
        'file.max' => 'Ukuran file maksimal 2MB.',
    ]);

    try {
        // Proses impor file menggunakan Laravel Excel
        // ArtworkImport adalah kelas yang menangani logika pemetaan data ke database
        Excel::import(new ArtworkImport, $request->file('file'));

        // Jika impor berhasil, redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil dikirim dan menunggu persetujuan manager.');
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        // Menangkap error validasi dari setiap baris file Excel/CSV
        $failures = $e->failures(); // Ambil semua kegagalan validasi
        $errorMessage = 'Gagal mengimpor data: ';

        // Loop setiap baris yang gagal dan kumpulkan pesan error-nya
        foreach ($failures as $failure) {
            // Tambahkan info baris dan error spesifik ke pesan error
            $errorMessage .= "Baris {$failure->row()}: " . implode(', ', $failure->errors()) . '. ';
        }

        // Redirect kembali dengan pesan error rinci
        return redirect()->back()->with('error', $errorMessage);
    } catch (\Exception $e) {
        // Menangani error lain selain validasi, misalnya:
        // - Format file rusak
        // - Gagal menyimpan ke database
        // - Kesalahan tak terduga lainnya
        return redirect()->back()->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
    }
}


    // Halaman galeri dengan filter search, kategori, negara
    public function gallery(Request $request)
{
    // Mulai query: hanya ambil karya yang sudah disetujui (status = 'approved')
    $query = Artwork::query()->where('status', 'approved');

    // Jika ada input pencarian dari user (search), filter berdasarkan nama atau pembuat
    if ($request->filled('search')) {
        $searchTerm = $request->search;

        // Tambahkan filter untuk mencocokkan 'name' atau 'creator' yang mengandung keyword
        $query->where(function ($q) use ($searchTerm) {
            $q->where('name', 'like', '%' . $searchTerm . '%')        // nama karya mengandung keyword
              ->orWhere('creator', 'like', '%' . $searchTerm . '%'); // atau pembuat mengandung keyword
        });
    }

    // Jika user memilih kategori tertentu, tambahkan filter berdasarkan kategori
    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    // Jika user memilih negara asal (origin/country), tambahkan filter berdasarkan origin
    if ($request->filled('country')) {
        $query->where('origin', $request->country);
    }

    // Jalankan query dan ambil semua data yang cocok
    $artworks = $query->get();

    // Ambil semua origin (negara) yang unik dari tabel artworks, untuk pilihan filter di tampilan
    $countries = Artwork::select('origin')->distinct()->get();

    // Kirim data karya yang sudah difilter dan daftar negara ke view 'gallery'
    return view('gallery', compact('artworks', 'countries'));
}

    // Halaman untuk menampilkan semua karya berdasarkan kategori tertentu
    public function showCategory($category)
    {
        $artworks = Artwork::where('category', $category)
            ->where('status', 'approved')
            ->get();

        return view('category', compact('artworks', 'category'));
    }

    // Halaman tentang kami
    public function about()
    {
        return view('aboutus');
    }

    // Hapus semua data yang ditolak
    public function cleanAll()
    {
        Artwork::where('status', 'rejected')->delete();

        return redirect()->back()->with('success', 'Semua data yang ditolak berhasil dihapus.');
    }




}
