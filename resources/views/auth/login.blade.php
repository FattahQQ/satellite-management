<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Pusat Komando Persatelitan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Orbitron:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #050510; color: #fff; overflow: hidden; }
        .font-orbitron { font-family: 'Orbitron', monospace; }

        /* Deep Space Background (Nebula) */
        .space-bg {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            background:
                radial-gradient(circle at 20% 30%, rgba(67, 56, 202, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(56, 189, 248, 0.1) 0%, transparent 40%),
                linear-gradient(to bottom, #020205, #0a0a1a);
            z-index: -2;
        }

        /* Twinkling Stars */
        .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            animation: twinkle linear infinite;
        }
        @keyframes twinkle {
            0%, 100% { opacity: 0.1; transform: scale(0.8); }
            50% { opacity: 1; transform: scale(1.2); box-shadow: 0 0 8px #fff; }
        }

        /* Shooting Stars (Bintang Jatuh) */
        .shooting-star {
            position: absolute;
            width: 150px;
            height: 1px;
            background: linear-gradient(90deg, rgba(255,255,255,0.8), transparent);
            animation: shoot 6s linear infinite;
            transform: rotate(-45deg);
            opacity: 0;
        }
        @keyframes shoot {
            0% { transform: translateX(100vw) translateY(-50vh) rotate(-45deg); opacity: 1; }
            15% { transform: translateX(-50vw) translateY(100vh) rotate(-45deg); opacity: 0; }
            100% { opacity: 0; }
        }

        /* Giant Planet Silhouette */
        .planet {
            position: fixed;
            bottom: -30vh;
            right: -10vw;
            width: 70vw;
            height: 70vw;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, #1e1b4b, #000000);
            box-shadow: inset -20px -20px 50px rgba(0,0,0,0.9), 0 0 120px rgba(67, 56, 202, 0.2);
            z-index: -1;
            opacity: 0.9;
        }

        /* Glassmorphism Panel (Hologram Kaca) */
        .glass-panel {
            background: rgba(10, 15, 30, 0.5);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.6), inset 0 0 20px rgba(56, 189, 248, 0.05);
        }

        /* Hologram Scanner Line Effect */
        .scanner-line {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 2px;
            background: linear-gradient(90deg, transparent, rgba(56, 189, 248, 0.6), transparent);
            animation: scan 4s ease-in-out infinite;
            opacity: 0;
        }
        @keyframes scan {
            0% { top: 0%; opacity: 0; }
            10% { opacity: 0.8; }
            90% { opacity: 0.8; }
            100% { top: 100%; opacity: 0; }
        }

        /* Inputs */
        .input-field {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            color: #e2e8f0;
        }
        .input-field:focus {
            background: rgba(56, 189, 248, 0.05);
            border-color: #38bdf8;
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.2);
            outline: none;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <!-- Latar Belakang Luar Angkasa & Planet -->
    <div class="space-bg"></div>
    <div class="planet"></div>

    <!-- Animasi Bintang Jatuh -->
    <div class="shooting-star" style="top: 10%; right: 10%; animation-delay: 0s;"></div>
    <div class="shooting-star" style="top: -20%; right: 40%; animation-delay: 3s;"></div>
    <div class="shooting-star" style="top: 30%; right: 80%; animation-delay: 5s;"></div>

    <!-- Ribuan Bintang Berkedip (Random Generated) -->
    <div class="fixed inset-0 pointer-events-none z-[-1]">
        @for($i = 0; $i < 120; $i++)
        @php
            $size = rand(1, 3);
            $top = rand(0, 100);
            $left = rand(0, 100);
            $duration = rand(3, 7);
            $delay = rand(0, 5);
        @endphp
        <div class="star" style="width: {{ $size }}px; height: {{ $size }}px; top: {{ $top }}%; left: {{ $left }}%; animation-duration: {{ $duration }}s; animation-delay: {{ $delay }}s;"></div>
        @endfor
    </div>

    <!-- Kotak Login -->
    <div class="w-full max-w-md relative z-10 group">
        <!-- Efek Cahaya Bias di Belakang Form -->
        <div class="absolute -inset-1 bg-gradient-to-r from-cyan-500 to-purple-600 rounded-3xl blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>

        <div class="glass-panel rounded-3xl p-8 relative overflow-hidden">
            <!-- Garis Hologram Naik Turun -->
            <div class="scanner-line"></div>

            <!-- Logo Dashboard Pusat -->
            <div class="text-center mb-8">
                <div class="relative inline-flex mb-4">
                    <div class="absolute inset-0 bg-blue-500 rounded-full blur animate-pulse opacity-40"></div>
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-900 to-black border border-indigo-500/40 flex items-center justify-center relative z-10 shadow-[0_0_20px_rgba(56,189,248,0.3)]">
                        <i class="fas fa-satellite text-cyan-400 text-3xl drop-shadow-[0_0_10px_rgba(56,189,248,0.8)]"></i>
                    </div>
                </div>
                <h1 class="font-orbitron font-black text-3xl text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 tracking-widest uppercase">Persatelitan</h1>
                <p class="text-indigo-200/70 mt-2 text-sm font-light tracking-widest uppercase">Pusat Komando Stasiun Bumi</p>
            </div>

            <!-- Pesan Error -->
            @if($errors->any())
            <div class="mb-5 p-4 rounded-xl bg-red-900/30 border border-red-500/40 text-red-300 text-sm backdrop-blur-md">
                @foreach($errors->all() as $error)
                <p class="flex items-center"><i class="fas fa-exclamation-triangle mr-2 text-red-500"></i> {{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6 relative z-10">
                @csrf

                <!-- Input Email -->
                <div>
                    <label class="block text-xs font-semibold text-indigo-300 uppercase tracking-widest mb-2">Identitas Kredensial</label>
                    <div class="relative">
                        <i class="fas fa-user-astronaut absolute left-4 top-1/2 -translate-y-1/2 text-indigo-400/70 text-sm"></i>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="input-field w-full pl-11 pr-4 py-3.5 rounded-xl text-sm font-medium tracking-wide"
                               placeholder="telemetri@brin.go.id">
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <div class="flex justify-between mb-2">
                        <label class="block text-xs font-semibold text-indigo-300 uppercase tracking-widest">Kode Keamanan</label>
                    </div>
                    <div class="relative">
                        <i class="fas fa-fingerprint absolute left-4 top-1/2 -translate-y-1/2 text-indigo-400/70 text-sm"></i>
                        <input type="password" name="password" required
                               class="input-field w-full pl-11 pr-4 py-3.5 rounded-xl text-sm font-medium"
                               placeholder="••••••••">
                    </div>
                </div>

                <!-- Checkbox -->
                <div class="flex items-center">
                    <label class="flex items-center gap-2 text-sm text-indigo-300/70 cursor-pointer hover:text-indigo-200 transition-colors">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                               class="rounded border-indigo-500/40 bg-indigo-900/30 text-cyan-500 focus:ring-cyan-500 focus:ring-offset-gray-900 w-4 h-4">
                        <span class="tracking-wide">Sinkronisasi Sesi Otomatis</span>
                    </label>
                </div>

                <!-- Tombol Login -->
                <button type="submit"
                        class="group w-full relative py-3.5 rounded-xl font-bold tracking-widest text-sm uppercase overflow-hidden transition-all shadow-[0_0_20px_rgba(14,165,233,0.2)] hover:shadow-[0_0_35px_rgba(14,165,233,0.5)]">
                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-600 to-blue-700 transition-all group-hover:scale-105"></div>
                    <span class="relative flex items-center justify-center text-white">
                        <i class="fas fa-space-shuttle mr-3 transform -rotate-45 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform text-lg"></i> Inisiasi Akses
                    </span>
                </button>
            </form>

            <!-- Tautan Register -->
            @if (Route::has('register'))
            <div class="mt-8 pt-6 border-t border-white/10 text-center">
                <p class="text-sm text-indigo-300/60 tracking-wide">
                    Kru Ekspedisi Baru?
                    <a href="{{ route('register') }}" class="text-cyan-400 hover:text-cyan-300 font-semibold transition-colors hover:underline underline-offset-4 ml-1">Registrasi Profil</a>
                </p>
            </div>
            @endif
        </div>
    </div>

</body>
</html>