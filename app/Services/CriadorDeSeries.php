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
     * @return Serie
     */
    public function criarSerie(string $nomeSerie, string $descricao, int $qtdTemporadas, int $qtdEpisodios) : Serie {

        DB::beginTransaction();
        // Cria nova serie no banco a partir do $request
        $serie = Serie::create(['nome' => $nomeSerie, 'descricao' => $descricao, 'assistido' => false]);
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
             //$this->criarEpisodios($qtdEpisodios, $temporada, $i);
        }
    }

    /**
     * @param int $qtdEpisodios
     * @param Temporada $temporada
     * @param int $indice
     */
    public function criarEpisodios(int $qtdEpisodios, Temporada $temporada, int $indice){
        // Cria episódios de cada temporada
        for($j =1; $indice <= $qtdEpisodios; $j++){
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
