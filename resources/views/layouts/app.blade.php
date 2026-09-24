<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'E-GUDANG') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; color: #334155; }
        [x-cloak] { display: none !important; }
        /* Custom scrollbar for webkit */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        /* Table responsive wrapper scrollbar */
        .table-wrapper::-webkit-scrollbar { height: 8px; }
        .table-wrapper::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 4px; }
    </style>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body x-data="{ sidebarOpen: false, profileOpen: false }" class="flex h-screen overflow-hidden text-slate-700 selection:bg-blue-100 selection:text-blue-900">

    <!-- Mobile sidebar backdrop -->
    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false" x-cloak></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-slate-200 transition-transform duration-300 lg:translate-x-0 lg:static lg:w-64 flex flex-col h-screen shadow-sm lg:shadow-none">
        
        <!-- Logo -->
        <div class="flex items-center gap-3 h-16 px-6 border-b border-slate-100 shrink-0">
            <div class="bg-blue-600 p-1.5 rounded-lg flex items-center justify-center">
                <i data-lucide="package" class="w-5 h-5 text-white"></i>
            </div>
            <span class="text-lg font-bold tracking-tight text-slate-900">e-Gudang</span>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <div class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-2">Menu Utama</div>
            
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-slate-400' }}"></i>
                Dashboard
            </a>

            <div class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-6">Manajemen Data</div>
            
            <a href="{{ route('kategori.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('kategori.*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <i data-lucide="tags" class="w-5 h-5 {{ request()->routeIs('kategori.*') ? 'text-blue-600' : 'text-slate-400' }}"></i>
                Kategori Barang
            </a>
            
            <a href="{{ route('barang.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('barang.*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <i data-lucide="box" class="w-5 h-5 {{ request()->routeIs('barang.*') ? 'text-blue-600' : 'text-slate-400' }}"></i>
                Data Barang
            </a>

            @if(auth()->user()->isSuperAdmin())
            <div class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-6">Sistem</div>
            
            <a href="{{ route('user.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('user.*') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <i data-lucide="users" class="w-5 h-5 {{ request()->routeIs('user.*') ? 'text-blue-600' : 'text-slate-400' }}"></i>
                Kelola Pengguna
            </a>
            @endif
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden w-full">
        
        <!-- Topbar -->
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 lg:px-8 shrink-0 z-30">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 rounded-lg text-slate-500 hover:bg-slate-100 transition-colors">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
                <h1 class="text-lg font-semibold text-slate-900 hidden sm:block">@yield('title')</h1>
            </div>
            
            <div class="flex items-center gap-4">
                <!-- User Menu -->
                <div class="relative" @click.away="profileOpen = false">
                    <button @click="profileOpen = !profileOpen" class="flex items-center gap-3 p-1.5 rounded-full hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-200">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-semibold text-sm">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="hidden md:flex flex-col items-start pr-2">
                            <span class="text-sm font-medium text-slate-700 leading-tight">{{ auth()->user()->name }}</span>
                            <span class="text-xs text-slate-500 capitalize">{{ auth()->user()->level }}</span>
                        </div>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 hidden md:block mr-1"></i>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="profileOpen" x-transition.opacity.duration.200ms class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-slate-100 py-1.5 z-50" x-cloak>
                        <div class="px-4 py-2 border-b border-slate-50 md:hidden">
                            <span class="block text-sm font-medium text-slate-700">{{ auth()->user()->name }}</span>
                            <span class="block text-xs text-slate-500 capitalize">{{ auth()->user()->level }}</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Scrollable Area -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 sm:p-6 lg:p-8">
            
            <!-- Mobile Title -->
            <h1 class="text-2xl font-bold text-slate-900 mb-6 sm:hidden">@yield('title')</h1>

            <!-- Global Alerts -->
            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4 flex items-start gap-3 shadow-sm" x-cloak>
                <div class="bg-green-100 p-1 rounded-full text-green-600 shrink-0 mt-0.5">
                    <i data-lucide="check" class="w-4 h-4"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-sm font-semibold text-green-800">Berhasil</h3>
                    <p class="text-sm text-green-700 mt-0.5">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-green-600 hover:text-green-800 p-1 rounded-lg transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
            @endif

            @if(session('error'))
            <div x-data="{ show: true }" x-show="show" class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-3 shadow-sm" x-cloak>
                <div class="bg-red-100 p-1 rounded-full text-red-600 shrink-0 mt-0.5">
                    <i data-lucide="alert-circle" class="w-4 h-4"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-sm font-semibold text-red-800">Error</h3>
                    <p class="text-sm text-red-700 mt-0.5">{{ session('error') }}</p>
                </div>
                <button @click="show = false" class="text-red-600 hover:text-red-800 p-1 rounded-lg transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
