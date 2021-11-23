<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\{Serie, Temporada, Episodio, User};

class UserTest extends TestCase
{
    private $user;

    /**
     * Setup para execução dos testes.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $user = new User();
        $user->name = "Test User";

        $this->user = $user;
    }

    public function testNameUser()
    {
        $userName = $this->user->name;
        $this->assertCount(3, $userName);
    }
}
