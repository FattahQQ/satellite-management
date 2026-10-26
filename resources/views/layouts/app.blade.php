<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Pusat Komando') — Persatelitan</title>

    <!-- Scripts & Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Orbitron:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #050510; color: #fff; }
        .font-orbitron { font-family: 'Orbitron', monospace; }

        /* Deep Space Background */
        .space-bg {
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
            background: radial-gradient(circle at 20% 30%, rgba(67, 56, 202, 0.15) 0%, transparent 50%),
                        radial-gradient(circle at 80% 70%, rgba(56, 189, 248, 0.1) 0%, transparent 50%),
                        linear-gradient(to bottom, #020205, #0a0a1a);
            z-index: -2;
        }

        /* Glass Panel Hologram */
        .glass-panel {
            background: rgba(10, 15, 30, 0.7);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
        }

        /* Sidebar Links */
        .sidebar-link {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background: linear-gradient(90deg, rgba(56,189,248,0.15), transparent);
            border-left: 3px solid #38bdf8;
            color: #38bdf8;
            text-shadow: 0 0 10px rgba(56,189,248,0.5);
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #050510; }
        ::-webkit-scrollbar-thumb { background: #38bdf8; border-radius: 3px; }
    </style>
</head>
<body class="flex h-screen overflow-hidden">

    <div class="space-bg"></div>

    <!-- SIDEBAR UTAMA -->
    <aside class="w-64 glass-panel flex flex-col h-full z-20 border-r border-white/10 hidden md:flex">
        <!-- Logo Header -->
        <div class="p-6 border-b border-white/10 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center shadow-[0_0_15px_rgba(56,189,248,0.4)]">
                <i class="fas fa-satellite text-white text-sm"></i>
            </div>
            <div>
                <h1 class="font-orbitron font-bold text-sm text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 tracking-wider">PERSATELITAN</h1>
                <p class="text-[10px] text-indigo-300 uppercase tracking-widest">Stasiun Bumi BRIN</p>
            </div>
        </div>

        <!-- Navigasi Menu -->
        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
            <p class="text-[10px] text-indigo-400/60 uppercase tracking-widest px-4 mb-2 font-semibold">Navigasi Utama</p>
            
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active text-cyan-400 border-l-3 border-cyan-400 bg-cyan-950/30' : 'text-indigo-200' }} flex items-center gap-3 px-4 py-3 rounded-r-xl text-sm font-medium">
                <i class="fas fa-chart-pie w-5 text-center"></i> Panel Utama
            </a>
            
            <a href="{{ route('satellites.index') }}" class="sidebar-link {{ request()->routeIs('satellites.*') ? 'active text-cyan-400 border-l-3 border-cyan-400 bg-cyan-950/30' : 'text-indigo-200' }} flex items-center gap-3 px-4 py-3 rounded-r-xl text-sm font-medium">
                <i class="fas fa-satellite w-5 text-center"></i> Data Satelit
            </a>
            
            <a href="{{ route('ground-stations.index') }}" class="sidebar-link {{ request()->routeIs('ground-stations.*') ? 'active text-cyan-400 border-l-3 border-cyan-400 bg-cyan-950/30' : 'text-indigo-200' }} flex items-center gap-3 px-4 py-3 rounded-r-xl text-sm font-medium">
                <i class="fas fa-broadcast-tower w-5 text-center"></i> Stasiun Bumi
            </a>
        </nav>

        <!-- Informasi User & Tombol Putuskan Koneksi (Logout) -->
        @auth
        <div class="p-4 border-t border-white/10 bg-black/30">
            <div class="flex items-center gap-3 mb-3 px-2">
                <div class="w-8 h-8 rounded-lg bg-cyan-500/20 border border-cyan-500/40 flex items-center justify-center text-cyan-400 text-xs font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-cyan-100 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-indigo-300 capitalize truncate">{{ Auth::user()->role ?? 'Kru Ekspedisi' }}</p>
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-2.5 bg-red-950/40 hover:bg-red-900/60 border border-red-500/30 rounded-xl text-red-200 text-xs font-medium transition-all shadow-[0_0_10px_rgba(239,68,68,0.15)] flex items-center justify-center gap-2">
                    <i class="fas fa-sign-out-alt"></i> Putuskan Koneksi
                </button>
            </form>
        </div>
        @endauth
    </aside>

    <!-- KONTEN UTAMA KANAN -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden relative z-10">
        
        <!-- TOPBAR ATAS -->
        <header class="glass-panel border-b border-white/10 h-16 flex items-center justify-between px-8">
            <div class="flex items-center gap-4">
                <h2 class="font-orbitron text-base tracking-wider text-cyan-200 uppercase">@yield('page-title', 'Pusat Komando')</h2>
            </div>
            
            <div class="flex items-center gap-4">
                <!-- Jam / Waktu Realtime -->
                <div class="hidden sm:flex items-center gap-2 text-xs text-cyan-300 bg-cyan-950/40 border border-cyan-500/30 px-3 py-1.5 rounded-lg shadow-inner">
                    <i class="fas fa-clock text-cyan-400"></i>
                    <span id="system-clock">{{ now()->format('H:i:s') }}</span>
                </div>

                <div class="flex items-center gap-3 md:hidden">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-400 hover:text-red-300 p-2"><i class="fas fa-sign-out-alt"></i></button>
                    </form>
                </div>
            </div>
        </header>

        <!-- AREA KONTEN UTAMA -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8">
            @yield('content')
        </main>
    </div>

    <script>
        // Skrip Jam Realtime
        setInterval(() => {
            const now = new Date();
            const timeStr = String(now.getHours()).padStart(2,'0') + ':' + 
                            String(now.getMinutes()).padStart(2,'0') + ':' + 
                            String(now.getSeconds()).padStart(2,'0');
            const clockEl = document.getElementById('system-clock');
            if (clockEl) clockEl.textContent = timeStr;
        }, 1000);
    </script>
</body>
</html>