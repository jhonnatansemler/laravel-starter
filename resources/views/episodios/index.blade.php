@extends('layout')

@section('cabecalho')
    Episódios da {{ $temporada->numero }}<sup>a</sup> temporada de {{ $temporada->serie->nome }}
@endsection

@section('conteudo')

    @include('mensagem', ['mensagem' => $mensagem])

    <form action="/temporadas/{{ $temporada->id }}/episodios/assistir" method="POST">
        @csrf
        <ul class="list-group">
            @foreach ($temporada->episodios as $episodio)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{$episodio->numero}}
                    <input type="checkbox" name="episodios[]" value="{{ $episodio->id }}" {{ $episodio->assistido ? 'checked' : '' }} >
                </li>
            @endforeach
        </ul>

        <button class="btn btn-primary mt-2 mb-2"><i class="fas fa-save"></i> Salvar</button>
    </form>

@endsection

