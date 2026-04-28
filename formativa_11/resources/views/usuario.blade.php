<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informação do Usuário</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: radial-gradient(circle at top left, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen items-center justify-center p-6 text-white">
    <h1 class="text-2xl font-bold text-center mb-6 bg-gradient-to-r from-white to-gray-400 bg-clip-text text-transparent">
                Perfil do Usuário
    </h1>
    <div class="glass-card rounded-3xl p-8 flex flex-col items-center gap-8 max-w-md w-full transition-all duration-500 hover:scale-[1.02]">

        <div class="relative group">
            <div class="absolute -inset-1 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-full blur opacity-40 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
            <div class="relative rounded-full w-48 h-48 overflow-hidden border-4 border-white/10">
                <img src="{{ $usuario['image'] }}" alt="Profile" class="w-full h-full object-cover">
            </div>
        </div>

        <div class="w-full">


            <div class="overflow-hidden rounded-2xl border border-white/10 bg-black/20">
                <table class="w-full text-left border-collapse">
                    <tbody class="divide-y divide-white/5">
                        <tr class="hover:bg-white/5 transition-colors">
                            <th class="py-4 px-5 text-sm font-semibold text-cyan-400 uppercase tracking-wider w-1/3">Nome</th>
                            <td class="py-4 px-5 text-gray-200">{{ $usuario['firstName'] }} {{ $usuario['lastName'] }}</td>
                        </tr>
                            <tr class="hover:bg-white/5 transition-colors">
                            <th class="py-4 px-5 text-sm font-semibold text-cyan-400 uppercase tracking-wider">Gênero</th>
                            <td class="py-4 px-5">
                                <span class="bg-red-500/20 text-purple-400 px-3 py-1 rounded-full text-sm font-bold border border-purple-500/30">
                                    {{ strtoupper($usuario['gender'][0]) }}
                                </span>
                            </td>
                        </tr>
                        <tr class="hover:bg-white/5 transition-colors">
                            <th class="py-4 px-5 text-sm font-semibold text-cyan-400 uppercase tracking-wider">Idade</th>
                            <td class="py-4 px-5 text-gray-200 font-medium">{{ $usuario['age'] }} anos</td>
                        </tr>
                        <tr class="hover:bg-white/5 transition-colors">
                            <th class="py-4 px-5 text-sm font-semibold text-cyan-400 uppercase tracking-wider">Tipo Sanguíneo</th>
                            <td class="py-4 px-5">
                                <span class="bg-red-500/20 text-red-400 px-3 py-1 rounded-full text-sm font-bold border border-red-500/30">
                                    {{ $usuario['bloodGroup'] }}
                                </span>
                            </td>
                        </tr>



                    </tbody>
                </table>
            </div>
        </div>

        <a href="javascript:location.reload()" class="text-sm text-gray-400 hover:text  -white transition-colors flex items-center gap-2 group">
            Usuario Aleatorio
        </a>
    </div>

</body>
</html>
