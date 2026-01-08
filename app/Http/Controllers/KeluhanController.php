<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KeluhanController extends Controller
{
    public function index(Request $request)
    {
        $query = Keluhan::with('user');
        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('nama_user', 'like', '%' . $request->search . '%');
            })->orWhere('keterangan_keluhan', 'like', '%' . $request->search . '%')
                ->orWhere('judul_keluhan', 'like', '%' . $request->search . '%');
        }

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
    public function indexMahasiswa(Request $request)
    {
        $query = Keluhan::where('users_id', auth()->user()->id_user);

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('judul_keluhan', 'like', '%' . $request->search . '%')
                    ->orWhere('keterangan_keluhan', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('status') && $request->status != 'Semua') {
            $query->where('status_keluhan', $request->status);
        }

        $keluhans = $query->orderBy('created_at', 'desc')->get();

        return view('mahasiswa.keluhan.index', compact('keluhans'));
    }

    public function createMahasiswa()
    {
        return view('mahasiswa.keluhan.create');
    }

    public function storeMahasiswa(Request $request)
    {
        $request->validate([
            'judul_keluhan' => 'required|max:255',
            'keterangan_keluhan' => 'required',
        ], [
            'required' => 'Silahkan lengkapi semua data keluhan sebelum mengirim.'
        ]);

        try {
            Keluhan::create([
                'users_id' => auth()->user()->id_user,
                'judul_keluhan' => $request->judul_keluhan,
                'keterangan_keluhan' => $request->keterangan_keluhan,
                'status_keluhan' => 'belum_ditangani',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('mahasiswa.keluhan.index')
                ->with('success', 'Keluhan berhasil dikirim. Silakan tunggu tanggapan admin.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim keluhan, silakan coba lagi saat koneksi stabil.');
        }
    }

    public function showMahasiswa($id)
    {
        $keluhan = Keluhan::where('id_keluhan', $id)->firstOrFail();
        return view('mahasiswa.keluhan.detail', compact('keluhan'));
    }
}
