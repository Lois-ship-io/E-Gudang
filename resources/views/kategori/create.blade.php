@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('kategori.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-slate-700 transition-colors shadow-sm shrink-0">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h2 class="text-xl font-bold text-slate-900">Kategori Baru</h2>
            <p class="text-sm text-slate-500 mt-0.5">Tambahkan pengelompokan barang baru ke dalam sistem.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="{{ route('kategori.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf

            <div>
                <label for="nama_kategori" class="block text-sm font-medium text-slate-700 mb-2">Nama Kategori <span class="text-red-500">*</span></label>
                <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}" required autofocus
                    class="block w-full px-4 py-3 bg-white border @error('nama_kategori') border-red-300 focus:ring-red-500/20 focus:border-red-500 @else border-slate-200 focus:ring-blue-500/20 focus:border-blue-500 @enderror rounded-xl text-sm transition-all shadow-sm outline-none focus:ring-2"
                    placeholder="Contoh: Elektronik, Pakaian, Makanan">
                @error('nama_kategori')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-2">Deskripsi <span class="text-slate-400 font-normal">(Opsional)</span></label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="block w-full px-4 py-3 bg-white border @error('deskripsi') border-red-300 focus:ring-red-500/20 focus:border-red-500 @else border-slate-200 focus:ring-blue-500/20 focus:border-blue-500 @enderror rounded-xl text-sm transition-all shadow-sm outline-none focus:ring-2"
                    placeholder="Jelaskan secara singkat mengenai kategori ini...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Footer Actions -->
            <div class="pt-6 mt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row sm:items-center justify-end gap-3">
                <a href="{{ route('kategori.index') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 hover:text-slate-900 rounded-xl transition-colors w-full sm:w-auto">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-sm focus:ring-4 focus:ring-blue-100 transition-all w-full sm:w-auto">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
