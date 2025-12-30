<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use Illuminate\Http\Request;

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
}
