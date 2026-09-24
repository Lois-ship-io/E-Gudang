<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $kategoris = KategoriBarang::withCount('barangs')
            ->when($search, function ($query, $search) {
                $query->where('nama_kategori', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('kategori.index', compact('kategoris', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255', 'unique:kategori_barangs,nama_kategori'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
        ]);

        KategoriBarang::create($validated);

        return redirect()->route('kategori.index')->with('success', 'Kategori barang berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriBarang $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriBarang $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255', 'unique:kategori_barangs,nama_kategori,' . $kategori->id],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
        ]);

        $kategori->update($validated);

        return redirect()->route('kategori.index')->with('success', 'Kategori barang berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriBarang $kategori)
    {
        if ($kategori->barangs()->count() > 0) {
            return redirect()->route('kategori.index')->with('error', 'Tidak dapat menghapus kategori yang masih memiliki barang!');
        }

        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori barang berhasil dihapus!');
    }
}
