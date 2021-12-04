<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Filme;
use App\Services\CriadorDeFilmes;

class FilmeTest extends TestCase
{
    private $filme;

    /**
     * Setup para execução dos testes.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $filme = new Filme();
        $filme->nome = "Filme Test";
        $filme->descricao = "Descricao Test";
        $filme->genero = "Action";
        $filme->assistido = false;

        $this->filme = $filme;
    }

    /**
     * Teste para verificar nome do filme.
     *
     * @return void
     */
    public function testNomeDoFilme()
    {
        $nomefilme = $this->filme->nome;
        $this->assertSame("Filme Test", $nomefilme);
    }

    /**
     * Teste para verificar descricao do filme.
     *
     * @return void
     */
    public function testDescricaoDoFilme()
    {
        $descricaofilme = $this->filme->descricao;
        $this->assertSame("Descricao Test", $descricaofilme);
    }

    /**
     * Teste para verificar se o filme já foi assitido.
     *
     * @return void
     */
    public function testFilmeFinalizado()
    {
        $filmeAssistido = $this->filme->assistido;
        $this->assertFalse($filmeAssistido);
    }


    /**
     * Teste para tentar criar filme sem nome.
     *
     * @return void
     */
    public function testVerificaNomeFilmeVazio()
    {
        $criadorDeFilme = new CriadorDeFilmes();
        $this->filme->nome = '';
        $retorno = $criadorDeFilme->verificaNomeFilme($this->filme->nome);
        $this->assertIsString($retorno);
        $this->assertSame("O campo nome é obrigatório", $retorno);
    }

    /**
     * Teste para tentar criar filme com nome invalido.
     *
     * @return void
     */
    public function testVerificaNomeFilmeInvalido()
    {
        $criadorDeFilme = new CriadorDeFilmes();
        $this->filme->nome = 'Te';
        $retorno = $criadorDeFilme->verificaNomeFilme($this->filme->nome);
        $this->assertIsString($retorno);
        $this->assertSame("O campo nome precisa ter pelo menos três caracteres", $retorno);
    }

    /**
     * Teste da função verificaNomeFilme.
     *
     * @return void
     */
    public function testVerificaNomeFilmeCorreto()
    {
        $criadorDeFilme = new CriadorDeFilmes();
        $retorno = $criadorDeFilme->verificaNomeFilme($this->filme->nome);
        $this->assertTrue($retorno);
    }

    /**
     * Teste para tentar criar filme sem descrição.
     *
     * @return void
     */
    public function testVerificaDescricaoFilmeVazio()
    {
        $criadorDeFilme = new CriadorDeFilmes();
        $this->filme->descricao = '';
        $retorno = $criadorDeFilme->verificaDescricaoFilme($this->filme->descricao);
        $this->assertIsString($retorno);
        $this->assertSame("O campo descricao é obrigatório", $retorno);
    }

    /**
     * Teste para tentar criar filme com descrição invalida.
     *
     * @return void
     */
    public function testVerificaDescricaoFilmeInvalido()
    {
        $criadorDeFilme = new CriadorDeFilmes();
        $this->filme->descricao = 'Te';
        $retorno = $criadorDeFilme->verificaDescricaoFilme($this->filme->descricao);
        $this->assertIsString($retorno);
        $this->assertSame("O campo descricao precisa ter pelo menos três caracteres", $retorno);
    }

    /**
     * Teste da função verificaDescricaoFilme.
     *
     * @return void
     */
    public function testVerificaDescricaoFilmeCorreto()
    {
        $criadorDeFilme = new CriadorDeFilmes();
        $retorno = $criadorDeFilme->verificaDescricaoFilme($this->filme->descricao);
        $this->assertTrue($retorno);
    }

    /**
     * Teste para tentar criar filme sem nome.
     *
     * @return void
     */
    public function testVerificaGeneroFilmeVazio()
    {
        $criadorDeFilme = new CriadorDeFilmes();
        $this->filme->genero = '';
        $retorno = $criadorDeFilme->verificaGeneroFilme($this->filme->genero);
        $this->assertIsString($retorno);
        $this->assertSame("O campo genero é obrigatório", $retorno);
    }

    /**
     * Teste para tentar criar filme com genero invalido.
     *
     * @return void
     */
    public function testVerificaGeneroFilmeInvalido()
    {
        $criadorDeFilme = new CriadorDeFilmes();
        $this->filme->genero = 'Te';
        $retorno = $criadorDeFilme->verificaGeneroFilme($this->filme->genero);
        $this->assertIsString($retorno);
        $this->assertSame("O campo genero precisa ter pelo menos três caracteres", $retorno);
    }

    /**
     * Teste da função verificaGeneroFilme.
     *
     * @return void
     */
    public function testVerificaGeneroFilmeCorreto()
    {
        $criadorDeFilme = new CriadorDeFilmes();
        $retorno = $criadorDeFilme->verificaGeneroFilme($this->filme->genero);
        $this->assertTrue($retorno);
    }
}
