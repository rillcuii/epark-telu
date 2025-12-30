<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    protected $table = 'keluhan';
    protected $primaryKey = 'id_keluhan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_keluhan',
        'users_id',
        'judul_keluhan',
        'keterangan_keluhan',
        'status_keluhan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id_user');
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $last = static::orderByDesc($model->getKeyName())->first();
            $num = $last ? (int) substr($last->{$model->getKeyName()}, 1) + 1 : 1;
            $model->{$model->getKeyName()} = 'C' . str_pad($num, 4, '0', STR_PAD_LEFT);
        });
    }
}
