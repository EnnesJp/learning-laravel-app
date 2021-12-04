<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\{Serie, Temporada, Episodio};
use App\Services\CriadorDeSeries;

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
        $serie->genero = "Ação";
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
     * Teste para verificar genero da série.
     *
     * @return void
     */
    public function testGeneroDaSerie()
    {
        $generoSerie = $this->serie->genero;
        $this->assertSame("Ação", $generoSerie);
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

    /**
     * Teste para tentar criar série sem nome.
     *
     * @return void
     */
    public function testVerificaNomeSerieVazio()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $this->serie->nome = '';
        $retorno = $criadorDeSerie->verificaNomeSerie($this->serie->nome);
        $this->assertIsString($retorno);
        $this->assertSame("O campo nome é obrigatório", $retorno);
    }

    /**
     * Teste para tentar criar série com nome invalido.
     *
     * @return void
     */
    public function testVerificaNomeSerieInvalido()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $this->serie->nome = 'Te';
        $retorno = $criadorDeSerie->verificaNomeSerie($this->serie->nome);
        $this->assertIsString($retorno);
        $this->assertSame("O campo nome precisa ter pelo menos três caracteres", $retorno);
    }

    /**
     * Teste da função verificaNomeSerie.
     *
     * @return void
     */
    public function testVerificaNomeSerieCorreto()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $retorno = $criadorDeSerie->verificaNomeSerie($this->serie->nome);
        $this->assertTrue($retorno);
    }

    /**
     * Teste para tentar criar série sem descrição.
     *
     * @return void
     */
    public function testVerificaDescricaoSerieVazio()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $this->serie->descricao = '';
        $retorno = $criadorDeSerie->verificaDescricaoSerie($this->serie->descricao);
        $this->assertIsString($retorno);
        $this->assertSame("O campo descricao é obrigatório", $retorno);
    }

    /**
     * Teste para tentar criar série com descrição invalida.
     *
     * @return void
     */
    public function testVerificaDescricaoSerieInvalido()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $this->serie->descricao = 'Te';
        $retorno = $criadorDeSerie->verificaDescricaoSerie($this->serie->descricao);
        $this->assertIsString($retorno);
        $this->assertSame("O campo descricao precisa ter pelo menos três caracteres", $retorno);
    }

    /**
     * Teste da função verificaDescricaoSerie.
     *
     * @return void
     */
    public function testVerificaDescricaoSerieCorreto()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $retorno = $criadorDeSerie->verificaDescricaoSerie($this->serie->descricao);
        $this->assertTrue($retorno);
    }

    /**
     * Teste para tentar criar série sem genero.
     *
     * @return void
     */
    public function testVerificaGeneroSerieVazio()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $this->serie->genero = '';
        $retorno = $criadorDeSerie->verificaGeneroSerie($this->serie->genero);
        $this->assertIsString($retorno);
        $this->assertSame("O campo genero é obrigatório", $retorno);
    }

    /**
     * Teste para tentar criar série com genero invalido.
     *
     * @return void
     */
    public function testVerificaGeneroSerieInvalido()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $this->serie->genero = 'Te';
        $retorno = $criadorDeSerie->verificaGeneroSerie($this->serie->genero);
        $this->assertIsString($retorno);
        $this->assertSame("O campo genero precisa ter pelo menos três caracteres", $retorno);
    }

    /**
     * Teste da função verificaTemporadasSerie.
     *
     * @return void
     */
    public function testVerificaNumTempSerieCorreta()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $qtdTemporadas = 1;
        $retorno = $criadorDeSerie->verificaTemporadasSerie($qtdTemporadas);
        $this->assertTrue($retorno);
    }

    /**
     * Teste para tentar criar série sem temporadas.
     *
     * @return void
     */
    public function testVerificaNumTempSerieVazio ()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $qtdTemporadas = '';
        $retorno = $criadorDeSerie->verificaTemporadasSerie($qtdTemporadas);
        $this->assertIsString($retorno);
        $this->assertSame("O campo quantidade de temporadas é obrigatório", $retorno);
    }

    /**
     * Teste para tentar criar série com numero de temporadas invalido.
     *
     * @return void
     */
    public function testVerificaNumTempSerieInvalido ()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $qtdTemporadas = 'dois';
        $retorno = $criadorDeSerie->verificaTemporadasSerie($qtdTemporadas);
        $this->assertIsString($retorno);
        $this->assertSame("O campo quantidade de temporadas deve ser preenchido com um número", $retorno);
    }

    /**
     * Teste da função verificaEpisodiosSerie.
     *
     * @return void
     */
    public function testVerificaNumEpSerieCorreto ()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $qtdEpisodios = 1;
        $retorno = $criadorDeSerie->verificaEpisodiosSerie($qtdEpisodios);
        $this->assertTrue($retorno);
    }

    /**
     * Teste para tentar criar série sem episodios.
     *
     * @return void
     */
    public function testVerificaNumEpSerieVazio ()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $qtdEpisodios = '';
        $retorno = $criadorDeSerie->verificaEpisodiosSerie($qtdEpisodios);
        $this->assertIsString($retorno);
        $this->assertSame("O campo quantidade de episódios é obrigatório", $retorno);
    }

    /**
     * Teste para tentar criar série com numero de episodios invalido.
     *
     * @return void
     */
    public function testVerificaNumEpoSerieInvalido ()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $qtdEpisodios = 'um';
        $retorno = $criadorDeSerie->verificaEpisodiosSerie($qtdEpisodios);
        $this->assertIsString($retorno);
        $this->assertSame("O campo quantidade de episódios deve ser preenchido com um número", $retorno);
    }

    /**
     * Teste da função verificaGeneroSerie.
     *
     * @return void
     */
    public function testVerificaGeneroSerieCorreto()
    {
        $criadorDeSerie = new CriadorDeSeries();
        $retorno = $criadorDeSerie->verificaGeneroSerie($this->serie->genero);
        $this->assertTrue($retorno);
    }
}
