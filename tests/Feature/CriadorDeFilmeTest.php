<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\CriadorDeFilmes;
use App\Models\Filme;

class CriadorDeFilmeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste para criacao de filmes.
     *
     * @return void
     */
    public function testCriarFilme()
    {
        $criadorDeFilme = new CriadorDeFilmes();
        $nomeFilme = 'Nome de teste';
        $descricaoFilme = 'Descricao de teste';
        $generoFilme = 'Drama';
        $filmeCriada = $criadorDeFilme->criarFilme($nomeFilme, $descricaoFilme, $generoFilme);

        $this->assertInstanceOf(Filme::class, $filmeCriada);
        $this->assertDatabaseHas('filmes', ['nome' => $nomeFilme]);
        $this->assertDatabaseHas('filmes', ['descricao' => $descricaoFilme]);
    }
}
