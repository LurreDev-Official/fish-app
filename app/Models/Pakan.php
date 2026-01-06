<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pakan extends Model
{
    use HasFactory;
    // Menentukan nama primary key
    public $timestamps = false; // Jika tidak menggunakan created_at dan updated_at

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama_pakan',
        'kategori',
        'satuan',
        'harga_per_kg',
    ];

}
