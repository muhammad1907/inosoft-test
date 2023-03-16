<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Kendaraan extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'kendaraan';
    protected $primaryKey = '_id';
    protected $fillable = [
        'tahun_keluaran',
        'warna',
        'harga',
    ];

    public function motors()
    {
        return $this->hasMany(Motor::class);
    }

    public function mobils()
    {
        return $this->hasMany(Mobil::class);
    }
}
