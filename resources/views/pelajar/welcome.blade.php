<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Selamat Datang Pelajar - Flows Museum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

    <div class="container vh-100 d-flex flex-column justify-content-center align-items-center text-center">

        <h1 class="mb-4">Selamat Datang di Flows Museum Pelajar</h1>
        <p class="mb-5 fs-5 text-secondary">Temukan berbagai materi pembelajaran sesuai minat kamu dan jelajahi dunia pengetahuan!</p>

        <div>
            <a href="{{ route('pelajar.login') }}" class="btn btn-primary btn-lg me-3">Login</a>
            <a href="{{ route('pelajar.register') }}" class="btn btn-outline-primary btn-lg">Register</a>
            <a href="{{ route('welcome') }}" class="btn btn-outline-primary btn-lg">Kembali ke Museum</a>
            
        </div>

        <footer class="mt-5 text-muted">
            &copy; {{ date('Y') }} Flows Museum - Semua Hak Dilindungi
        </footer>
    </div>

</body>
</html>
