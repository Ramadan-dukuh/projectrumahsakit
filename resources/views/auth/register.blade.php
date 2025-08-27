<!DOCTYPE html>
<html>
<head>
    <title>Hospital Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hospital-icon {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23dc2626"><path d="M19 8H5v11h14V8zm-3-5h-2v2h-2V3H8v2H6V3H4v4h16V3h-2z" opacity=".3"/><path d="M20 7h-4V5h-2v2h-2V5H8v2H6V5H4v2H2v13h20V7zm-6 11H6V8h12v10zm2-12H4V3h2v2h2V3h2v2h2V3h2v2h2V3h2v3z"/></svg>');
            background-repeat: no-repeat;
            background-position: center;
            background-size: 40%;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md border-t-4 border-red-600">
        <!-- Hospital Icon Header -->
        <div class="hospital-icon bg-red-50 mx-auto w-16 h-16 rounded-full mb-4"></div>
        
        <h2 class="text-2xl font-bold text-center mb-6 text-red-700">Pendaftaran Rumah Sakit</h2>

        <form method="POST" action="{{ route('register.action') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 mb-2 font-medium">Nama Lengkap:</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-300"
                    placeholder="Masukkan nama lengkap">
                @error('name') 
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2 font-medium">Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-300"
                    placeholder="Masukkan email">
                @error('email') 
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2 font-medium">Password:</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-300"
                    placeholder="Buat password">
                @error('password') 
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2 font-medium">Konfirmasi Password:</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-300"
                    placeholder="Ulangi password">
            </div>

            <button type="submit" 
                class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition duration-200 font-medium shadow-md">
                Daftar Sekarang
            </button>
        </form>

        <p class="mt-4 text-center text-gray-600">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-red-600 hover:underline font-medium">Login disini</a>
        </p>

        <!-- Hospital Footer Note -->
        <div class="mt-6 pt-4 border-t border-gray-100 text-center text-sm text-gray-500">
            <p>Rumah Sakit Sehat Prima © 2025</p>
            <p class="mt-1 text-xs">Keamanan data pasien adalah prioritas kami</p>
        </div>
    </div>
</body>
</html>