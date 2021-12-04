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
    public function criarSerie(string $nomeSerie, string $descricao, int $qtdTemporadas, int $qtdEpisodios, string $genero)
    {
        $this->verificaNomeSerie($nomeSerie);
        $this->verificaDescricaoSerie($descricao);
        $this->verificaGeneroSerie($genero);

        DB::beginTransaction();
        // Cria nova serie no banco a partir do $request
        $serie = Serie::create(['nome' => $nomeSerie, 'descricao' => $descricao, 'finalizada' => false, 'genero' => $genero]);
        $this->criarTemporadas($qtdTemporadas, $serie, $qtdEpisodios);
        DB::commit();

        return $serie;
    }

    /**
     * @param string $nomeSerie
     */
    public function verificaNomeSerie(string $nomeSerie)
    {
        if(empty($nomeSerie))
            return "O campo nome é obrigatório";

        else if(strlen($nomeSerie) < 3)
            return "O campo nome precisa ter pelo menos três caracteres";

        return true;
    }

    /**
     * @param string $descricao
     */
    public function verificaDescricaoSerie(string $descricao)
    {
        if(empty($descricao))
            return "O campo descricao é obrigatório";

        else if(strlen($descricao) < 3)
            return "O campo descricao precisa ter pelo menos três caracteres";

        return true;
    }

    /**
     * @param string $genero
     */
    public function verificaGeneroSerie(string $genero)
    {
        if(empty($genero))
            return "O campo genero é obrigatório";

        else if(strlen($genero) < 3)
            return "O campo genero precisa ter pelo menos três caracteres";

        return true;
    }

    /**
     * @param int $qtdTemporadas
     * @param Serie $serie
     * @param int $qtdEpisodios
     */
    public function criarTemporadas(int $qtdTemporadas, Serie $serie, int $qtdEpisodios)
    {
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
    public function criarEpisodios(int $qtdEpisodios, Temporada $temporada)
    {
        // Cria episódios de cada temporada
        for($j =1; $j <= $qtdEpisodios; $j++){
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
