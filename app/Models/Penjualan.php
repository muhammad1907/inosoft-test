<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Penjualan extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'penjualan';
    protected $primaryKey = '_id';

    protected $fillable = [
        'user_id',
        'mobil_motor_id',
        'jenis_kendaraan'
    ];
}
