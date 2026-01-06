<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembelianPakan extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'pakan_id',
        'supplier_id',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'tanggal_pembelian',
        'user_id',
    ];

    protected $casts = [
        'tanggal_pembelian' => 'datetime',
    ];

    // Relasi ke Pakan
    public function pakan()
    {
        return $this->belongsTo(Pakan::class);
    }

    // Relasi ke Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relasi ke User (yang mencatat transaksi)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
