<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    // Halaman login
    public function login()
    {
        if (Auth::check()) {
            // Redirect berdasarkan role
            $user = Auth::user();
            if ($user->role === 'operator') {
                return redirect()->route('operator.dashboard');
            } elseif ($user->role === 'dokter') {
                return redirect()->route('dokter.dashboard');
            }
            return redirect()->route('user.dashboard');
        }
        return view('auth.login');
    }

    // Proses login
    public function actionLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect berdasarkan role
            $user = Auth::user();
            if ($user->role === 'operator') {
                return redirect()->route('operator.dashboard')->with('success', 'Login berhasil!');
            } elseif ($user->role === 'dokter') {
                return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil!');
            }
            
            return redirect()->route('user.dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    // Halaman register
    public function register()
    {
        if (Auth::check()) {
            // Redirect berdasarkan role
            $user = Auth::user();
            if ($user->role === 'operator') {
                return redirect()->route('operator.dashboard');
            } elseif ($user->role === 'dokter') {
                return redirect()->route('dokter.dashboard');
            }
            return redirect()->route('user.dashboard');
        }
        return view('auth.register');
    }

    // Proses register
    public function actionRegister(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:user,operator,dokter',
        ]);

        // Buat user baru
        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'],
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    // Halaman edit profile
    
    public function edit()
    {
        return view('profile.edit');
    }

    // Proses update profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }
            
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->photo = $path;
        }

        // Handle photo removal
        if ($request->remove_photo) {
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
                $user->photo = null;
            }
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }

    // Halaman lupa password
public function showForgotPasswordForm()
{
    return view('auth.forgot-password');
}

// Kirim email reset link
public function sendResetLink(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
}

// Halaman reset password
public function showResetPasswordForm($token)
{
    return view('auth.reset-password', ['token' => $token]);
}

// Proses reset password
public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password),
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('success', __($status))
        : back()->withErrors(['email' => [__($status)]]);
}

}