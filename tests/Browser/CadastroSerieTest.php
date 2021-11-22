<?php

// namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriverBy;


class CadastroSerieTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * Testa a adicao de uma nova serie.
     *
     * @return void
     */
    public function testAdicionaSerie()
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

        $driver->get('http://127.0.0.1:8000/series/create');

        $inputNome          = $driver->findElement(WebDriverBy::id('nome'));
        $inputQtdTemporada  = $driver->findElement(WebDriverBy::id('qtd_temporadas'));
        $inputQtdEpisodios  = $driver->findElement(WebDriverBy::id('qtd_episodios'));
        $inputDescricao     = $driver->findElement(WebDriverBy::id('descricao'));

        $inputNome->sendKeys('Nome Serie Test');
        $inputQtdTemporada->sendKeys('5');
        $inputQtdEpisodios->sendKeys('10');
        $inputDescricao->sendKeys('Descricao de teste para serie');

        $inputDescricao->submit();

        self::assertSame('http://127.0.0.1:8000/series', $driver->getCurrentURL());
        $driver->close();
    }
}
