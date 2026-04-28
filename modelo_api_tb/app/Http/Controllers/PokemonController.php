<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    //
    public function index(){
        $id = rand(1, 151);
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$id}");
        $speciesResponse = Http::get("https://pokeapi.co/api/v2/pokemon-species/{$id}");

        if($response->successful()){
            $pokemon = $response->json();
            if($speciesResponse->successful()) {
                $species = $speciesResponse->json();
                foreach($species['names'] as $nameEntry) {
                    if($nameEntry['language']['name'] == 'pt-BR' || $nameEntry['language']['name'] == 'pt') {
                        $pokemon['name'] = $nameEntry['name'];
                        break;
                    }
                }
            }

            $typeTranslations = [
                'normal' => 'Normal',
                'fire' => 'Fogo',
                'water' => 'Água',
                'grass' => 'Planta',
                'electric' => 'Elétrico',
                'ice' => 'Gelo' (),
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
                'fairy' => 'Fada'
            ];

            foreach($pokemon['types'] as $key => $tipo) {
                $engName = $tipo['type']['name'];
                $pokemon['types'][$key]['type']['name'] = $typeTranslations[$engName] ?? $engName;
            }

            return view('pokemon', compact('pokemon'));
        }
        return "Erro ao buscar dados na API";
    }
}

