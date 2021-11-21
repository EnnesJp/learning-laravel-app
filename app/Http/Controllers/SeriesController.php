<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\Models\{Serie, Temporada , Episodio};
use App\Services\{CriadorDeSeries, RemovedorDeSeries};
use Illuminate\Support\Facades\Auth;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        // Busca cindo ultimas series que estão no banco
        $series = Serie::query()->where('finalizada', '=', false)->orderBy('id','desc')->take(5)->get();
        $seriesAssistidas = Serie::query()->where('finalizada', '=', true)->orderBy('id','desc')->take(5)->get();
        // Define as cores de cada to;pico de filme
        // for($index = 0; $index < 5; $index++){
        //     $color[]  = $this->random_color();
        // }
        $color[0] = '#FF0000';
        $color[1] = '#FF4500';
        $color[2] = '#FFFF00';
        $color[3] = '#ADFF2F';
        $color[4] = '#00FF00';
        $mensagem = $request->session()->get('mensagem');
        return view('series.index', compact('series', 'seriesAssistidas', 'color', 'mensagem'));
    }

    public function check_auth(){
        if (!Auth::check()) {
            return redirect('home');
        }
    }

    public function create()
    {
        $this->check_auth();
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, CriadorDeSeries $criadordeserie)
    {
        $serie = $criadordeserie->criarSerie($request->nome, $request->descricao, $request->qtd_temporadas, $request->qtd_episodios);

        $request->session()
                ->flash(
                    'mensagem',
                    "Série {$serie->nome} adicionada com sucesso"
                    );
        return redirect()->action('SeriesController@index');
    }

    // Gera cor aleatoria
    protected function random_color($start = 0x000000, $end = 0xFFFFFF)
    {
        return sprintf('#%06x', mt_rand($start, $end));
    }

    public function destroy(Request $request, RemovedorDeSeries $removedordeserie)
    {
        $this->check_auth();
        $nomeSerie = $removedordeserie->removerSerie($request->id);

        $request->session()
                ->flash(
                    'mensagem',
                    "Série {$nomeSerie} removida com sucesso"
                    );
        return redirect()->action('SeriesController@index');
    }

    public function editaNome($id, Request $request)
    {
        $this->check_auth();
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }

    public function finalizaSerie($id, Request $request)
    {
        $this->check_auth();
        $serie = Serie::find($id);
        $serie->temporadas->each(function (Temporada $temporada){
            $temporada->episodios->each(function (Episodio $episodio){
                if(!$episodio->assistido){
                    $episodio->assistido = true;
                    $episodio->save();
                }
            });
        });
        $serie->finalizada = true;
        $serie->save();
    }
}
