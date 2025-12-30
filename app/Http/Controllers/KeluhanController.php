<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use Illuminate\Http\Request;

class KeluhanController extends Controller
{
    public function index(Request $request)
    {
        $query = Keluhan::with('user'); // Load relasi user (mahasiswa)

        // Fitur Search (berdasarkan nama mahasiswa atau isi keluhan)
        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('nama_user', 'like', '%' . $request->search . '%');
            })->orWhere('keterangan_keluhan', 'like', '%' . $request->search . '%')
                ->orWhere('judul_keluhan', 'like', '%' . $request->search . '%');
        }

        // Fitur Filter Status
        if ($request->status && $request->status != 'Semua') {
            $query->where('status_keluhan', $request->status);
        }

        $keluhans = $query->latest()->get();

        return view('admin.kelola_keluhan.index', compact('keluhans'));
    }

    public function show($id)
    {
        $keluhan = Keluhan::with('user')->where('id_keluhan', $id)->firstOrFail();
        return view('admin.kelola_keluhan.show', compact('keluhan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_keluhan' => 'required|in:belum_ditangani,sedang_ditangani,sudah_ditangani'
        ]);

        try {
            $keluhan = Keluhan::where('id_keluhan', $id)->firstOrFail();
            $keluhan->status_keluhan = $request->status_keluhan;
            $keluhan->save();

            return redirect()->route('keluhan.index')->with('success', 'Status keluhan berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan pembaruan. Silakan coba lagi saat koneksi stabil.');
        }
    }
}
