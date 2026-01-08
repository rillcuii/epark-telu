<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'id_kendaraan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_kendaraan',
        'users_id',
        'nomor_polisi',
        'model_kendaraan',
        'warna_kendaraan',
        'url_foto_kendaraan',
        'url_foto_stnk'
    ];

    // Relasi balik ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id_user');
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $last = static::orderByDesc($model->getKeyName())->first();
            $num = $last ? (int) substr($last->{$model->getKeyName()}, 1) + 1 : 1;
            $model->{$model->getKeyName()} = 'K' . str_pad($num, 4, '0', STR_PAD_LEFT);
        });
    }
}
