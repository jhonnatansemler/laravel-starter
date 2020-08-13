@if (!empty($mensagem))
    <div class="alert alert-success">
        {{$mensagem}}
    </div>
@endif

@if (!empty($errors) && $errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="align-items-center">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
