<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Pokemon;

class PokemonController extends Controller
{

    public function show(){
        $listResponse = Http::withoutVerifying()->get("https://pokeapi.co/api/v2/pokemon?limit=60&offset=0");

        $pk = [];
        if($listResponse->successful()){
            $pkmns = $listResponse->json();
            $pk = $pkmns["results"];
        }

        $cpk = Pokemon::all();

        return view("home", compact('pk', 'cpk'));
    }

    public function getMore(Request $request) {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 60);
        $response = Http::withoutVerifying()->get("https://pokeapi.co/api/v2/pokemon?limit={$limit}&offset={$offset}");

        if($response->successful()){
            return response()->json($response->json());
        }
        return response()->json(['error' => 'Failed to fetch'], 500);
    }

    public function create(){
        $tiposResp = Http::withoutVerifying()->get("https://pokeapi.co/api/v2/type");

        $tipos = [];
        if($tiposResp->successful()){
            $tipos = $tiposResp->json()['results'];
        }

        return view('pokemon.create', compact('tipos'));
    }

    public function store(Request $request){
        $request->validate([
            'nome_pokemon' => 'required|string|min:3',
            'tipo' => 'required|string',
            'tipo2' => 'nullable|string',
            'ataque' => 'required|integer',
            'altura' => 'required|numeric',
            'peso' => 'required|numeric',
            'moves' => 'nullable|string',
            'foto_pokemon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_pokemon')) {
            $file = $request->file('foto_pokemon');
            $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/pokemons'), $imageName);
            $fotoPath = 'images/pokemons/' . $imageName;
        }

        $moves = $request->input('moves') ? array_map('trim', explode(',', $request->input('moves'))) : [];

        $tipoFinal = $request->tipo;
        if ($request->filled('tipo2') && $request->tipo2 !== $request->tipo) {
            $tipoFinal .= ',' . $request->tipo2;
        }

        Pokemon::create([
            'nome' => $request->nome_pokemon,
            'tipo' => $tipoFinal,
            'ataque' => $request->ataque,
            'altura' => $request->altura,
            'peso' => $request->peso,
            'moves' => $moves,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('pokedex')->with('success', 'Pokemon criado com sucesso!');
    }

    //
    public function index($id = null){
        if (!$id) {
            $id = rand(1, 800);
        }

        $typeTranslations = [
            'normal' => 'Normal',
            'fire' => 'Fogo',
            'water' => 'Água',
            'grass' => 'Planta',
            'electric' => 'Elétrico',
            'ice' => 'Gelo',
            'fighting' => 'Lutador',
            'poison' => 'Venenoso',
            'ground' => 'Terrestre',
            'flying' => 'Voador',
            'psychic' => 'Psíquico',
            'bug' => 'Inseto',
            'rock' => 'Pedra',
            'ghost' => 'Fantasma',
            'dragon' => 'Dragão',
            'dark' => 'Sombrio',
            'steel' => 'Aço',
            'fairy' => 'Fada',
            'stellar' => 'Estelar'
        ];

        // Se o ID começar com 'c' busca no banco de dados
        if (str_starts_with($id, 'c')) {
            $realId = substr($id, 1);
            $customPokemon = Pokemon::find($realId);

            if ($customPokemon) {
                $tiposArray = explode(',', $customPokemon->tipo);
                $typesFormatted = [];
                foreach ($tiposArray as $t) {
                    $t = trim($t);
                    $translatedType = $typeTranslations[strtolower($t)] ?? $t;
                    $typesFormatted[] = ['type' => ['name' => $translatedType]];
                }

                $pokemon = [
                    'id' => $customPokemon->id,
                    'is_custom' => true,
                    'name' => $customPokemon->nome,
                    'types' => $typesFormatted,
                    'height' => $customPokemon->altura * 10,
                    'weight' => $customPokemon->peso * 10,
                    'moves' => array_map(function($move) {
                        return ['move' => ['name' => $move], 'version_group_details' => [['level_learned_at' => 0]]];
                    }, $customPokemon->moves ?? []),
                    'sprites' => [
                        'other' => [
                            'official-artwork' => [
                                'front_default' => asset($customPokemon->foto)
                            ]
                        ]
                    ]
                ];
                return view('pokemon', compact('pokemon'));
            }
        }

        // Caso contrário, buscamos na PokeAPI
        $response = Http::withoutVerifying()->get("https://pokeapi.co/api/v2/pokemon/{$id}");
        $speciesResponse = Http::withoutVerifying()->get("https://pokeapi.co/api/v2/pokemon-species/{$id}");

        if($response->successful()){
            $pokemon = $response->json();
            $pokemon['is_custom'] = false;

            if($speciesResponse->successful()) {
                $species = $speciesResponse->json();
                foreach($species['names'] as $nameEntry) {
                    if($nameEntry['language']['name'] == 'pt-BR' || $nameEntry['language']['name'] == 'pt') {
                        $pokemon['name'] = $nameEntry['name'];
                        break;
                    }
                }
            }

            foreach($pokemon['types'] as $key => $tipo) {
                $engName = $tipo['type']['name'];
                $pokemon['types'][$key]['type']['name'] = $typeTranslations[$engName] ?? $engName;
            }

            return view('pokemon', compact('pokemon'));
        }
        return "Erro ao buscar dados na API";
    }
}

