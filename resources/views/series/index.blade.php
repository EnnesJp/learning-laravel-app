@extends('layout')

@section('conteudo')
<main class="container">
    @include('mensagem', ['mensagem' => $mensagem])
    <a href="series/create" class="btn btn-dark mb-1" data-bs-toggle="modal" data-bs-target="#exampleModalLive">Adicionar</a>
    <div class="my-3 p-3 bg-body rounded shadow-sm" style="position: relative;">
        <h6 class="border-bottom pb-2 mb-0">Para Assistir</h6>
        @foreach ($series as $key => $serie)
            <div class="d-flex text-muted pt-3">
                <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="{{ $color[$key] }}"/></svg>
                <div id="info-serie-{{ $serie->id }}" class="pb-3 mb-0 small lh-sm border-bottom">
                    <strong id="nome-serie-{{ $serie->id }}" class="d-block text-gray-dark">{{ $serie->nome }}</strong>
                    {{ $serie->descricao }}
                </div>
                <div class="input-group w-50 border-bottom pb-3" hidden id="input-nome-serie-{{ $serie->id }}">
                    <input type="text" class="form-control" value="{{ $serie->nome }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>
                <div class="d-flex" style="position: absolute; right: 1.3%;">
                    <button class="btn btn-info btn-sm mr-2" onclick="toggleInput({{ $serie->id }})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <a href="/series/{{ $serie->id }}/temporadas" class="btn btn-info btn-sm mr-2">
                        <i class="fas fa-info"></i>
                    </a>
                    <form method="post" action="/series/{{ $serie->id }}"
                        onsubmit="return confirm('Tem certeza que deseja remover a série {{ addslashes($serie->nome) }}?')">
                        @csrf
                        <button style="float: right;" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
        <small class="d-block text-end mt-3">
            <a href="#">All Series</a>
        </small>
    </div>
</main>
<script>
    function toggleInput(serieId) {
        const infoSerieEl = document.getElementById(`info-serie-${serieId}`);
        const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);
        if (infoSerieEl.hasAttribute('hidden')) {
            infoSerieEl.removeAttribute('hidden');
            inputSerieEl.hidden = true;
        } else {
            inputSerieEl.removeAttribute('hidden');
            infoSerieEl.hidden = true;
        }
    }

    function editarSerie(serieId) {
        let formData = new FormData();
        const nome = document
            .querySelector(`#input-nome-serie-${serieId} > input`)
            .value;
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        formData.append('nome', nome);
        formData.append('_token', token);
        const url = `/series/${serieId}/editaNome`;
        fetch(url, {
            method: 'POST',
            body: formData
        }).then(() => {
            toggleInput(serieId);
            document.getElementById(`nome-serie-${serieId}`).textContent = nome;
        });
    }
</script>
@endsection
