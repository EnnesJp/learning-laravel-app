<?php

namespace App\Services;

use App\Models\{Filme, Temporada, Episodio};
use Illuminate\Support\Facades\DB;

class RemovedorDeFilmes
{
    /**
     * @param int $filmeId
     * @return string
     */
    public function removerFilme(int $filmeId) : string {

        DB::beginTransaction();
        $filme = Filme::find($filmeId);

        if(empty($filme))
            return "Filme de id ".$filmeId." não encontrada";

        $nomeFilme = $filme->nome;
        $filme->delete();
        DB::commit();

        return $nomeFilme;
    }
}
