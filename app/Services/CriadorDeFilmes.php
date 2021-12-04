<?php

namespace App\Services;

use App\Models\Filme;
use Illuminate\Support\Facades\DB;

class CriadorDeFilmes
{
    /**
     * @param string $nomeFilme
     * @param string $descricao
     * @param string $genero
     * @return Filme
     */
    public function criarFilme(string $nomeFilme, string $descricao, string $genero)
    {
        $this->verificaNomeFilme($nomeFilme);
        $this->verificaDescricaoFilme($descricao);
        $this->verificaGeneroFilme($genero);

        DB::beginTransaction();
        // Cria nova filme no banco a partir do $request
        $filme = Filme::create(['nome' => $nomeFilme, 'descricao' => $descricao, 'assistido' => false, 'genero' => $genero]);
        DB::commit();

        return $filme;
    }

    /**
     * @param string $nomeFilme
     */
    public function verificaNomeFilme(string $nomeFilme)
    {
        if(empty($nomeFilme))
            return "O campo nome é obrigatório";

        else if(strlen($nomeFilme) < 3)
            return "O campo nome precisa ter pelo menos três caracteres";

        return true;
    }

    /**
     * @param string $descricao
     */
    public function verificaDescricaoFilme(string $descricao)
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
    public function verificaGeneroFilme(string $genero)
    {
        if(empty($genero))
            return "O campo genero é obrigatório";

        else if(strlen($genero) < 3)
            return "O campo genero precisa ter pelo menos três caracteres";

        return true;
    }
}
