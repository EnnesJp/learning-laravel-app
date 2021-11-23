<?php

namespace Tests\PageObject;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriver;

class PaginaLogin
{
    private WebDriver $driver;

    public function __contruct(WebDriver $driver)
    {
        $this->driver = $driver;
    }

    /**
     * Realiza Login para Testes.
     *
     * @return void
     */
    public function RealizaLogin(string $email, string $senha)
    {
        $this->driver->get('http://127.0.0.1:8000/login');

        $inputEmail = $this->driver->findElement(WebDriverBy::id('email'));
        $inputSenha = $this->driver->findElement(WebDriverBy::id('password'));

        $inputEmail->sendKeys($email);
        $inputSenha->sendKeys($senha);

        $inputSenha->submit();
    }

}
