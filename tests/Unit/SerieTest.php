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
        $temporada1 = new Temporada();
        $temporada2 = new Temporada();
        $temporada3 = new Temporada();
        $serie->temporadas->add($temporada1);
        $serie->temporadas->add($temporada2);
        $serie->temporadas->add($temporada3);

        $this->serie = $serie;
    }

    public function test_BuscaTodasAsTemporadas()
    {
        $temporadas = $this->serie->temporadas;
        $this->assertCount(3, $temporadas);
    }
}
