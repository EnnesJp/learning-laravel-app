<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\CriadorDeSeries;
use App\Models\{Serie, Temporada, Episodio};

class CriadorDeSerieTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste para criacao de series.
     *
     * @return void
     */
    public function test_CriarSerie()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $nomeSerie = 'Nome de teste';
        $descricaoSerie = 'Descricao de teste';
        $serieCriada = $criadorDeSerie->criarSerie($nomeSerie, $descricaoSerie, 1, 1);

        $this->assertInstanceOf(Serie::class, $serieCriada);
        $this->assertDatabaseHas('series', ['nome' => $nomeSerie]);
        $this->assertDatabaseHas('series', ['descricao' => $descricaoSerie]);
        $this->assertDatabaseHas('temporadas', ['serie_id' => $serieCriada->id, 'numero'=> 1]);
        $this->assertDatabaseHas('episodios', ['numero'=> 1]);
    }
}
