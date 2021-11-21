<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Tests\TestCase;

class PaginaInicialTest extends TestCase
{
    public function testPaginaInicialNaoLogado()
    {
        $host = 'http://localhost:4444/wd/hub';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());

        $driver->navigate()->to('http://localhost:8080');

        self::assertStringContainsString('Series', $driver->getPageSource());
    }
}
