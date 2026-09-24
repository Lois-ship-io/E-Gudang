@extends('layouts.app')

@section('title', 'Ringkasan Dashboard')

@section('content')
<div class="space-y-6 sm:space-y-8">
    
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Stat Card 1 -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center gap-5">
            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                <i data-lucide="box" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Barang</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-0.5">{{ number_format($totalBarang) }}</h3>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center gap-5">
            <div class="w-12 h-12 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 shrink-0">
                <i data-lucide="tags" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Kategori</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-0.5">{{ number_format($totalKategori) }}</h3>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center gap-5">
            <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600 shrink-0">
                <i data-lucide="layers" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Fisik Stok</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-0.5">{{ number_format($totalStok) }}</h3>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center gap-5">
            <div class="w-12 h-12 rounded-full bg-amber-50 flex items-center justify-center text-amber-600 shrink-0">
                <i data-lucide="wallet" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Estimasi Nilai Aset</p>
                <h3 class="text-lg font-bold text-slate-900 mt-0.5 truncate max-w-[120px]" title="Rp {{ number_format($totalNilai, 0, ',', '.') }}">Rp {{ number_format($totalNilai, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 sm:gap-8">
        
        <!-- Left Column (Wider) -->
        <div class="xl:col-span-2 space-y-6 sm:space-y-8">
            
            <!-- Recent Items Table -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-slate-900">Barang Ditambahkan Baru</h3>
                        <p class="text-sm text-slate-500 mt-0.5">Daftar item terakhir yang masuk ke dalam sistem.</p>
                    </div>
                    <a href="{{ route('barang.index') }}" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">
                        Lihat Semua <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
                <div class="overflow-x-auto table-wrapper">
                    <table class="w-full text-left border-collapse min-w-[500px]">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Barang</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($recentBarang as $barang)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-slate-900">{{ $barang->nama_barang }}</span>
                                        <span class="text-xs text-slate-500 mt-0.5">{{ $barang->kode_barang }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-700">
                                        {{ $barang->kategori->nama_kategori }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex flex-col items-end">
                                        <span class="text-sm font-semibold {{ $barang->stok <= $barang->stok_minimum ? 'text-red-600' : 'text-slate-900' }}">
                                            {{ $barang->stok }} <span class="text-xs font-normal text-slate-500">{{ $barang->satuan }}</span>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                            <i data-lucide="package-x" class="w-6 h-6 text-slate-400"></i>
                                        </div>
                                        <p class="text-sm font-medium text-slate-900">Belum ada barang</p>
                                        <p class="text-xs text-slate-500 mt-1">Sistem belum memiliki data barang sama sekali.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-slate-100 sm:hidden">
                    <a href="{{ route('barang.index') }}" class="flex items-center justify-center gap-1.5 text-sm font-medium text-blue-600 hover:text-blue-700 w-full py-2 bg-blue-50 rounded-lg">
                        Lihat Semua Data
                    </a>
                </div>
            </div>

        </div>

        <!-- Right Column -->
        <div class="space-y-6 sm:space-y-8">
            
            <!-- Low Stock Alert -->
            <div class="bg-white rounded-2xl border border-red-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-red-100 bg-red-50/50 flex items-center justify-between">
                    <h3 class="text-base font-semibold text-red-800 flex items-center gap-2">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600"></i>
                        Peringatan Stok Menipis
                    </h3>
                </div>
                <div class="p-0">
                    <ul class="divide-y divide-slate-100">
                        @forelse($lowStockItems as $item)
                        <li class="px-6 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                            <div class="min-w-0 flex-1 pr-4">
                                <p class="text-sm font-medium text-slate-900 truncate">{{ $item->nama_barang }}</p>
                                <p class="text-xs text-slate-500 mt-0.5 truncate">Min. threshold: {{ $item->stok_minimum }}</p>
                            </div>
                            <div class="text-right shrink-0">
                                <span class="inline-flex items-center justify-center px-2.5 py-1 rounded-md bg-red-100 text-xs font-semibold text-red-700">
                                    Sisa {{ $item->stok }}
                                </span>
                            </div>
                        </li>
                        @empty
                        <li class="px-6 py-10 text-center">
                            <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i data-lucide="check" class="w-6 h-6 text-green-500"></i>
                            </div>
                            <p class="text-sm font-medium text-slate-900">Stok Aman</p>
                            <p class="text-xs text-slate-500 mt-1">Semua barang berada di atas batas minimum.</p>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Categories distribution -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100">
                    <h3 class="text-base font-semibold text-slate-900">Distribusi Kategori</h3>
                    <p class="text-sm text-slate-500 mt-0.5">Proporsi item berdasarkan kategori.</p>
                </div>
                <div class="p-6">
                    <div class="space-y-5">
                        @foreach($kategoriStats->take(5) as $stat)
                        <div>
                            <div class="flex items-center justify-between text-sm mb-1.5">
                                <span class="font-medium text-slate-700 truncate pr-4">{{ $stat->nama_kategori }}</span>
                                <span class="text-slate-500 text-xs shrink-0">{{ $stat->barangs_count }} item</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                @php
                                    $percentage = $totalBarang > 0 ? ($stat->barangs_count / $totalBarang) * 100 : 0;
                                @endphp
                                <div class="bg-indigo-500 h-full rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                        @endforeach
                        
                        @if($kategoriStats->isEmpty())
                        <div class="text-center py-4">
                            <p class="text-sm text-slate-500">Belum ada data kategori.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
