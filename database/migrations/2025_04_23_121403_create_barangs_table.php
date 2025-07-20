<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Migration ini membuat tabel 'barangs' untuk menyimpan data barang inventaris.
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id(); // Primary key otomatis
            $table->string('nama_barang'); // Nama barang
            $table->text('deskripsi')->nullable(); // Deskripsi barang (boleh kosong)
            $table->string('gambar')->nullable(); // Path gambar barang (boleh kosong)
            
            // Foreign key ke tabel kategori_barang
            $table->foreignId('kategori_id')
                  ->constrained('kategori_barang') // Pastikan ini sesuai nama tabel yang ada
                  ->onDelete('cascade'); // Jika kategori dihapus, barang ikut terhapus

            $table->integer('stock')->default(0); // Jumlah stok barang
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * Digunakan saat rollback, untuk menghapus tabel 'barangs'.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
