<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    use HasFactory;

    protected $table = 'kategori_barang';

    // Kolom yang boleh diisi massal
    protected $fillable = ['nama_kategori'];

    // Relasi dengan Barang
    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
