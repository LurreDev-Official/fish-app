<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenggunaanPakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pakan_id',
        'kolam_id',
        'jumlah',
        'tanggal',
        'user_id',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    // Relasi ke Pakan
    public function pakan()
    {
        return $this->belongsTo(Pakan::class);
    }

    // Relasi ke Kolam
    public function kolam()
    {
        return $this->belongsTo(Kolam::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
