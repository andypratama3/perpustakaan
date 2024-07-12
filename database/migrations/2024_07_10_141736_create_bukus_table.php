<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pengarang');
            $table->string('penerbit');
            $table->string('deskripsi');
            $table->string('kode_buku');
            $table->integer('stok');
            $table->string('tahun_terbit');
            $table->string('rak');
            $table->foreignId('kategoris_id')->references('id')->on('kategoris')->onDelete('cascade');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
