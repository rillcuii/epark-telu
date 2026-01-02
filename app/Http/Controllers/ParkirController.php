<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use Illuminate\Http\Request;
use App\Models\Qrcode as QrModel;
use App\Models\Kendaraan;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ParkirController extends Controller
{
    public function riwayat(Request $request)
    {
        $query = Parkir::with(['user', 'kendaraan']);

        // Filter berdasarkan Tanggal (Langkah 3 di Use Case)
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('waktu_masuk', $request->tanggal);
        }

        $riwayats = $query->latest('waktu_masuk')->paginate(10);

        return view('satpam.riwayat.index', compact('riwayats'));
    }

    public function detailRiwayat($id)
    {
        $parkir = Parkir::with(['user', 'kendaraan'])->findOrFail($id);
        return view('satpam.riwayat.show', compact('parkir'));
    }

    public function pilihKendaraan()
    {
        $userId = auth()->user()->id_user; // U0004

        // Cek apakah user punya sesi parkir yang belum selesai (status masuk)
        $activeParking = Parkir::join('kendaraan', 'parkir.kendaraan_id', '=', 'kendaraan.id_kendaraan')
            ->where('parkir.users_id', $userId)
            ->where('parkir.status', 'masuk')
            ->select('parkir.*', 'kendaraan.model_kendaraan', 'kendaraan.nomor_polisi')
            ->first();

        // Jika sedang parkir, kirim data parkir aktifnya
        if ($activeParking) {
            return view('mahasiswa.pilih_kendaraan', [
                'activeParking' => $activeParking,
                'kendaraans' => [] // Kosongkan daftar pilihan
            ]);
        }

        // Jika tidak ada parkir aktif, tampilkan semua kendaraan miliknya
        $kendaraans = Kendaraan::where('users_id', $userId)->get();
        return view('mahasiswa.pilih_kendaraan', compact('kendaraans', 'activeParking'));
    }

    public function bukaScanner($id_kendaraan)
    {
        // 1. Ambil data kendaraan berdasarkan ID yang dipilih
        $kendaraan = Kendaraan::where('id_kendaraan', $id_kendaraan)->firstOrFail();

        // 2. Ambil ID user yang sedang login (Contoh: U0004)
        $userId = auth()->user()->id_user;

        // 3. Cari apakah user ini punya sesi parkir yang statusnya masih 'masuk'
        $activeParking = \App\Models\Parkir::where('users_id', $userId)
            ->where('status', 'masuk')
            ->first();

        // 4. Kirim kedua variabel ke view agar error $activeParking hilang
        return view('mahasiswa.scanner', compact('kendaraan', 'activeParking'));
    }

    public function scanProses(Request $request)
    {
        // 1. Validasi QR Code di database
        $qr = QrModel::where('kode_unik', $request->kode_unik)
            ->where('expires_at', '>', Carbon::now('Asia/Jakarta'))
            ->first();

        if (!$qr) {
            return response()->json(['success' => false, 'message' => 'QR Kadaluwarsa atau Tidak Valid!']);
        }

        $userId = auth()->user()->id_user;
        $kendaraanId = $request->id_kendaraan;

        // 2. Cek status parkir terakhir (Auto Masuk/Keluar)
        $lastParkir = Parkir::where('users_id', $userId)
            ->where('kendaraan_id', $kendaraanId)
            ->orderBy('created_at', 'desc')
            ->first();

        // Logika: Jika data terakhir statusnya 'masuk' dan belum ada waktu_keluar, maka sekarang 'keluar'
        if ($lastParkir && $lastParkir->status == 'masuk' && is_null($lastParkir->waktu_keluar)) {
            $lastParkir->update([
                'waktu_keluar' => Carbon::now('Asia/Jakarta'),
                'status' => 'keluar'
            ]);
            return response()->json(['success' => true, 'message' => 'Berhasil Scan Keluar!']);
        } else {
            // Jika tidak ada data aktif, maka 'masuk'
            Parkir::create([
                'id_parkir' => (string) Str::uuid(),
                'users_id' => $userId,
                'kendaraan_id' => $kendaraanId,
                'qrcode_id' => $qr->id_qrcode,
                'waktu_masuk' => Carbon::now('Asia/Jakarta'),
                'status' => 'masuk',
                'created_at' => Carbon::now('Asia/Jakarta')
            ]);
            return response()->json(['success' => true, 'message' => 'Berhasil Scan Masuk!']);
        }
    }

    public function showVerifikasi($id_parkir)
    {
        $data = Parkir::join('users', 'parkir.users_id', '=', 'users.id_user')
            ->join('kendaraan', 'parkir.kendaraan_id', '=', 'kendaraan.id_kendaraan')
            ->where('parkir.id_parkir', $id_parkir)
            ->select(
                'parkir.*',
                'users.nama_user',
                'users.nim',
                'users.email',
                'users.username', // Data User
                'kendaraan.nomor_polisi',
                'kendaraan.model_kendaraan',
                'kendaraan.warna_kendaraan',
                'kendaraan.url_foto_kendaraan',
                'kendaraan.url_foto_stnk' // Data Kendaraan
            )
            ->firstOrFail();

        return view('satpam.detail_verifikasi', compact('data'));
    }

    public function riwayatMahasiswa(Request $request)
    {
        $userId = auth()->user()->id_user;

        $query = Parkir::join('kendaraan', 'parkir.kendaraan_id', '=', 'kendaraan.id_kendaraan')
            ->where('parkir.users_id', $userId)
            ->select('parkir.*', 'kendaraan.model_kendaraan', 'kendaraan.nomor_polisi');

        // Fitur Filter Tanggal (Basic Flow point 3)
        if ($request->filled('tanggal')) {
            $query->whereDate('parkir.waktu_masuk', $request->tanggal);
        }

        $history = $query->orderBy('parkir.waktu_masuk', 'desc')->get();

        return view('mahasiswa.riwayat.index', compact('history'));
    }

    public function detailRiwayatMahasiswa($id_parkir)
    {
        $userId = auth()->user()->id_user;

        // Mengambil data lengkap (Basic Flow point 5 & 6)
        $detail = Parkir::join('users', 'parkir.users_id', '=', 'users.id_user')
            ->join('kendaraan', 'parkir.kendaraan_id', '=', 'kendaraan.id_kendaraan')
            ->where('parkir.id_parkir', $id_parkir)
            ->where('parkir.users_id', $userId) // Keamanan: Pastikan milik sendiri
            ->select(
                'parkir.*',
                'users.nama_user',
                'kendaraan.nomor_polisi',
                'kendaraan.model_kendaraan',
                'kendaraan.warna_kendaraan',
                'kendaraan.url_foto_kendaraan',
                'kendaraan.url_foto_stnk'
            )
            ->firstOrFail();

        return view('mahasiswa.riwayat.detail', compact('detail'));
    }
}
