@extends('layout')

@section('conteudo')
    <main class="container">
        @include('mensagem', ['mensagem' => $mensagem])
        <form action="/temporada/{{ $temporadaId }}/episodios/assistir" method="post">
            <div class="my-3 p-3 bg-body rounded shadow-sm" style="position: relative;">
                <h6 class="border-bottom pb-2 mb-0">Episodios</h6>
                @foreach($episodios as $episodio)
                <div class="d-flex text-muted pt-3">
                    <div class="d-flex pb-3 mb-0 small lh-sm border-bottom justify-content-between align-items-center">
                        <strong class="d-block text-gray-dark">{{ $episodio->numero }}° Episodio</strong>
                        <input type="checkbox" name="episodios[]" value="{{ $episodio->id }}" {{ $episodio->assistido ? 'checked' : '' }} style="position: absolute; right: 1.3%;">
                    </div>
                </div>
                @endforeach
            <div>
            @auth
            <button class="btn btn-primary mt-2 mb-2">Salvar</button>
            @endauth
        </form>
    </main>
@endsection
