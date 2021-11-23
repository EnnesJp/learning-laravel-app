<?php

// namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriver;

class PaginaInicialTest extends DuskTestCase
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
    }

    /**
     * Realiza Setup para iniciar cada um dos casos de test.
     *
     * @return void
     */
    public function setUp(): void
    {
        self::$driver->get('http://127.0.0.1:8000/series');
    }

    /**
     * Teste de informacoes da pagina inicial.
     *
     * @return void
     */
    public function testPaginaInicial()
    {
        $tituloNavBar = self::$driver->findElement(WebDriverBy::className('navbar-brand'))->getText();

        self::assertSame('Séries', $tituloNavBar);
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
