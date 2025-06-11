<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Museum Hub') }}</title>
    
    <style>
        /* Modern, Simple & Elegant Styling */
        :root {
            --primary: #3449a1;
            --primary-light: #5a6db5;
            --accent: #f0f4ff;
            --text: #333333;
            --text-light: #777777;
            --white: #ffffff;
            --shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', 'Segoe UI', sans-serif;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f5f7ff 0%, #e8eeff 100%);
        }
        
        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            background-color: var(--white);
            border-radius: 16px;
            box-shadow: var(--shadow);
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .logo-container img {
            height: 56px;
            width: auto;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .login-header h1 {
            color: var(--primary);
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .login-header p {
            color: var(--text-light);
            font-size: 0.95rem;
        }
        
        .login-content {
            margin-bottom: 2rem;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <a href="/">
                <x-application-logo />
            </a>
        </div>
        
        <div class="login-header">
            <h1>Welcome to Flows Arcive</h1>
            <p>Sign in to continue your journey</p>
        </div>
        
        <div class="login-content">
            {{ $slot }}
        </div>
    </div>
</body>
</html>