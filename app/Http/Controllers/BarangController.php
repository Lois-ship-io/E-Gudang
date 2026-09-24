<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategori_id = $request->input('kategori_id');

        $barangs = Barang::with('kategori')
            ->when($search, function ($query, $search) {
                $query->where('nama_barang', 'like', "%{$search}%")
                      ->orWhere('kode_barang', 'like', "%{$search}%");
            })
            ->when($kategori_id, function ($query, $kategori_id) {
                $query->where('kategori_id', $kategori_id);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $kategoris = KategoriBarang::orderBy('nama_kategori')->get();

        return view('barang.index', compact('barangs', 'search', 'kategori_id', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = KategoriBarang::orderBy('nama_kategori')->get();
        return view('barang.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => ['required', 'string', 'max:255', 'unique:barangs,kode_barang'],
            'nama_barang' => ['required', 'string', 'max:255'],
            'kategori_id' => ['required', 'exists:kategori_barangs,id'],
            'stok' => ['required', 'integer', 'min:0'],
            'satuan' => ['required', 'string', 'max:50'],
            'harga' => ['required', 'numeric', 'min:0'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'lokasi_gudang' => ['nullable', 'string', 'max:255'],
            'stok_minimum' => ['required', 'integer', 'min:0'],
        ]);

        Barang::create($validated);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $kategoris = KategoriBarang::orderBy('nama_kategori')->get();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'kode_barang' => ['required', 'string', 'max:255', 'unique:barangs,kode_barang,' . $barang->id],
            'nama_barang' => ['required', 'string', 'max:255'],
            'kategori_id' => ['required', 'exists:kategori_barangs,id'],
            'stok' => ['required', 'integer', 'min:0'],
            'satuan' => ['required', 'string', 'max:50'],
            'harga' => ['required', 'numeric', 'min:0'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'lokasi_gudang' => ['nullable', 'string', 'max:255'],
            'stok_minimum' => ['required', 'integer', 'min:0'],
        ]);

        $barang->update($validated);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus!');
    }
}
