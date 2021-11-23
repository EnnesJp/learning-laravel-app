<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\{CriadorDeSeries, RemovedorDeSeries};
use App\Models\{Serie, Temporada, Episodio};

class RemovedorDeSerieTest extends TestCase
{
    use RefreshDatabase;

    /** @var Serie */
    private $serie;

    /**
     * Setup para teste de exclusão de séries do banco.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $criadorDeSerie = new CriadorDeSeries();
        $this->serie = $criadorDeSerie->criarSerie(
            'Nome da série',
            'Descrição da série',
            1,
            1);
    }

    /**
     * Teste remove série.
     *
     * @return void
     */
    public function testRemoverUmaSerie()
    {
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);
        $removedorDeSerie = new RemovedorDeSeries();
        $nomeSerie = $removedorDeSerie->removerSerie($this->serie->id);
        $this->assertIsString($nomeSerie);
        $this->assertEquals('Nome da série', $this->serie->nome);
        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);
    }
}
