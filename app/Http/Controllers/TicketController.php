<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\NewTicketNotification;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification;

class TicketController extends Controller
{
    /**
     * Menampilkan form untuk membuat tiket baru.
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Menyimpan tiket baru yang dipesan pengguna.
     */
    public function store(Request $request)
    {
        // Validasi input: names harus berupa array dan tiap elemen harus string
        $request->validate([
            'names' => 'required|array|min:1',
            'names.*' => 'required|string',
        ]);

        // Harga per tiket
        $pricePerTicket = 50000;

        // Hitung jumlah tiket berdasarkan jumlah nama yang diinput
        $quantity = count($request->names);

        // Hitung total harga
        $totalPrice = $quantity * $pricePerTicket;

        // Simpan data tiket ke database
        $ticket = new Ticket();
        $ticket->user_id = auth()->id();                    // ID pengguna yang memesan
        $ticket->quantity = $quantity;                     // Jumlah tiket
        $ticket->names = $request->names;                  // Array nama pengunjung (disimpan dalam kolom 'names')
        $ticket->total_price = $totalPrice;                // Total harga semua tiket
        $ticket->valid_until = now()->addDays(30);         // Tiket berlaku selama 30 hari
        $ticket->save();

        // Buat notifikasi untuk admin dan manager
        $recipients = User::whereIn('role', ['manager', 'admin'])->get();
        foreach ($recipients as $user) {
            Notification::create([
                'user_id' => $user->id,
                'ticket_id' => $ticket->id,
                'title' => 'Pesanan Tiket Baru',
                'message' => 'Pengguna ' . auth()->user()->name . ' memesan ' . $quantity . ' tiket.',
                'is_read' => false,
            ]);
        }

        // Buat file PDF dari tiket dan simpan di storage
        $pdf = PDF::loadView('tickets.pdf', ['ticket' => $ticket]);
        $filename = 'tiket-' . $ticket->id . '.pdf';
        Storage::put('public/tickets/' . $filename, $pdf->output());

        // Redirect ke halaman daftar tiket user dengan pesan sukses
        return redirect()->route('tickets.my')->with('success', 'Tiket berhasil dipesan!');
    }

    /**
     * Menampilkan daftar tiket milik user yang sedang login.
     */
    public function myTickets()
    {
        // Ambil semua tiket milik user yang sedang login, urutkan dari yang terbaru, dan tampilkan 10 per halaman
        $tickets = auth()->user()->tickets()->latest()->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Mengunduh file PDF dari tiket milik user.
     */
    public function download(Ticket $ticket)
    {
        // Cek apakah tiket milik user yang login. Jika bukan, tolak akses.
        if ($ticket->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        try {
            // Generate dan kirim file PDF untuk diunduh
            $pdf = Pdf::loadView('tickets.pdf', compact('ticket'));
            return $pdf->download("tiket-{$ticket->id}.pdf");
        } catch (\Exception $e) {
            // Jika gagal, kembali ke halaman sebelumnya dengan error
            return back()->withErrors('Gagal mengunduh tiket.');
        }
    }

    /**
     * Menampilkan form pengisian nama-nama pengunjung berdasarkan jumlah tiket.
     */
    public function fillNames(Request $request)
    {
        // Validasi input jumlah tiket, minimal 1 dan maksimal 20
        $request->validate([
            'quantity' => 'required|integer|min:1|max:20',
        ]);

        // Kirim jumlah tiket ke view agar bisa dibuat input nama-nama
        $quantity = $request->quantity;

        return view('tickets.fill-names', compact('quantity'));
    }
}
