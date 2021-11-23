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

class PaginaListagemTest extends DuskTestCase
{private static WebDriver $driver;

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
        self::$driver->get('http://127.0.0.1:8000/series');
    }

    /**
     * Altera nome da serie.
     *
     * @return void
     */
    public function testAlteraNomeSerie()
    {
        self::assertTrue(true);
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
