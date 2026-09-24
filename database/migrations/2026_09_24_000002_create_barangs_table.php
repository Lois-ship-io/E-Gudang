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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->foreignId('kategori_id')->constrained('kategori_barangs')->onDelete('cascade');
            $table->integer('stok')->default(0);
            $table->string('satuan')->default('pcs');
            $table->decimal('harga', 15, 2)->default(0);
            $table->text('deskripsi')->nullable();
            $table->string('lokasi_gudang')->nullable();
            $table->integer('stok_minimum')->default(0);
            $table->timestamps();
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
