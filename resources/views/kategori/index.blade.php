@extends('layouts.app')

@section('title', 'Kategori Barang')

@section('content')
<div class="space-y-6">
    
    <!-- Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        
        <!-- Search -->
        <form action="{{ route('kategori.index') }}" method="GET" class="w-full sm:max-w-md relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <i data-lucide="search" class="w-4 h-4"></i>
            </div>
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama atau deskripsi kategori..." 
                class="block w-full pl-10 pr-10 py-2.5 bg-white border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all shadow-sm">
            @if($search)
            <a href="{{ route('kategori.index') }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                <i data-lucide="x" class="w-4 h-4"></i>
            </a>
            @endif
        </form>

        <!-- Primary Action -->
        <a href="{{ route('kategori.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm shrink-0 w-full sm:w-auto">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Kategori
        </a>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto table-wrapper">
            <table class="w-full text-left border-collapse min-w-[600px]">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider w-16">No</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Kategori</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center">Jumlah Barang</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($kategoris as $kategori)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-6 py-4 text-sm text-slate-500 whitespace-nowrap">
                            {{ $kategoris->firstItem() + $loop->index }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-semibold text-slate-900">{{ $kategori->nama_kategori }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-slate-600 line-clamp-1 max-w-sm" title="{{ $kategori->deskripsi }}">
                                {{ $kategori->deskripsi ?: '-' }}
                            </p>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <span class="inline-flex items-center justify-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-700">
                                {{ $kategori->barangs_count }} item
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity focus-within:opacity-100">
                                <a href="{{ route('kategori.edit', $kategori->id) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors focus:opacity-100" title="Edit">
                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Data yang terkait mungkin akan terpengaruh.');">
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
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-4">
                                    <i data-lucide="tags" class="w-8 h-8 text-slate-400"></i>
                                </div>
                                <h3 class="text-base font-semibold text-slate-900 mb-1">Data tidak ditemukan</h3>
                                <p class="text-sm text-slate-500">
                                    {{ $search ? 'Tidak ada kategori yang cocok dengan kriteria pencarian Anda.' : 'Anda belum menambahkan data kategori apapun ke dalam sistem.' }}
                                </p>
                                @if(!$search)
                                <a href="{{ route('kategori.create') }}" class="mt-4 text-sm font-medium text-blue-600 hover:text-blue-700">
                                    Tambah Kategori Pertama
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($kategoris->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $kategoris->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
