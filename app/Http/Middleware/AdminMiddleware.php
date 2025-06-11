<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    // Fungsi utama middleware yang menangani permintaan masuk
    public function handle(Request $request, Closure $next)
    {
        // Mengecek apakah user sudah login (auth) dan memiliki role 'admin'
        if (auth()->check() && auth()->user()->role === 'admin') {
            // Jika ya, lanjutkan request ke route atau controller berikutnya
            return $next($request);
        }

        // Jika tidak, tampilkan error 403 (Forbidden)
        abort(403, 'Unauthorized');
    }
}
