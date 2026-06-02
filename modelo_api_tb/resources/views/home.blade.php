<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pokedex</title>
    @vite("resources/css/app.css")
</head>
<body class="min-h-full">
    @if(session('success'))
        <div id="success-toast" class="fixed top-20 right-8 z-[100] bg-green-500 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 animate-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="font-bold">{{ session('success') }}</span>
            <button onclick="document.getElementById('success-toast').remove()" class="ml-4 hover:text-green-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('success-toast');
                if(toast) {
                    toast.style.opacity = '0';
                    toast.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => toast.remove(), 500);
                }
            }, 5000);
        </script>
    @endif
    <div class="flex flex-col gap-8 justify-between min-h-full">
        <div class="flex sticky top-0 bg-white/80 backdrop-blur-md p-4 z-50 border-b border-gray-100 shadow-sm">
            <input type="text" id="search-input" class="border border-gray-300 rounded-l-xl px-4 py-3 w-full focus:ring-2 focus:ring-blue-500 outline-none transition-all" placeholder="Buscar Pokémon por nome ou número...">
            <button id="search-button" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-r-xl font-bold transition-colors">Buscar</button>
        </div>
        <nav class="flex flex-row gap-8">
            <div onclick="setTab(false)" class="cursor-pointer px-4 py-2 rounded-lg bg-blue-100 text-blue-800 font-semibold hover:bg-blue-200 transition-colors">Padrões</div>
            <div onclick="setTab(true)" class="cursor-pointer px-4 py-2 rounded-lg bg-gray-100 text-gray-800 font-semibold hover:bg-gray-200 transition-colors">Customizados</div>
        </nav>
        <div id="default" class="page grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6 p-4">
            @foreach ($pk as $p)
                @php
                    $pokemonId = basename(parse_url($p['url'], PHP_URL_PATH));
                @endphp
                <a href="{{ route('pokemon.show', $pokemonId) }}" class="pokemon-card bg-white border border-gray-100 rounded-2xl shadow-sm p-4 flex flex-col items-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-name="{{ $p['name'] }}" data-id="{{ $pokemonId }}">
                    <div class="w-full flex justify-between items-start mb-2">
                        <span class="text-xs font-bold text-gray-300">#{{ str_pad($pokemonId, 3, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{{ $pokemonId }}.png"
                         alt="{{ $p['name'] }}"
                         class="w-32 h-32 object-contain drop-shadow-md"
                         loading="lazy">
                    <h3 class="text-lg font-bold text-gray-800 capitalize mt-3">{{ $p['name'] }}</h3>
                </a>
            @endforeach
        </div>
        <div id="custom" class="page grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6 p-4" style="display: none;">
            @foreach ($cpk as $p)
                <a href="{{ route('pokemon.show', 'c' . $p->id) }}" class="pokemon-card bg-white border border-gray-100 rounded-2xl shadow-sm p-4 flex flex-col items-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-name="{{ $p->nome }}" data-id="c{{ $p->id }}">
                    <div class="w-full flex justify-between items-start mb-2">
                        <span class="text-xs font-bold text-gray-300">#C{{ str_pad($p->id, 3, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <img src="{{ asset($p->foto ?? 'images/placeholder.png') }}"
                         alt="{{ $p->nome }}"
                         class="w-32 h-32 object-contain drop-shadow-md"
                         loading="lazy">
                    <h3 class="text-lg font-bold text-gray-800 capitalize mt-3">{{ $p->nome }}</h3>
                </a>
            @endforeach

            <a href="{{ route('pokemon.create') }}" class="flex flex-col items-center justify-center bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl p-4 hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 min-h-[200px]">
                <div class="bg-blue-100 text-blue-600 rounded-full p-3 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <span class="font-bold text-gray-600">Criar Novo</span>
            </a>
        </div>

        <div id="loading" class="w-full py-8 flex justify-center items-center opacity-0 transition-opacity duration-300">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            <span class="ml-3 text-gray-500 font-medium">Carregando mais Pokémon...</span>
        </div>

    </div>

    <script>
        let custom = false;
        let offset = 60;
        const limit = 60;
        let loading = false;
        let hasMore = true;
        const container = document.getElementById('default');
        const loadingEl = document.getElementById('loading');
        const searchInput = document.getElementById('search-input');

        // Infinite Scroll
        window.addEventListener('scroll', () => {
            if (loading || !hasMore || searchInput.value.length > 0) return;

            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 500) {
                loadMore();
            }
        });

        async function loadMore() {
            loading = true;
            loadingEl.style.opacity = '1';

            try {
                const response = await fetch(`{{ route('api.pokemon') }}?offset=${offset}&limit=${limit}`);
                const data = await response.json();

                if (data.results.length === 0) {
                    hasMore = false;
                    loadingEl.innerHTML = '<span class="text-gray-400">Fim da Pokedex</span>';
                } else {
                    data.results.forEach(p => {
                        const id = p.url.split('/').filter(Boolean).pop();
                        const card = createCard(p.name, id);
                        container.appendChild(card);
                    });
                    offset += limit;
                }
            } catch (error) {
                console.error('Error loading more pokemon:', error);
            } finally {
                loading = false;
                loadingEl.style.opacity = '0';
            }
        }

        function createCard(name, id) {
            const a = document.createElement('a');
            a.href = `{{ url('pokedex') }}/${id}`;
            a.className = 'pokemon-card bg-white border border-gray-100 rounded-2xl shadow-sm p-4 flex flex-col items-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300';
            a.setAttribute('data-name', name);
            a.setAttribute('data-id', id);

            const paddedId = id.padStart(3, '0');

            a.innerHTML = `
                <div class="w-full flex justify-between items-start mb-2">
                    <span class="text-xs font-bold text-gray-300">#${paddedId}</span>
                </div>
                <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${id}.png"
                     alt="${name}"
                     class="w-32 h-32 object-contain drop-shadow-md"
                     loading="lazy">
                <h3 class="text-lg font-bold text-gray-800 capitalize mt-3">${name}</h3>
            `;
            return a;
        }

        // Filter Logic
        searchInput.addEventListener('input', (e) => {
            const term = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.pokemon-card');

            cards.forEach(card => {
                const name = card.getAttribute('data-name')?.toLowerCase() || "";
                const id = card.getAttribute('data-id')?.toString() || "";

                if (name.includes(term) || id.includes(term)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });

            // If searching, show all containers that have matches
            if (term.length > 0) {
                document.getElementById('default').style.display = 'grid';
                document.getElementById('custom').style.display = 'grid';
                loadingEl.style.display = 'none';
            } else {
                setTab(custom); // Reset to current tab
            }
        });

        // Search Button - Go directly if exact match or just refocus
        document.getElementById('search-button').addEventListener('click', () => {
            const term = searchInput.value.toLowerCase().trim();
            if (!term) return;

            // If it's a number or exact name, try to go to the page
            window.location.href = `{{ url('pokedex') }}/${term}`;
        });

        function setTab(isCustom) {
            custom = isCustom;
            const defaultDiv = document.getElementById('default');
            const customDiv = document.getElementById('custom');
            const loadingEl = document.getElementById('loading');

            const tabs = document.querySelectorAll('nav div');
            tabs[0].className = !isCustom ? 'cursor-pointer px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold' : 'cursor-pointer px-4 py-2 rounded-lg bg-gray-100 text-gray-800 font-semibold hover:bg-gray-200';
            tabs[1].className = isCustom ? 'cursor-pointer px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold' : 'cursor-pointer px-4 py-2 rounded-lg bg-gray-100 text-gray-800 font-semibold hover:bg-gray-200';

            if (isCustom) {
                defaultDiv.style.display = 'none';
                customDiv.style.display = 'grid';
                loadingEl.style.display = 'none';
            } else {
                defaultDiv.style.display = 'grid';
                customDiv.style.display = 'none';
                loadingEl.style.display = 'flex';
            }
        }

        // Initialize tab
        const hasSuccess = {{ session('success') ? 'true' : 'false' }};
        setTab(hasSuccess);
    </script>
</body>
</html>
