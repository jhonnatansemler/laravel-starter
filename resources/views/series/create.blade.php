@extends('layout')

@section('cabecalho')
    <h1>Nova série</h1>
@endsection
@section('conteudo')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="align-items-center">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post">
        @csrf
        <div class="row">
            <div class="col col-8">
                <label for="nome">Série</label>
                <input type="text" class="form-control" name="nome" id="nome" />
            </div>
            <div class="col col-2">
                <label for="temporadas">Nº temporadas</label>
                <input type="number" class="form-control" name="temporadas" id="temporadas" />
            </div>
            <div class="col col-2">
                <label for="episodios">Eposódios</label>
                <input type="number" class="form-control" name="episodios" id="episodios" />
            </div>
        </div>
        <div class="row mt-2">
            <div class="col col-12">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
    </form>
@endsection
