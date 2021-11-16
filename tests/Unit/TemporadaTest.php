<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\{Serie, Temporada, Episodio};

class TemporadaTest extends TestCase
{
    private $temporada;

    /**
     * Setup para execução dos testes.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $temporada = new Temporada();
        $episodio1 = new Episodio();
        $episodio1->assistido = true;
        $episodio2 = new Episodio();
        $episodio2->assistido = false;
        $episodio3 = new Episodio();
        $episodio3->assistido = true;
        $temporada->episodios->add($episodio1);
        $temporada->episodios->add($episodio2);
        $temporada->episodios->add($episodio3);

        $this->temporada = $temporada;
    }

    public function test_BuscaPorEpisodiosAssistidos()
    {
       $episodiosAssistidos = $this->temporada->getEpisodiosAssistidos();
       $this->assertCount(2, $episodiosAssistidos);
        foreach ($episodiosAssistidos as $episodio) {
            $this->assertTrue($episodio->assistido);
        }
    }

    public function test_BuscaTodosOsEpisodios()
    {
        $episodios = $this->temporada->episodios;
        $this->assertCount(3, $episodios);
    }
}
