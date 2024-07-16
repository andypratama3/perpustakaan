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
        Schema::create('dendas', function (Blueprint $table) {
            $table->id();
            $table->string('no_peminjaman');
            $table->string('status');
            $table->string('total_denda');
            $table->string('lama_terlambat');
            $table->foreignId('peminjamans_id')->constrained('peminjamans')->onDelete('cascade');
            $table->foreignId('members_id')->constrained('members')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dendas');
    }
};
