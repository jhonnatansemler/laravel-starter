@extends('layout')

@section('cabecalho')
    Séries
@endsection

@section('conteudo')

    @include('mensagem', ['errors' => $errors])

    <div class="form-group">
        @auth
            <a href="{{ route('series_create') }}" class="btn btn-dark mb-2">
                <i class="fas fa-add"></i>
                Adicionar
            </a>
        @endauth
    </div>
    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item align-items-center">

                <div id="serie-{{$serie->id}}">
                    <div class="d-flex justify-content-between align-items-center">
                        <span id="serie-label-{{$serie->id}}" class="d-flex">{{ $serie->nome }}</span>
                        <span class="d-flex">
                            @auth
                                <button class="btn btn-secondary btn-sm mr-1" onclick="toggleInput({{$serie->id}})">
                                    <i class="fas fa-edit"></i>
                                </button>
                            @endauth
                            <a href="/series/{{ $serie->id }}/temporadas" class="btn btn-info btn-sm mr-1"><i class="fas fa-external-link-alt"></i></a>
                            @auth
                                <form method="POST" action="/series/remover/{{ $serie->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            @endauth
                        <span>
                    </div>
                </div>

                <div hidden class="input-group" id="input-serie-{{$serie->id}}">
                    <input type="text" class="form-control" value="{{ $serie->nome }}" name="" id="">
                    <button onclick="toggleInput({{$serie->id}})" class="btn btn-secondary ml-1"><i class="fas fa-undo"></i></button>
                    <button onclick="editSerie({{$serie->id}})" class="btn btn-success ml-1"><i class="fas fa-check"></i></button>
                </div>
            </li>
        @endforeach
    </ul>

    <script>
        function toggleInput(id) {
            const labelContainer = document.getElementById(`serie-${id}`);
            const inputContainer = document.getElementById(`input-serie-${id}`);
            const input = document.querySelector(`#input-serie-${id} > input`);
            if(labelContainer.hasAttribute('hidden')){
                labelContainer.removeAttribute('hidden');
                inputContainer.hidden = true;
            }else{
                inputContainer.removeAttribute('hidden');
                labelContainer.hidden = true;
                input.select();
            }
        }

        function editSerie(id) {
            let formData = new FormData();

            const name = document.querySelector(`#input-serie-${id} > input`).value;
            const url = `/series/${id}/editName`;
            const token = document.querySelector('input[name="_token"]').value;


            formData.append('name', name);
            formData.append('_token', token);

            fetch(url, {
                body: formData,
                method: 'POST'
            }).then(() => {
                toggleInput(id);
                document.getElementById(`serie-label-${id}`).textContent = name;
            });
        }
    </script>
@endsection

