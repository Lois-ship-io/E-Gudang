@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('barang.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-slate-700 transition-colors shadow-sm shrink-0">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h2 class="text-xl font-bold text-slate-900">Tambah Data Barang</h2>
            <p class="text-sm text-slate-500 mt-0.5">Masukkan detail informasi barang ke dalam inventaris.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="{{ route('barang.store') }}" method="POST" class="p-6 sm:p-8 space-y-8">
            @csrf

            <!-- Section 1: Info Dasar -->
            <div class="space-y-5">
                <h3 class="text-sm font-semibold text-slate-900 border-b border-slate-100 pb-2">Informasi Dasar</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="kode_barang" class="block text-sm font-medium text-slate-700 mb-2">Kode Barang (SKU) <span class="text-red-500">*</span></label>
                        <input type="text" name="kode_barang" id="kode_barang" value="{{ old('kode_barang') }}" required autofocus
                            class="block w-full px-4 py-3 bg-white border @error('kode_barang') border-red-300 focus:ring-red-500/20 focus:border-red-500 @else border-slate-200 focus:ring-blue-500/20 focus:border-blue-500 @enderror rounded-xl text-sm transition-all shadow-sm outline-none focus:ring-2"
                            placeholder="Contoh: BRG-001">
                        @error('kode_barang')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="nama_barang" class="block text-sm font-medium text-slate-700 mb-2">Nama Barang <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}" required
                            class="block w-full px-4 py-3 bg-white border @error('nama_barang') border-red-300 focus:ring-red-500/20 focus:border-red-500 @else border-slate-200 focus:ring-blue-500/20 focus:border-blue-500 @enderror rounded-xl text-sm transition-all shadow-sm outline-none focus:ring-2"
                            placeholder="Contoh: Laptop Asus ROG">
                        @error('nama_barang')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="kategori_id" class="block text-sm font-medium text-slate-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="kategori_id" id="kategori_id" required
                                class="block w-full pl-4 pr-10 py-3 bg-white border @error('kategori_id') border-red-300 focus:ring-red-500/20 focus:border-red-500 @else border-slate-200 focus:ring-blue-500/20 focus:border-blue-500 @enderror rounded-xl text-sm transition-all appearance-none shadow-sm outline-none focus:ring-2">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </div>
                        </div>
                        @error('kategori_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section 2: Stok & Harga -->
            <div class="space-y-5">
                <h3 class="text-sm font-semibold text-slate-900 border-b border-slate-100 pb-2">Stok & Harga</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="stok" class="block text-sm font-medium text-slate-700 mb-2">Jumlah Stok Awal <span class="text-red-500">*</span></label>
                        <input type="number" name="stok" id="stok" value="{{ old('stok', 0) }}" min="0" required
                            class="block w-full px-4 py-3 bg-white border @error('stok') border-red-300 focus:ring-red-500/20 focus:border-red-500 @else border-slate-200 focus:ring-blue-500/20 focus:border-blue-500 @enderror rounded-xl text-sm transition-all shadow-sm outline-none focus:ring-2">
                        @error('stok')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="satuan" class="block text-sm font-medium text-slate-700 mb-2">Satuan Unit <span class="text-red-500">*</span></label>
                        <input type="text" name="satuan" id="satuan" value="{{ old('satuan', 'pcs') }}" required
                            class="block w-full px-4 py-3 bg-white border @error('satuan') border-red-300 focus:ring-red-500/20 focus:border-red-500 @else border-slate-200 focus:ring-blue-500/20 focus:border-blue-500 @enderror rounded-xl text-sm transition-all shadow-sm outline-none focus:ring-2"
                            placeholder="pcs, box, kg...">
                        @error('satuan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stok_minimum" class="block text-sm font-medium text-slate-700 mb-2">Peringatan Stok Minimum <span class="text-red-500">*</span></label>
                        <input type="number" name="stok_minimum" id="stok_minimum" value="{{ old('stok_minimum', 5) }}" min="0" required
                            class="block w-full px-4 py-3 bg-white border @error('stok_minimum') border-red-300 focus:ring-red-500/20 focus:border-red-500 @else border-slate-200 focus:ring-blue-500/20 focus:border-blue-500 @enderror rounded-xl text-sm transition-all shadow-sm outline-none focus:ring-2">
                        <p class="mt-1.5 text-xs text-slate-500">Sistem akan memberi peringatan jika stok mencapai angka ini.</p>
                        @error('stok_minimum')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="harga" class="block text-sm font-medium text-slate-700 mb-2">Harga Satuan (Rp) <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 font-medium">
                                Rp
                            </div>
                            <input type="number" name="harga" id="harga" value="{{ old('harga', 0) }}" min="0" step="0.01" required
                                class="block w-full pl-12 pr-4 py-3 bg-white border @error('harga') border-red-300 focus:ring-red-500/20 focus:border-red-500 @else border-slate-200 focus:ring-blue-500/20 focus:border-blue-500 @enderror rounded-xl text-sm transition-all shadow-sm outline-none focus:ring-2">
                        </div>
                        @error('harga')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section 3: Tambahan -->
            <div class="space-y-5">
                <h3 class="text-sm font-semibold text-slate-900 border-b border-slate-100 pb-2">Informasi Tambahan</h3>
                
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="lokasi_gudang" class="block text-sm font-medium text-slate-700 mb-2">Lokasi Penempatan Gudang <span class="text-slate-400 font-normal">(Opsional)</span></label>
                        <input type="text" name="lokasi_gudang" id="lokasi_gudang" value="{{ old('lokasi_gudang') }}"
                            class="block w-full px-4 py-3 bg-white border @error('lokasi_gudang') border-red-300 focus:ring-red-500/20 focus:border-red-500 @else border-slate-200 focus:ring-blue-500/20 focus:border-blue-500 @enderror rounded-xl text-sm transition-all shadow-sm outline-none focus:ring-2"
                            placeholder="Contoh: Rak A-01">
                        @error('lokasi_gudang')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-2">Deskripsi Barang <span class="text-slate-400 font-normal">(Opsional)</span></label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="block w-full px-4 py-3 bg-white border @error('deskripsi') border-red-300 focus:ring-red-500/20 focus:border-red-500 @else border-slate-200 focus:ring-blue-500/20 focus:border-blue-500 @enderror rounded-xl text-sm transition-all shadow-sm outline-none focus:ring-2"
                            placeholder="Tuliskan keterangan detail mengenai barang ini...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="pt-6 mt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row sm:items-center justify-end gap-3">
                <a href="{{ route('barang.index') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 hover:text-slate-900 rounded-xl transition-colors w-full sm:w-auto">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-sm focus:ring-4 focus:ring-blue-100 transition-all w-full sm:w-auto">
                    Simpan Data Barang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
