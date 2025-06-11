<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi OTP</title>
</head>
<body>
    <h1>Verifikasi Kode OTP</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pelajar.verify-otp') }}">
        @csrf
        <label>Masukkan Kode OTP yang dikirim ke nomor HP Anda:</label><br>
        <input type="text" name="otp" required maxlength="6" minlength="6" pattern="\d{6}" title="6 digit angka"><br><br>

        <button type="submit">Verifikasi</button>
    </form>

    <p><a href="{{ route('pelajar.register') }}">Kembali ke Form Registrasi</a></p>
</body>
</html>
