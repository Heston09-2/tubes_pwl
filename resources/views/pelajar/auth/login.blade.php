<!DOCTYPE html>
<html>
<head>
    <title>Login Pelajar</title>
</head>
<body>
    <h1>Login Pelajar</h1>

    @if ($errors->any())
        <div style="color:red;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('pelajar.login') }}">
        @csrf

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="{{ route('pelajar.register') }}">Daftar di sini</a></p>
</body>
</html>
