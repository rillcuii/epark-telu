<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parkir extends Model
{
    protected $table = 'parkir';
    protected $primaryKey = 'id_parkir';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_parkir',
        'users_id',
        'kendaraan_id',
        'qrcode_id',
        'waktu_masuk',
        'waktu_keluar',
        'status'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id_user');
    }

    // Relasi ke Kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id', 'id_kendaraan');
    }

    // Relasi ke Qrcode
    public function qrcode()
    {
        return $this->belongsTo(Qrcode::class, 'qrcode_id', 'id_qrcode');
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $last = static::orderByDesc($model->getKeyName())->first();
            $num = $last ? (int) substr($last->{$model->getKeyName()}, 1) + 1 : 1;
            $model->{$model->getKeyName()} = 'P' . str_pad($num, 4, '0', STR_PAD_LEFT);
        });
    }
}
