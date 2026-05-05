<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Novo Pokémon - Pokédex</title>
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
        .input-glass {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }
        .input-glass:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(59, 130, 246, 0.5);
            outline: none;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.2);
        }
    </style>
</head>
<body class="bg-[#0f172a] text-white min-h-screen flex items-center justify-center p-4">
    <div class="fixed inset-0 overflow-hidden -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-blue-600/20 blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-purple-600/20 blur-[120px]"></div>
    </div>

    <div class="glass max-w-xl w-full rounded-3xl overflow-hidden shadow-2xl p-8">
        <div class="flex items-center justify-between mb-8">
            <a href="/" class="text-white/60 hover:text-white transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Voltar
            </a>
            <h1 class="text-2xl font-bold uppercase tracking-widest text-blue-400">Novo Pokémon</h1>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-red-500/20 border border-red-500/50 text-red-200 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pokemon.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-white/40 mb-2 ml-1">Nome do Pokémon</label>
                    <input type="text" name="nome_pokemon" required minlength="3" placeholder="Ex: Pikachu"
                           class="w-full px-4 py-3 rounded-2xl input-glass">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-white/40 mb-2 ml-1">Tipo Principal</label>
                        <select name="tipo" required class="w-full px-4 py-3 rounded-2xl input-glass appearance-none cursor-pointer">
                            <option value="" disabled selected>Selecionar...</option>
                            @foreach($tipos as $type)
                                <option value="{{ $type['name'] }}" class="bg-[#1e293b] text-white">
                                    {{ ucfirst($type['name']) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-white/40 mb-2 ml-1">Secundário (Opcional)</label>
                        <select name="tipo2" class="w-full px-4 py-3 rounded-2xl input-glass appearance-none cursor-pointer">
                            <option value="" selected>Nenhum</option>
                            @foreach($tipos as $type)
                                <option value="{{ $type['name'] }}" class="bg-[#1e293b] text-white">
                                    {{ ucfirst($type['name']) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-white/40 mb-2 ml-1">Altura (m)</label>
                        <input type="number" name="altura" step="0.1" required placeholder="0.4"
                               class="w-full px-4 py-3 rounded-2xl input-glass">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-white/40 mb-2 ml-1">Peso (kg)</label>
                        <input type="number" name="peso" step="0.1" required placeholder="6.0"
                               class="w-full px-4 py-3 rounded-2xl input-glass">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-white/40 mb-2 ml-1">Ataque Base</label>
                    <input type="number" name="ataque" required min="1" placeholder="55"
                           class="w-full px-4 py-3 rounded-2xl input-glass">
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-white/40 mb-2 ml-1">Movimentos (separados por vírgula)</label>
                    <textarea name="moves" rows="2" placeholder="Thunderbolt, Quick Attack, Iron Tail"
                              class="w-full px-4 py-3 rounded-2xl input-glass resize-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-white/40 mb-2 ml-1">Foto do Pokémon</label>
                    <div class="relative group h-40">
                        <input type="file" name="foto_pokemon" id="foto_pokemon" accept="image/*"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div id="preview-container" class="w-full h-full rounded-2xl border-2 border-dashed border-white/10 group-hover:border-blue-500/50 transition-all flex flex-col items-center justify-center bg-white/5 overflow-hidden">
                            <img id="image-preview" src="#" alt="Preview" class="hidden w-full h-full object-contain p-2">
                            <div id="upload-placeholder" class="flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white/20 group-hover:text-blue-400 mb-2 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-[10px] text-white/40 group-hover:text-white/60 uppercase tracking-widest">Clique para subir a foto</p>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit"
                        class="w-full py-4 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-2xl transition-all active:scale-[0.98] shadow-lg shadow-blue-500/20 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Salvar no Banco
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('foto_pokemon').onchange = evt => {
            const [file] = document.getElementById('foto_pokemon').files
            if (file) {
                document.getElementById('image-preview').src = URL.createObjectURL(file)
                document.getElementById('image-preview').classList.remove('hidden')
                document.getElementById('upload-placeholder').classList.add('hidden')
                document.getElementById('preview-container').classList.remove('border-dashed')
                document.getElementById('preview-container').classList.add('border-solid', 'border-blue-500/30')
            }
        }
    </script>
</body>
</html>
