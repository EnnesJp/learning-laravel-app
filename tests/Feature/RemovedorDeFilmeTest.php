<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\{RemovedorDeFilmes,CriadorDeFilmes};
use App\Models\Filme;

class RemovedorDeFilmeTest extends TestCase
{
    use RefreshDatabase;

    /** @var Filme */
    private $filme;

    /**
     * Setup para teste de exclusão de filmes do banco.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $criadorDeFilme = new CriadorDeFilmes();
        $this->filme = $criadorDeFilme->criarFilme(
            'Nome do filme',
            'Descrição do filme',
            'action'
        );
    }

    /**
     * Teste remove filme.
     *
     * @return void
     */
    public function testRemoverUmFilme()
    {
        $this->assertDatabaseHas('filmes', ['id' => $this->filme->id]);
        $removedorDeFilme = new RemovedorDeFilmes();
        $nomeFilme = $removedorDeFilme->removerFilme($this->filme->id);
        $this->assertIsString($nomeFilme);
        $this->assertEquals('Nome do filme', $this->filme->nome);
        $this->assertDatabaseMissing('filmes', ['id' => $this->filme->id]);
    }

    /**
     * Teste remove filme id inválido.
     *
     * @return void
     */
    public function testRemoverUmFilmeIdNaoEncontrado()
    {
        $removedorDeFilme = new RemovedorDeFilmes();
        $retorno = $removedorDeFilme->removerFilme(1000);
        $this->assertIsString($retorno);
        $this->assertSame("Filme de id 1000 não encontrada", $retorno);
    }
}
