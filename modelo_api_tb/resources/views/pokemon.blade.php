<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ ucfirst($pokemon['name']) }} - Pokedex Api</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(0, 0, 0, 0.1); }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.3); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.5); }
    </style>
</head>
<body class="bg-[#0f172a] text-white min-h-screen flex items-center justify-center p-4">
     <div class="fixed inset-0 overflow-hidden -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-blue-600/20 blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-purple-600/20 blur-[120px]"></div>
    </div>

    <div class="glass max-w-md w-full rounded-3xl overflow-hidden shadow-2xl transition-all duration-500 hover:shadow-blue-500/10">

        <div class="relative p-8 pb-0 text-center">
            <a href="/" class="absolute top-8 left-8 text-white/60 hover:text-white transition-colors flex items-center gap-2 font-semibold z-20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Voltar
            </a>
            <span class="absolute top-6 right-8 text-white/20 text-6xl font-black italic select-none">
                #{{ str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT) }}
            </span>

            <div class="relative z-10 flex flex-col items-center">
                <div class=" drop-shadow-[0_20px_50px_rgba(59,130,246,0.5)]">
                    <img src="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] }}"
                         alt="{{ $pokemon['name'] }}"
                         class="w-64 h-64 object-contain">
                </div>

                <h1 class="text-4xl font-bold tracking-tight uppercase mt-4 mb-2">
                    {{ $pokemon['name'] }}
                </h1>

                <div class="flex gap-2 mb-6">
                    @foreach($pokemon['types'] as $tipo)
                    <span class="px-4 py-1.5 bg-white/20 backdrop-blur-md text-xs font-bold rounded-full uppercase tracking-widest border border-white/10">
                        {{ $tipo['type']['name'] }}
                    </span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 gap-4 px-8 mb-6">
            <div class="bg-white/5 rounded-2xl p-4 border border-white/5 text-center">
                <p class="text-white/40 text-xs uppercase tracking-widest mb-1">Altura</p>
                <p class="text-xl font-semibold">{{ $pokemon['height'] / 10 }}<span class="text-sm ml-1 text-white/60">m</span></p>
            </div>
            <div class="bg-white/5 rounded-2xl p-4 border border-white/5 text-center">
                <p class="text-white/40 text-xs uppercase tracking-widest mb-1">Peso</p>
                <p class="text-xl font-semibold">{{ $pokemon['weight'] / 10 }}<span class="text-sm ml-1 text-white/60">kg</span></p>
            </div>
        </div>

        <div class="px-8 mb-8">
            <h3 class="text-sm font-semibold uppercase tracking-widest text-white/40 mb-4 ml-1">Movimentos</h3>
            <div class="bg-black/20 rounded-2xl border border-white/5 overflow-hidden">
                <div class="max-h-56 overflow-y-auto custom-scrollbar">
                    <table class="w-full text-left border-separate bo   rder-spacing-0">
                        <thead class="sticky top-0 z-20">
                            <tr>
                                <th class="bg-[#1e293b] px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-white/60">Movimento</th>
                                <th class="bg-[#1e293b] px-4 py-3 text-[10px] font-bold uppercase tracking-widest text-white/60 text-right">Nv. Aprendido</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-white/5">
                            @foreach($pokemon['moves'] as $move)
                            <tr class="hover:bg-white/5 transition-colors group">
                                <td class="px-4 py-3 text-sm text-white/80 capitalize group-hover:text-white">
                                    {{ str_replace('-', ' ', $move['move']['name']) }}
                                </td>
                                <td class="px-4 py-3 text-sm text-white/40 group-hover:text-white/80 text-right font-mono">
                                    {{ $move['version_group_details'][0]['level_learned_at'] }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Action Section -->
        <div class="p-8 pt-0">
            <button onclick="window.location.reload()"
                    class="w-full py-4 bg-white text-blue-900 font-bold rounded-2xl hover:bg-blue-50 transition-all active:scale-95 shadow-lg shadow-white/10 flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                </svg>
                Buscar Próximo
            </button>
        </div>
    </div>
</body>
</html>
