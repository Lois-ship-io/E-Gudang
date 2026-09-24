@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
<div class="space-y-6">
    
    <!-- Action Bar & Filters -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        
        <form action="{{ route('barang.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto flex-1 max-w-4xl">
            
            <!-- Search -->
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </div>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari kode atau nama barang..." 
                    class="block w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all shadow-sm">
            </div>
            
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                <!-- Category Filter -->
                <div class="relative w-full sm:w-56">
                    <select name="kategori_id" class="block w-full py-2.5 pl-4 pr-10 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white text-slate-700 transition-all appearance-none shadow-sm outline-none">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ $kategori_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </div>
                </div>
                
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <button type="submit" class="flex-1 sm:flex-none px-4 py-2.5 bg-slate-100 text-slate-700 hover:bg-slate-200 text-sm font-medium rounded-xl transition-colors border border-slate-200 shadow-sm shrink-0">
                        Filter
                    </button>
                    
                    @if($search || $kategori_id)
                    <a href="{{ route('barang.index') }}" class="flex items-center justify-center w-10 h-10 bg-white text-slate-400 hover:text-red-600 hover:bg-red-50 border border-slate-200 rounded-xl transition-colors shadow-sm shrink-0" title="Reset Filter">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </a>
                    @endif
                </div>
            </div>
        </form>

        <div class="shrink-0 w-full lg:w-auto mt-2 lg:mt-0 pt-4 lg:pt-0 border-t border-slate-100 lg:border-t-0">
            <a href="{{ route('barang.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm w-full">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Barang
            </a>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto table-wrapper">
            <table class="w-full text-left border-collapse min-w-[900px]">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider w-24">Kode</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Info Barang</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Stok</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Harga Satuan</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($barangs as $barang)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                {{ $barang->kode_barang }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-slate-900">{{ $barang->nama_barang }}</span>
                                <span class="text-xs text-slate-500 mt-0.5">{{ $barang->kategori->nama_kategori }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex flex-col items-end">
                                <span class="text-sm font-semibold {{ $barang->isLowStock() ? 'text-red-600' : 'text-slate-900' }}">
                                    {{ $barang->stok }} <span class="text-xs font-normal text-slate-500 ml-1">{{ $barang->satuan }}</span>
                                </span>
                                @if($barang->isLowStock())
                                    <span class="text-[10px] text-red-600 font-medium mt-0.5 flex items-center gap-1">
                                        <i data-lucide="alert-circle" class="w-3 h-3"></i> Menipis
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <span class="text-sm font-medium text-slate-700">
                                Rp {{ number_format($barang->harga, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($barang->lokasi_gudang)
                            <div class="flex items-center gap-1.5 text-sm text-slate-600">
                                <i data-lucide="map-pin" class="w-4 h-4 text-slate-400"></i>
                                {{ $barang->lokasi_gudang }}
                            </div>
                            @else
                            <span class="text-sm text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity focus-within:opacity-100">
                                <a href="{{ route('barang.show', $barang->id) }}" class="p-2 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors focus:opacity-100" title="Detail">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </a>
                                <a href="{{ route('barang.edit', $barang->id) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors focus:opacity-100" title="Edit">
                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors focus:opacity-100" title="Hapus">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-4">
                                    <i data-lucide="package-search" class="w-8 h-8 text-slate-400"></i>
                                </div>
                                <h3 class="text-base font-semibold text-slate-900 mb-1">Data tidak ditemukan</h3>
                                <p class="text-sm text-slate-500">
                                    {{ ($search || $kategori_id) ? 'Tidak ada barang yang cocok dengan kriteria pencarian Anda.' : 'Anda belum menambahkan data barang apapun ke dalam sistem.' }}
                                </p>
                                @if(!($search || $kategori_id))
                                <a href="{{ route('barang.create') }}" class="mt-4 text-sm font-medium text-blue-600 hover:text-blue-700">
                                    Tambah Barang Pertama
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($barangs->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $barangs->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
