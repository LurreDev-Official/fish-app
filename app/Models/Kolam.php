<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kolam extends Model
{
       use HasFactory;
    protected $primaryKey = 'kolam_id';

    protected $fillable = [
        'nama_kolam',
        'jenis_ikan',
        'kapasitas',
        'lokasi',
        'tanggal_dibuat',
    ];

    protected $casts = [
        'tanggal_dibuat' => 'datetime',
    ];
}
