<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Keluhan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {

        $countSatpam = User::where('role', 'satpam')->count();
        $countMahasiswa = User::where('role', 'mahasiswa')->count();
        $countKeluhan = Keluhan::where('status_keluhan', 'belum_ditangani')->count();
        $countKendaraan = 0; // Placeholder

        $lastSatpam = User::where('role', 'satpam')->latest()->first();

        $lastKeluhanMasuk = Keluhan::where('status_keluhan', 'belum_ditangani')->latest()->first();

        $lastKeluhanSelesai = Keluhan::where('status_keluhan', 'sudah_ditangani')->latest()->first();

        return view('dashboard.dashboard_admin', compact(
            'countSatpam',
            'countMahasiswa',
            'countKeluhan',
            'countKendaraan',
            'lastSatpam',
            'lastKeluhanMasuk',
            'lastKeluhanSelesai'
        ));
    }

    public function satpam()
    {
        // Mengambil 5 data scan terbaru (UC004: Basic Flow 2)
        $recentScans = \App\Models\Parkir::with(['user', 'kendaraan'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.dashboard_satpam', compact('recentScans'));
    }

    public function showScanDetail($id)
    {
        // Mengambil detail untuk verifikasi (UC004: Basic Flow 4)
        $parkir = \App\Models\Parkir::with(['user', 'kendaraan'])->findOrFail($id);
        return view('satpam.show_scan', compact('parkir'));
    }

    public function mahasiswa()
    {
        return view('dashboard.dashboard_mahasiswa');
    }
}
