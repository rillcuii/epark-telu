<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KendaraanController extends Controller
{

    public function index()
    {
        $kendaraans = Kendaraan::where('users_id', auth()->user()->id_user)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mahasiswa.kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('mahasiswa.kendaraan.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'Data belum lengkap.',
            'unique'   => 'Nomor polisi sudah terdaftar.',
            'image'    => 'Data yang anda inputkan tidak sesuai dengan format.',
            'mimes'    => 'Data yang anda inputkan tidak sesuai dengan format.',
            'max'      => 'Ukuran file maksimal 2MB.',
        ];

        $request->validate([
            'nomor_polisi'       => 'required|unique:kendaraan,nomor_polisi',
            'model_kendaraan'    => 'required',
            'warna_kendaraan'    => 'required',
            'url_foto_kendaraan' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'url_foto_stnk'      => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], $messages);

        $nopol = str_replace(' ', '_', strtoupper($request->nomor_polisi));
        $timestamp = time();

        $fileKendaraan = $nopol . '_VEHICLE_' . $timestamp . '.' . $request->file('url_foto_kendaraan')->getClientOriginalExtension();
        $fileStnk      = $nopol . '_STNK_' . $timestamp . '.' . $request->file('url_foto_stnk')->getClientOriginalExtension();

        $pathKendaraan = $request->file('url_foto_kendaraan')->storeAs('kendaraan', $fileKendaraan, 'public');
        $pathStnk      = $request->file('url_foto_stnk')->storeAs('stnk', $fileStnk, 'public');

        Kendaraan::create([
            'id_kendaraan'       => Str::uuid(),
            'users_id'           => auth()->user()->id_user,
            'nomor_polisi'       => strtoupper($request->nomor_polisi),
            'model_kendaraan'    => $request->model_kendaraan,
            'warna_kendaraan'    => $request->warna_kendaraan,
            'url_foto_kendaraan' => $pathKendaraan,
            'url_foto_stnk'      => $pathStnk,
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);

        return redirect()->route('mahasiswa.kendaraan.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::where('id_kendaraan', $id)
            ->where('users_id', auth()->user()->id_user) // Keamanan: Hanya milik sendiri
            ->first();

        if (!$kendaraan) {
            return redirect()->route('mahasiswa.kendaraan.index')->with('error', 'Data tidak ditemukan.');
        }

        return view('mahasiswa.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::where('id_kendaraan', $id)->first();

        $messages = [
            'required' => 'Data belum lengkap.',
            'image'    => 'Data yang anda inputkan tidak sesuai dengan format.',
        ];

        $request->validate([
            'nomor_polisi'    => 'required|unique:kendaraan,nomor_polisi,' . $id . ',id_kendaraan',
            'model_kendaraan' => 'required',
            'warna_kendaraan' => 'required',
        ], $messages);

        $dataUpdate = [
            'nomor_polisi'    => strtoupper($request->nomor_polisi),
            'model_kendaraan' => $request->model_kendaraan,
            'warna_kendaraan' => $request->warna_kendaraan,
            'updated_at'      => now(),
        ];

        $nopol = str_replace(' ', '_', strtoupper($request->nomor_polisi));
        $timestamp = time();

        if ($request->hasFile('url_foto_kendaraan')) {
            $request->validate(['url_foto_kendaraan' => 'image|mimes:jpeg,png,jpg|max:2048'], $messages);

            if ($kendaraan->url_foto_kendaraan) Storage::disk('public')->delete($kendaraan->url_foto_kendaraan);

            $fileBaru = $nopol . '_VEHICLE_UPD_' . $timestamp . '.' . $request->file('url_foto_kendaraan')->getClientOriginalExtension();
            $dataUpdate['url_foto_kendaraan'] = $request->file('url_foto_kendaraan')->storeAs('kendaraan', $fileBaru, 'public');
        }

        if ($request->hasFile('url_foto_stnk')) {
            $request->validate(['url_foto_stnk' => 'image|mimes:jpeg,png,jpg|max:2048'], $messages);

            if ($kendaraan->url_foto_stnk) Storage::disk('public')->delete($kendaraan->url_foto_stnk);

            $fileBaruStnk = $nopol . '_STNK_UPD_' . $timestamp . '.' . $request->file('url_foto_stnk')->getClientOriginalExtension();
            $dataUpdate['url_foto_stnk'] = $request->file('url_foto_stnk')->storeAs('stnk', $fileBaruStnk, 'public');
        }

        DB::table('kendaraan')->where('id_kendaraan', $id)->update($dataUpdate);

        return redirect()->route('mahasiswa.kendaraan.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::where('id_kendaraan', $id)->first();

        if ($kendaraan) {
            if ($kendaraan->url_foto_kendaraan) Storage::disk('public')->delete($kendaraan->url_foto_kendaraan);
            if ($kendaraan->url_foto_stnk) Storage::disk('public')->delete($kendaraan->url_foto_stnk);

            Kendaraan::where('id_kendaraan', $id)->delete();
            return redirect()->route('mahasiswa.kendaraan.index')->with('success', 'Data Berhasil Dihapus');
        }

        return redirect()->route('mahasiswa.kendaraan.index')->with('error', 'Gagal menghapus data.');
    }
}
