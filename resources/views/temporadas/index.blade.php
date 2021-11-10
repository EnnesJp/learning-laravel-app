@extends('layout')

@section('conteudo')
    <main class="container">
        <div class="my-3 p-3 bg-body rounded shadow-sm" style="position: relative;">
            <h6 class="border-bottom pb-2 mb-0">Temporadas de {{ $serie->nome }}</h6>
            @foreach($temporadas as $temporada)
            <div class="d-flex text-muted pt-3">
                <div class="d-flex pb-3 mb-0 small lh-sm border-bottom justify-content-between align-items-center">
                    <a href="/temporada/{{ $temporada->id }}/episodios">
                        <strong class="d-block text-gray-dark">{{ $temporada->numero }}° Temporada</strong>
                    </a>
                    <div class="badge badge-secondary" style="position: absolute; right: 1.3%;">
                        {{ $temporada->getEpisodiosAssistidos()->count() }}/{{ $temporada->episodios->count() }}
                    </div>
                </div>
            </div>
            @endforeach
        <div>
        </main>
@endsection
