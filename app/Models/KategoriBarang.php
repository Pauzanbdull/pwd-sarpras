<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class KategoriBarang extends Model
{
    use HasFactory;

    // Jika nama tabel sesuai konvensi Laravel (kategori_barangs), ini bisa dihapus
    protected $table = 'kategori_barang';

    protected $fillable = ['nama_kategori'];

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kategori_id');
    }
}
