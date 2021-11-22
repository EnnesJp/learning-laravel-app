<?php

// namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriverBy;

class RegisterUserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Teste registra novo usuario.
     *
     * @return void
     */
    public function testRegisterUser()
    {
        $host   = 'http://localhost:4444/wd/hub';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

        $driver->get('http://127.0.0.1:8000/register');

        $inputName          = $driver->findElement(WebDriverBy::id('name'));
        $inputEmail         = $driver->findElement(WebDriverBy::id('email'));
        $inputSenha         = $driver->findElement(WebDriverBy::id('password'));
        $inputConfirmaSenha = $driver->findElement(WebDriverBy::id('password-confirm'));

        $inputName->sendKeys('Nome Test');
        $inputEmail->sendKeys('email@exemple.com');
        $inputSenha->sendKeys('12345678');
        $inputConfirmaSenha->sendKeys('12345678');

        $inputConfirmaSenha->submit();

        self::assertSame('http://127.0.0.1:8000/series', $driver->getCurrentURL());
        $driver->close();
    }
}
