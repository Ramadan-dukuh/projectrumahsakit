<!DOCTYPE html>
<html>
<head>
    <title>Lupa Password - RS Sehat Prima</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hospital-icon {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23dc2626"><path d="M19 8H5v11h14V8zm-3-5h-2v2h-2V3H8v2H6V3H4v4h16V3h-2z" opacity=".3"/><path d="M20 7h-4V5h-2v2h-2V5H8v2H6V5H4v2H2v13h20V7zm-6 11H6V8h12v10zm2-12H4V3h2v2h2V3h2v2h2V3h2v2h2V3h2v3z"/></svg>');
            background-repeat: no-repeat;
            background-position: center;
            background-size: 40%;
        }
        .form-input {
            transition: all 0.3s;
        }
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.2);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md border-t-4 border-red-600">
        <!-- Hospital Icon Header -->
        <div class="hospital-icon bg-red-50 mx-auto w-16 h-16 rounded-full mb-4"></div>
        
        <h2 class="text-2xl font-bold text-center mb-6 text-red-700">Reset Password</h2>
        <p class="text-gray-600 text-center mb-6">Masukkan email Anda untuk menerima link reset password</p>

        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded border border-green-200 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-gray-700 mb-2 font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 border rounded-lg form-input focus:outline-none focus:border-red-300">
                @error('email') 
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                @enderror
            </div>

            <button type="submit" 
                class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition duration-200 font-medium shadow-md">
                Kirim Link Reset
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-red-600 hover:underline font-medium">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Login
            </a>
        </div>

        <!-- Hospital Footer Note -->
        <div class="mt-6 pt-4 border-t border-gray-100 text-center text-sm text-gray-500">
            <p>Rumah Sakit Sehat Prima © 2025</p>
            <p class="mt-1">Jl. Kesehatan No. 123, Jakarta</p>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>