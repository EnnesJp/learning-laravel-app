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
        $user->email = "test@email.com";
        $user->password = "12345678";

        $this->user = $user;
    }

    /**
     * Teste para verificar nome do usuário.
     *
     * @return void
     */
    public function testNameUser()
    {
        $userName = $this->user->name;
        $this->assertSame("Test User", $userName);
    }

    /**
     * Teste para verificar email do usuário.
     *
     * @return void
     */
    public function testEmailUser()
    {
        $userEmail = $this->user->email;
        $this->assertSame("test@email.com", $userEmail);
    }

    /**
     * Teste para verificar senha do usuário.
     *
     * @return void
     */
    public function testSenhaUser()
    {
        $userSenha = $this->user->password;
        $this->assertSame("12345678", $userSenha);
    }

    /**
     * Teste para verificar função de confirmação de senha.
     *
     * @return void
     */
    public function testVerificaSenhaCorreta ()
    {
        $userSenha = $this->user->password;
        $this->assertTrue($this->user->confirmaSenha($userSenha, '12345678'));
    }

    /**
     * Teste para verificar função de confirmação de senha, para senha errada.
     *
     * @return void
     */
    public function testVerificaSenhaIncorreta ()
    {
        $userSenha = $this->user->password;
        $retorno = $this->user->confirmaSenha($userSenha, 'abcdefgh');
        $this->assertIsString($retorno);
        $this->assertSame("The password confirmation does not match.", $retorno);
    }

    /**
     * Teste para verificar tamanho minimo da senha correto.
     *
     * @return void
     */
    public function testVerificaTamanhoSenhaCorreta ()
    {
        $userSenha = $this->user->password;
        $this->assertTrue($this->user->verificaSenha($userSenha));
    }

    /**
     * Teste para verificar tamanho minimo da senha incorreto.
     *
     * @return void
     */
    public function testVerificaTamanhoSenhaIncorreta ()
    {
        $userSenha = '12345';
        $retorno = $this->user->verificaSenha($userSenha);
        $this->assertIsString($retorno);
        $this->assertSame("The password must be at least 8 characters.", $retorno);
    }

    /**
     * Teste para verificar campo de senha.
     *
     * @return void
     */
    public function testVerificaTamanhoSenhaVazia ()
    {
        $userSenha = '';
        $retorno = $this->user->verificaSenha($userSenha);
        $this->assertIsString($retorno);
        $this->assertSame("The password can not be empty.", $retorno);
    }

    /**
     * Teste para verificar tamanho minimo da username correto.
     *
     * @return void
     */
    public function testVerificaTamanhoUsernameCorreta ()
    {
        $userUsername = $this->user->name;
        $this->assertTrue($this->user->verificaUsername($userUsername));
    }

    /**
     * Teste para verificar username incorreto.
     *
     * @return void
     */
    public function testVerificaTamanhoUsernameIncorreta ()
    {
        $userUsername = 'Ur';
        $retorno = $this->user->verificaUsername($userUsername);
        $this->assertIsString($retorno);
        $this->assertSame("The username must be at least 3 characters.", $retorno);
    }

    /**
     * Teste para verificar campo de username.
     *
     * @return void
     */
    public function testVerificaTamanhoUsernameVazia ()
    {
        $userUsername = '';
        $retorno = $this->user->verificaUsername($userUsername);
        $this->assertIsString($retorno);
        $this->assertSame("The username can not be empty.", $retorno);
    }

    /**
     * Teste para verificar tamanho minimo da email correto.
     *
     * @return void
     */
    public function testVerificaTamanhoEmailCorreta ()
    {
        $userEmail = $this->user->email;
        $this->assertTrue($this->user->verificaEmail($userEmail));
    }

    /**
     * Teste para verificar email incorreto.
     *
     * @return void
     */
    public function testVerificaTamanhoEmailIncorreta ()
    {
        $userEmail = 'Ur';
        $retorno = $this->user->verificaEmail($userEmail);
        $this->assertIsString($retorno);
        $this->assertSame("The email must be at least 3 characters.", $retorno);
    }

    /**
     * Teste para verificar campo de email.
     *
     * @return void
     */
    public function testVerificaTamanhoEmailVazia ()
    {
        $userEmail = '';
        $retorno = $this->user->verificaEmail($userEmail);
        $this->assertIsString($retorno);
        $this->assertSame("The email can not be empty.", $retorno);
    }

    /**
     * Teste para verificar email sem @.
     *
     * @return void
     */
    public function testVerificaEmailSemArroba ()
    {
        $userEmail = 'exempleemail.com';
        $retorno = $this->user->verificaEmail($userEmail);
        $this->assertIsString($retorno);
        $this->assertSame("The structure of the indicated email is not valid. Must be like 'exemple@email.com'.", $retorno);
    }

    /**
     * Teste para verificar campo de email sem '.com'.
     *
     * @return void
     */
    public function testVerificaEmailSemPontoCom ()
    {
        $userEmail = 'exemple@email';
        $retorno = $this->user->verificaEmail($userEmail);
        $this->assertIsString($retorno);
        $this->assertSame("The structure of the indicated email is not valid. Must be like 'exemple@email.com'.", $retorno);
    }
}
