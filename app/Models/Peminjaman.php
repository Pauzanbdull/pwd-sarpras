<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman'; // pastikan cocok dengan nama tabel di migration

    protected $fillable = [
        'user_id',
        'barang_id', // diperbaiki dari item_id ke barang_id
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'approved_by',
        'nama_peminjam', // jika kolom ini ada di database
        'jumlah', // jika digunakan di controller
    ];

    // Relasi ke User (peminjam)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    // Relasi ke User (yang menyetujui)
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
