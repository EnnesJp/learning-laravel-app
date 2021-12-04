<?php

namespace App\Services;

use App\Models\{Serie, Temporada, Episodio};
use Illuminate\Support\Facades\DB;

class RemovedorDeSeries
{
    /**
     * @param int $serieId
     * @return string
     */
    public function removerSerie(int $serieId) : string {

        DB::beginTransaction();
        $serie = Serie::find($serieId);

        if(empty($serie))
            return "Série de id ".$serieId." não encontrada";

        $nomeSerie = $serie->nome;
        $this->removerTemporadas($serie);
        $serie->delete();
        DB::commit();

        return $nomeSerie;
    }

    /**
     * @param Serie $serie
     */
    public function removerTemporadas(Serie $serie) {
        $serie->temporadas->each(function (Temporada $temporada){
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });
    }

    /**
     * @param Temporada $temporada
     */
    public function removerEpisodios(Temporada $temporada) {
        $temporada->episodios->each(function (Episodio $episodio){
            $episodio->delete();
        });
    }
}
