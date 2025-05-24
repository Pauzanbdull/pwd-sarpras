<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');           // kolom nama_barang
            $table->unsignedBigInteger('kategori_id'); // foreign key kategori dengan nama kategori_id
            $table->text('deskripsi')->nullable();   // kolom deskripsi, boleh kosong
            $table->string('gambar')->nullable();    // kolom gambar, boleh kosong
            $table->integer('stock')->default(0);    // kolom stock, default 0
            $table->timestamps();

            $table->foreign('kategori_id')
                ->references('id')->on('kategori_barang')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
