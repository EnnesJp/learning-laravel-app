<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filme;
use App\Services\CriadorDeFilmes;
use Illuminate\Support\Facades\Auth;

class FilmesController extends Controller
{
    public function check_auth(){
        if (!Auth::check()) {
            return redirect('home');
        }
    }

    public function create()
    {
        $this->check_auth();
    }

    public function store(Request $request, CriadorDeFilmes $criadordefilmes)
    {
    }

    public function destroy(Request $request, CriadorDeFilmes $removedordefilmes)
    {
        $this->check_auth();
    }

    public function editaNome($id, Request $request)
    {
    }

    public function finalizaFilme($id, Request $request)
    {
        $this->check_auth();
    }
}
