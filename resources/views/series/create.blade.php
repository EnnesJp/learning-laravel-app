@extends('layout')

@section('conteudo')
    <div class="container mt-4">
        <div class="jumbotron">
            <h1>Adicionar Série</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post">
            @csrf
            <div class="row">
                <div class="form-group mb-3 col col-8">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome">
                </div>
                <div class="form-group mb-3 col col-2">
                    <label for="qtd_temporadas">N° Temporadas</label>
                    <input type="number" class="form-control" name="qtd_temporadas" id="nome">
                </div>
                <div class="form-group mb-3 col col-2">
                    <label for="qtd_episodios">N° Episódios</label>
                    <input type="number" class="form-control" name="qtd_episodios" id="nome">
                </div>
            </div>
            <div class="form-group">
                <label for="nome">Descrição</label>
                <textarea type="text" class="form-control" name="descricao" id="descricao"></textarea>
            </div>
            <button class="btn btn-dark" href="/series">Adicionar</button>
        </form>
@endsection
