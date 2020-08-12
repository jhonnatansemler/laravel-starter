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
        <div class="form-group">
            <label for="nome">Série</label>
            <input type="text" class="form-control" name="nome" id="nome" />
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>
@endsection
