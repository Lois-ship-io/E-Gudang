@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('barang.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-slate-700 transition-colors shadow-sm shrink-0">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h2 class="text-xl font-bold text-slate-900">Detail Barang</h2>
                <p class="text-sm text-slate-500 mt-0.5">Melihat informasi detail mengenai barang.</p>
            </div>
        </div>
        
        <div class="flex items-center gap-2">
            <a href="{{ route('barang.edit', $barang->id) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white text-slate-700 border border-slate-200 text-sm font-medium rounded-xl hover:bg-slate-50 transition-colors shadow-sm">
                <i data-lucide="edit" class="w-4 h-4 text-blue-600"></i>
                <span class="hidden sm:inline">Edit Data</span>
            </a>
            
            <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white text-slate-700 border border-slate-200 text-sm font-medium rounded-xl hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-colors shadow-sm">
                    <i data-lucide="trash-2" class="w-4 h-4 text-red-500"></i>
                    <span class="hidden sm:inline">Hapus</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Content Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        
        <!-- Header Section Info -->
        <div class="p-6 sm:p-8 border-b border-slate-100 flex flex-col sm:flex-row sm:items-start justify-between gap-4 bg-slate-50/50">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-white border border-slate-200 text-slate-700 shadow-sm">
                        {{ $barang->kode_barang }}
                    </span>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                        {{ $barang->kategori->nama_kategori }}
                    </span>
                </div>
                <h1 class="text-2xl font-bold text-slate-900">{{ $barang->nama_barang }}</h1>
            </div>
            
            <div class="text-left sm:text-right">
                <p class="text-sm font-medium text-slate-500 mb-1">Harga Satuan</p>
                <p class="text-2xl font-bold text-slate-900">Rp {{ number_format($barang->harga, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Body Detail -->
        <div class="p-6 sm:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Status Stok -->
                <div class="space-y-6">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider text-slate-400">Informasi Stok</h3>
                    
                    <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-medium text-slate-500">Stok Tersedia</span>
                            <span class="text-3xl font-bold {{ $barang->isLowStock() ? 'text-red-600' : 'text-slate-900' }}">
                                {{ $barang->stok }} <span class="text-base font-medium text-slate-500">{{ $barang->satuan }}</span>
                            </span>
                        </div>
                        
                        <div class="w-full bg-slate-200 rounded-full h-2 mb-2 overflow-hidden">
                            @php
                                // Kalkulasi sederhana persentase stok untuk visual
                                $percentage = 100;
                                if ($barang->stok_minimum > 0) {
                                    $percentage = min(100, ($barang->stok / ($barang->stok_minimum * 3)) * 100);
                                }
                                $barColor = $barang->isLowStock() ? 'bg-red-500' : 'bg-emerald-500';
                            @endphp
                            <div class="{{ $barColor }} h-full rounded-full transition-all" style="width: {{ $percentage }}%"></div>
                        </div>
                        
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-500">Min. Peringatan: <strong>{{ $barang->stok_minimum }} {{ $barang->satuan }}</strong></span>
                            @if($barang->isLowStock())
                                <span class="text-red-600 font-semibold flex items-center gap-1">
                                    <i data-lucide="alert-triangle" class="w-3 h-3"></i> Stok Menipis!
                                </span>
                            @else
                                <span class="text-emerald-600 font-semibold flex items-center gap-1">
                                    <i data-lucide="check-circle" class="w-3 h-3"></i> Stok Aman
                                </span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-slate-500 mb-1">Total Nilai Aset Barang Ini</p>
                        <p class="text-lg font-bold text-slate-900">Rp {{ number_format($barang->stok * $barang->harga, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Info Tambahan -->
                <div class="space-y-6 md:pl-8 md:border-l border-slate-100">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider text-slate-400">Detail Tambahan</h3>
                    
                    <div>
                        <p class="text-sm font-medium text-slate-500 mb-1">Lokasi Gudang</p>
                        <div class="flex items-center gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-blue-500"></i>
                            <span class="text-base font-semibold text-slate-900">{{ $barang->lokasi_gudang ?: 'Belum ditentukan' }}</span>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-slate-500 mb-1">Deskripsi</p>
                        <p class="text-sm text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-100">
                            {{ $barang->deskripsi ?: 'Tidak ada deskripsi yang ditambahkan untuk barang ini.' }}
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                        <div>
                            <p class="text-xs font-medium text-slate-500 mb-1">Dibuat Pada</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $barang->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 mb-1">Pembaruan Terakhir</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $barang->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
