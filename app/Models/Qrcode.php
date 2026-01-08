<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qrcode extends Model
{
    protected $table = 'qrcode';
    protected $primaryKey = 'id_qrcode';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'id_qrcode',
        'kode_unik',
        'expires_at',
        'created_at'
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $last = static::orderByDesc($model->getKeyName())->first();
            // Logika custom ID 'Q0001' tetap aman digunakan
            $num = $last ? (int) substr($last->{$model->getKeyName()}, 1) + 1 : 1;
            $model->{$model->getKeyName()} = 'Q' . str_pad($num, 4, '0', STR_PAD_LEFT);

            // Isi created_at manual karena timestamps dimatikan
            $model->created_at = now();
        });
    }
}
