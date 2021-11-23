<?php

// namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriver;
use Tests\PageObject\PaginaLogin;


class CadastroSerieTest extends DuskTestCase
{
    private static WebDriver $driver;

    /**
     * Realiza Setup para iniciar classe de testes
     *
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        $host   = 'http://localhost:4444/wd/hub';
        self::$driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

        self::$driver->get('http://127.0.0.1:8000/login');

        $inputEmail = self::$driver->findElement(WebDriverBy::id('email'));
        $inputSenha = self::$driver->findElement(WebDriverBy::id('password'));

        $inputEmail->sendKeys('email@exemple.com');
        $inputSenha->sendKeys('12345678');

        $inputSenha->submit();
    }

    /**
     * Realiza Setup para iniciar cada um dos casos de test.
     *
     * @return void
     */
    public function setUp(): void
    {
        self::$driver->get('http://127.0.0.1:8000/series/create');
    }

    /**
     * Testa a adicao de uma nova serie completa.
     *
     * @return void
     */
    public function testAdicionaSerieSuccess()
    {
        $inputNome          = self::$driver->findElement(WebDriverBy::id('nome'));
        $inputQtdTemporada  = self::$driver->findElement(WebDriverBy::id('qtd_temporadas'));
        $inputQtdEpisodios  = self::$driver->findElement(WebDriverBy::id('qtd_episodios'));
        $inputDescricao     = self::$driver->findElement(WebDriverBy::id('descricao'));

        $inputNome->sendKeys('Nome Serie Test');
        $inputQtdTemporada->sendKeys('5');
        $inputQtdEpisodios->sendKeys('10');
        $inputDescricao->sendKeys('Descricao de teste para serie');

        $inputDescricao->submit();

        self::assertSame('http://127.0.0.1:8000/series', self::$driver->getCurrentURL());
    }

    /**
     * Finaliza todos os testes.
     *
     * @return void
     */
    public static function tearDownAfterClass(): void
    {
        self::$driver->close();
    }
}
