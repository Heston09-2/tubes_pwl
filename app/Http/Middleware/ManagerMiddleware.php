<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;  

class ManagerMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {
        // Mengecek apakah pengguna sudah login (authenticated)
        // dan apakah peran (role) pengguna adalah 'manager'
        if (auth()->check() && auth()->user()->role === 'manager') {
            // Jika ya, lanjutkan permintaan ke proses berikutnya (middleware selanjutnya atau controller)
            return $next($request);
        }

        // Jika tidak memenuhi syarat, tolak permintaan dengan status 403 Forbidden
        abort(403, 'Unauthorized');
    }
}
