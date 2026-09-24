<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nama_kategori', 'deskripsi'])]
class KategoriBarang extends Model
{
    use HasFactory;

    protected $table = 'kategori_barangs';

    /**
     * Get all barangs for this kategori.
     */
    public function barangs(): HasMany
    {
        return $this->hasMany(Barang::class, 'kategori_id');
    }
}
