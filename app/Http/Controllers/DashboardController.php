<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     */
    public function index()
    {
        $totalBarang = Barang::count();
        $totalKategori = KategoriBarang::count();
        $totalStok = Barang::sum('stok');
        $totalNilai = Barang::selectRaw('SUM(stok * harga) as total')->value('total') ?? 0;
        $lowStockItems = Barang::whereColumn('stok', '<=', 'stok_minimum')->with('kategori')->limit(5)->get();
        $recentBarang = Barang::with('kategori')->latest()->limit(5)->get();
        $kategoriStats = KategoriBarang::withCount('barangs')->get();

        $data = compact(
            'totalBarang',
            'totalKategori',
            'totalStok',
            'totalNilai',
            'lowStockItems',
            'recentBarang',
            'kategoriStats'
        );

        if (auth()->user()->isSuperAdmin()) {
            $data['totalUsers'] = User::count();
        }

        return view('dashboard', $data);
    }
}
