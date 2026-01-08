<?php

namespace App\Http\Controllers;

use App\Models\Qrcode;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class QRCodeController extends Controller
{
    public function qrIndex()
    {
        return view('satpam.qr_display');
    }

    public function getNewQR()
    {
        try {
            $newQR = Qrcode::create([
                'kode_unik'  => (string) Str::uuid(),
                'expires_at' => Carbon::now()->addMinutes(10),
            ]);

            return response()->json([
                'success'      => true,
                'id_qrcode'    => $newQR->id_qrcode,
                'kode_unik'    => $newQR->kode_unik,
                // Pastikan format waktu sesuai
                'generated_at' => Carbon::parse($newQR->created_at)->format('H:i:s'),
                'date_full'    => Carbon::parse($newQR->created_at)->translatedFormat('d F Y')
            ]);
        } catch (\Exception $e) {
            // Tampilkan pesan error detail jika gagal (untuk debug)
            return response()->json([
                'success' => false,
                'message' => 'DB Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
