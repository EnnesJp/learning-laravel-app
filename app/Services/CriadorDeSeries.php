<?php

namespace App\Services;

use App\Models\{Serie, Temporada, Episodio};
use Illuminate\Support\Facades\DB;

class CriadorDeSeries
{
    /**
     * @param string $nomeSerie
     * @param string $descricao
     * @param int $qtdTemporadas
     * @param int $qtdEpisodios
     * @param string $genero
     * @return Serie
     */
    public function criarSerie(string $nomeSerie, string $descricao, int $qtdTemporadas, int $qtdEpisodios, string $genero) : Serie {

        DB::beginTransaction();
        // Cria nova serie no banco a partir do $request
        $serie = Serie::create(['nome' => $nomeSerie, 'descricao' => $descricao, 'finalizada' => false, 'genero' => $genero]);
        $this->criarTemporadas($qtdTemporadas, $serie, $qtdEpisodios);
        DB::commit();

        return $serie;
    }

    /**
     * @param int $qtdTemporadas
     * @param Serie $serie
     * @param int $qtdEpisodios
     */
    public function criarTemporadas(int $qtdTemporadas, Serie $serie, int $qtdEpisodios){
        // Cria temporadas de cada série
        for($i =1; $i <= $qtdTemporadas; $i++){
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criarEpisodios($qtdEpisodios, $temporada);
        }
    }

    /**
     * @param int $qtdEpisodios
     * @param Temporada $temporada
     * @param int $indice
     */
    public function criarEpisodios(int $qtdEpisodios, Temporada $temporada){
        // Cria episódios de cada temporada
        for($j =1; $j <= $qtdEpisodios; $j++){
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
