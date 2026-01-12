<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user'; // Nama PK custom
    public $incrementing = false;     // Matikan auto-increment
    protected $keyType = 'string';    // Tipe data PK adalah string

    protected $fillable = [
        'id_user',
        'nama_user',
        'nim',
        'username',
        'password',
        'email',
        'role'
    ];

    protected $hidden = ['password'];

    // Relasi: User punya banyak kendaraan
    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class, 'users_id', 'id_user');
    }

    // Relasi: User punya banyak keluhan
    public function keluhan()
    {
        return $this->hasMany(Keluhan::class, 'users_id', 'id_user');
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $last = static::orderByDesc($model->getKeyName())->first();
            $num = $last ? (int) substr($last->{$model->getKeyName()}, 1) + 1 : 1;
            $model->{$model->getKeyName()} = 'U' . str_pad($num, 4, '0', STR_PAD_LEFT);
        });
    }
}
