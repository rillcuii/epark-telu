<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qrcode extends Model
{
    protected $table = 'qrcode';
    protected $primaryKey = 'id_qrcode';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_qrcode',
        'kode_unik',
        'expires_at'
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $last = static::orderByDesc($model->getKeyName())->first();
            $num = $last ? (int) substr($last->{$model->getKeyName()}, 1) + 1 : 1;
            $model->{$model->getKeyName()} = 'Q' . str_pad($num, 4, '0', STR_PAD_LEFT);
        });
    }
}
