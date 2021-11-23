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

class RegisterUserTest extends DuskTestCase
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
        self::$driver->get('http://127.0.0.1:8000/register');
    }

    /**
     * Teste registra novo usuario completo.
     *
     * @return void
     */
    public function testRegisterUserSuccess()
    {
        $inputName          = self::$driver->findElement(WebDriverBy::id('name'));
        $inputEmail         = self::$driver->findElement(WebDriverBy::id('email'));
        $inputSenha         = self::$driver->findElement(WebDriverBy::id('password'));
        $inputConfirmaSenha = self::$driver->findElement(WebDriverBy::id('password-confirm'));

        $nameUser = 'Nome Test';
        $inputName->sendKeys($nameUser);
        $inputEmail->sendKeys('testeemail1@exemple.com');
        $inputSenha->sendKeys('12345678');
        $inputConfirmaSenha->sendKeys('12345678');

        $inputConfirmaSenha->submit();

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
