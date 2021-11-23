<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\{Serie, Temporada, Episodio};

class SerieTest extends TestCase
{
    private $serie;

    /**
     * Setup para execução dos testes.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $serie = new Serie();
        $serie->nome = "Serie Test";
        $serie->descricao = "Descricao Test";
        $serie->finalizada = false;
        $temporada1 = new Temporada();
        $temporada2 = new Temporada();
        $temporada3 = new Temporada();
        $serie->temporadas->add($temporada1);
        $serie->temporadas->add($temporada2);
        $serie->temporadas->add($temporada3);

        $this->serie = $serie;
    }

    /**
     * Teste para buscar temporadas de uma série.
     *
     * @return void
     */
    public function testBuscaTodasAsTemporadas()
    {
        $temporadas = $this->serie->temporadas;
        $this->assertCount(3, $temporadas);
    }

    /**
     * Teste para verificar nome da serie.
     *
     * @return void
     */
    public function testNomeDaSerie()
    {
        $nomeSerie = $this->serie->nome;
        $this->assertSame("Serie Test", $nomeSerie);
    }

    /**
     * Teste para verificar descricao da série.
     *
     * @return void
     */
    public function testDescricaoDaSerie()
    {
        $descricaoSerie = $this->serie->descricao;
        $this->assertSame("Descricao Test", $descricaoSerie);
    }

    /**
     * Teste para verificar se a série já foi finalizada.
     *
     * @return void
     */
    public function testSerieFinalizada()
    {
        $serieFinalizada = $this->serie->finalizada;
        $this->assertFalse($serieFinalizada);
    }
}
