<!DOCTYPE html>
<html>
<head>
    <title>Reset Password - RS Sehat Prima</title>
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
        .password-requirements {
            background-color: #fef2f2;
            border-left: 3px solid #dc2626;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md border-t-4 border-red-600">
        <!-- Hospital Icon Header -->
        <div class="hospital-icon bg-red-50 mx-auto w-16 h-16 rounded-full mb-4"></div>
        
        <h2 class="text-2xl font-bold text-center mb-2 text-red-700">Reset Password</h2>
        <p class="text-gray-600 text-center mb-6">Buat password baru untuk akun Anda</p>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-50 text-red-700 rounded border border-red-200 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            
            <div>
                <label class="block text-gray-700 mb-2 font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 border rounded-lg form-input focus:outline-none focus:border-red-300">
                @error('email') 
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2 font-medium">Password Baru</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg form-input focus:outline-none focus:border-red-300">
                <div class="password-requirements mt-2 p-2 text-xs text-gray-600">
                    <p class="font-medium text-red-600">Password harus memenuhi:</p>
                    <ul class="list-disc list-inside mt-1">
                        <li>Minimal 8 karakter</li>
                        <li>Mengandung huruf besar dan kecil</li>
                        <li>Mengandung angka</li>
                    </ul>
                </div>
                @error('password') 
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2 font-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-2 border rounded-lg form-input focus:outline-none focus:border-red-300">
            </div>

            <button type="submit" 
                class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition duration-200 font-medium shadow-md">
                Reset Password
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