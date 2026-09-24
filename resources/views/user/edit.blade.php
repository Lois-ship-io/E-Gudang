@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('user.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-slate-700 transition-colors shadow-sm shrink-0">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h2 class="text-xl font-bold text-slate-900">Edit Pengguna</h2>
            <p class="text-sm text-slate-500 mt-0.5">Perbarui profil dan hak akses pengguna.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="{{ route('user.update', $user->id) }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="block w-full px-4 py-3 bg-white border @error('name') border-red-300 focus:ring-red-500/20 focus:border-red-500 @else border-slate-200 focus:ring-blue-500/20 focus:border-blue-500 @enderror rounded-xl text-sm transition-all shadow-sm outline-none focus:ring-2">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Alamat Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="block w-full px-4 py-3 bg-white border @error('email') border-red-300 focus:ring-red-500/20 focus:border-red-500 @else border-slate-200 focus:ring-blue-500/20 focus:border-blue-500 @enderror rounded-xl text-sm transition-all shadow-sm outline-none focus:ring-2">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password (Optional) -->
                <div class="md:col-span-2 border-t border-slate-100 pt-6">
                    <div class="mb-4">
                        <h4 class="text-sm font-semibold text-slate-900">Ubah Password</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Kosongkan kolom ini jika Anda tidak ingin mengubah password.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password Baru</label>
                            <input type="password" name="password" id="password" minlength="8"
                                class="block w-full px-4 py-3 bg-white border @error('password') border-red-300 focus:ring-red-500/20 focus:border-red-500 @else border-slate-200 focus:ring-blue-500/20 focus:border-blue-500 @enderror rounded-xl text-sm transition-all shadow-sm outline-none focus:ring-2">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" minlength="8"
                                class="block w-full px-4 py-3 bg-white border border-slate-200 focus:ring-blue-500/20 focus:border-blue-500 rounded-xl text-sm transition-all shadow-sm outline-none focus:ring-2">
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 border-t border-slate-100 pt-6">
                    <label class="block text-sm font-medium text-slate-700 mb-4">Pilih Hak Akses <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <label class="relative flex cursor-pointer rounded-xl border border-slate-200 bg-white p-4 shadow-sm focus-within:ring-2 focus-within:ring-blue-500 hover:bg-slate-50 transition-colors peer-checked:border-blue-600">
                            <input type="radio" name="level" value="admin" class="sr-only peer" {{ old('level', $user->level) === 'admin' ? 'checked' : '' }}>
                            <div class="flex w-full items-start justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="mt-0.5 text-slate-400 peer-checked:text-blue-600 transition-colors">
                                        <i data-lucide="shield" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-slate-900 text-sm">Admin Standar</p>
                                        <p class="text-xs text-slate-500 mt-1">Akses kelola data inventaris.</p>
                                    </div>
                                </div>
                                <div class="w-5 h-5 rounded-full border border-slate-300 peer-checked:border-[6px] peer-checked:border-blue-600 bg-white transition-all shrink-0"></div>
                            </div>
                            <div class="absolute inset-0 rounded-xl border-2 border-transparent peer-checked:border-blue-600 pointer-events-none transition-colors"></div>
                        </label>
                        
                        <label class="relative flex cursor-pointer rounded-xl border border-slate-200 bg-white p-4 shadow-sm focus-within:ring-2 focus-within:ring-purple-500 hover:bg-slate-50 transition-colors peer-checked:border-purple-600">
                            <input type="radio" name="level" value="superadmin" class="sr-only peer" {{ old('level', $user->level) === 'superadmin' ? 'checked' : '' }}>
                            <div class="flex w-full items-start justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="mt-0.5 text-slate-400 peer-checked:text-purple-600 transition-colors">
                                        <i data-lucide="shield-alert" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-slate-900 text-sm">Super Admin</p>
                                        <p class="text-xs text-slate-500 mt-1">Akses penuh ke semua fitur.</p>
                                    </div>
                                </div>
                                <div class="w-5 h-5 rounded-full border border-slate-300 peer-checked:border-[6px] peer-checked:border-purple-600 bg-white transition-all shrink-0"></div>
                            </div>
                            <div class="absolute inset-0 rounded-xl border-2 border-transparent peer-checked:border-purple-600 pointer-events-none transition-colors"></div>
                        </label>

                    </div>
                    @error('level')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="pt-6 mt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row sm:items-center justify-end gap-3">
                <a href="{{ route('user.index') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 hover:text-slate-900 rounded-xl transition-colors w-full sm:w-auto">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-sm focus:ring-4 focus:ring-blue-100 transition-all w-full sm:w-auto">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
