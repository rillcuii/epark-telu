<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $satpams = Users::where('role', 'satpam')->get();
        return view('admin.kelola_satpam.index', compact('satpams'));
    }

    // Form Tambah
    public function create()
    {
        return view('admin.kelola_satpam.create');
    }

    // Simpan Data
    public function store(Request $request)
    {
        // Validasi sesuai AF7.3, AF7.4, AF7.5
        $request->validate([
            'nama_user' => 'required',
            'username'  => 'required|alpha_dash|unique:users,username',
            'password'  => 'required|min:6',
        ], [
            'required'   => 'Data tidak lengkap. Silahkan isi seluruh form.',
            'alpha_dash' => 'Data yang Anda inputkan tidak sesuai dengan format.',
            'min'        => 'Data yang Anda inputkan tidak sesuai dengan format.',
            'unique'     => 'Username sudah digunakan. Silakan pilih username lain.',
        ]);

        try {
            Users::create([
                'nama_user' => $request->nama_user,
                'username'  => $request->username,
                'password'  => Hash::make($request->password),
                'role'      => 'satpam',
                'email'     => $request->username . '@epark.com', // Dummy email agar db tidak error
            ]);

            return redirect()->route('satpam.index')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan data. Silakan coba lagi saat koneksi stabil.');
        }
    }

    // Form Edit
    public function edit($id)
    {
        $satpam = Users::where('id_user', $id)->firstOrFail();
        return view('admin.kelola_satpam.edit', compact('satpam'));
    }

    // Update Data
    public function update(Request $request, $id)
    {
        $satpam = Users::where('id_user', $id)->firstOrFail();

        $request->validate([
            'nama_user' => 'required',
            'username'  => ['required', 'alpha_dash', Rule::unique('users')->ignore($satpam->id_user, 'id_user')],
            'password'  => 'nullable|min:6',
        ], [
            'required'   => 'Data tidak lengkap. Silahkan isi seluruh form.',
            'alpha_dash' => 'Data yang Anda inputkan tidak sesuai dengan format.',
            'unique'     => 'Username sudah digunakan. Silakan pilih username lain.',
        ]);

        try {
            $satpam->nama_user = $request->nama_user;
            $satpam->username = $request->username;

            if ($request->filled('password')) {
                $satpam->password = Hash::make($request->password);
            }

            $satpam->save();
            return redirect()->route('satpam.index')->with('success', 'Perubahan akun berhasil disimpan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan data. Silakan coba lagi saat koneksi stabil.');
        }
    }

    // Hapus Data
    public function destroy($id)
    {
        $satpam = Users::where('id_user', $id)->firstOrFail();
        $satpam->delete();

        return redirect()->route('satpam.index')->with('success', 'Data berhasil dihapus');
    }
}
