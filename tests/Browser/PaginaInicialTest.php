<?php

// namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;

class PaginaInicialTest extends DuskTestCase
{
    /**
     * Teste de informacoes da pagina inicial.
     *
     * @return void
     */
    public function testPaginaInicial()
    {
        $host   = 'http://localhost:4444/wd/hub';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

        $driver->get('http://127.0.0.1:8000/series');

        $tituloNavBar = $driver->findElement(WebDriverBy::className('navbar-brand'))->getText();

        self::assertSame('Séries', $tituloNavBar);
        $driver->close();
    }
}
