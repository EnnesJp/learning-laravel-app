<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\{Serie, Temporada, Episodio, User};

class SerieTest extends TestCase
{
    private $user;

    /**
     * Setup para execução dos testes.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $user = new User();
    }

    public function testBuscaTodasAsTemporadas()
    {
        $temporadas = $this->serie->temporadas;
        $this->assertCount(3, $temporadas);
    }
}
