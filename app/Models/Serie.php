<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = ['nome', 'descricao', 'finalizada', 'genero'];
    public $timestamps = false;

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }
}
