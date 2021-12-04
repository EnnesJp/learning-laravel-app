<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    protected $fillable = ['nome', 'descricao', 'assistido', 'genero'];
    public $timestamps = false;

}
