<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['kode_barang', 'nama_barang', 'kategori_id', 'stok', 'satuan', 'harga', 'deskripsi', 'lokasi_gudang', 'stok_minimum'])]
class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    /**
     * Get the kategori that owns the barang.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_id');
    }

    /**
     * Check if stock is below minimum.
     */
    public function isLowStock(): bool
    {
        return $this->stok <= $this->stok_minimum;
    }
}
