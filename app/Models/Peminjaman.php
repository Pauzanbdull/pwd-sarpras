<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_peminjam',
        'barang_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

}
