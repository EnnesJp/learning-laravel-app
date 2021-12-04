<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function confirmaSenha(string $senha, string $confirmaSenha)
    {
        if ($senha == $confirmaSenha)
            return true;

        return "The password confirmation does not match.";
    }

    public function verificaSenha(string $senha)
    {
        $tamSenha = strlen($senha);

        if(empty($senha))
            return "The password can not be empty.";
        if ($tamSenha < 8)
            return "The password must be at least 8 characters.";

        return true;
    }

    public function verificaUsername(string $nome)
    {
        if(empty($nome))
            return "The username can not be empty.";
        else if (strlen($nome) < 3)
            return "The username must be at least 3 characters.";

        return true;

    }

    public function verificaEmail(string $email)
    {
        if(empty($email))
            return "The email can not be empty.";
        else if (strlen($email) < 3)
            return "The email must be at least 3 characters.";
        else if (!strripos($email, '@'))
            return "The structure of the indicated email is not valid. Must be like 'exemple@email.com'.";
        else if (!strripos($email, '.com'))
            return "The structure of the indicated email is not valid. Must be like 'exemple@email.com'.";

        return true;

    }
}
