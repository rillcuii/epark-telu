<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showLoginSSOForm()
    {
        return view('auth.sso_login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if (empty($username) && empty($password)) {
            return back()->with('error', 'Silahkan Masukkan “Username” dan “Password” Untuk Login!');
        }
        if (empty($username)) {
            return back()->with('error', 'Silahkan Masukkan “Username” Untuk Login!');
        }
        if (empty($password)) {
            return back()->with('error', 'Silahkan Masukkan “Password” Untuk Login!');
        }

        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            $request->session()->regenerate();

            return $this->redirectByRole(Auth::user()->role);
        }

        return back()->with('error', 'Akun Tidak Terdaftar.');
    }

    // Logic untuk SSO (Mahasiswa)
    public function ssoRedirect()
    {
        // Di sini nantinya kamu integrasikan dengan Socialite atau CAS Kampus
        // Setelah berhasil dari SSO, panggil login menggunakan email SSO-nya
        return "Mengarahkan ke SSO Kampus...";
    }

    protected function redirectByRole($role)
    {
        return match ($role) {
            'admin'     => redirect()->route('admin.dashboard'),
            'satpam'    => redirect()->route('satpam.dashboard'),
            'mahasiswa' => redirect()->route('mahasiswa.dashboard'),
            default     => redirect('/'),
        };
    }

    public function logout(Request $request)
    {
        // 1. Proses logout dari Guard Laravel
        Auth::logout();

        // 2. Hapus data session agar tidak bisa digunakan lagi
        $request->session()->invalidate();

        // 3. Buat ulang token CSRF baru untuk keamanan
        $request->session()->regenerateToken();

        // 4. Redirect kembali ke halaman login
        return redirect('/login');
    }
}
