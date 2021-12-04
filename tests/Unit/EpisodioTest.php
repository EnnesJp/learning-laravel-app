<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\{Serie, Temporada, Episodio};

class EpisodioTest extends TestCase
{
    private $episodio;

    /**
     * Setup para execução dos testes.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $episodio = new Episodio();
        $episodio->assistido = true;

        $this->episodio = $episodio;
    }

    /**
     * Executa testes para verificar episodios assistidos.
     *
     * @return void
     */
    public function testEpisodioAssistido()
    {
        $episodioAssistido = $this->episodio->assistido;
        $this->assertTrue($episodioAssistido);

    }
}
