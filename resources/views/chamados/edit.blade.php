<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Editar Chamado - LaraChamados</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Editar Chamado - LaraChamados</h2>
            <form action="{{ route('chamados.update', $chamado->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">
                <input type="hidden" name="user_setor" value="{{ Auth::user()->setor }}">
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $chamado->titulo }}" placeholder="Título do chamado">
                </div>
                <div class="form-group">
                    <label for="assunto">Assunto</label>
                    <textarea name="assunto" id="assunto" class="form-control" rows="4" placeholder="Descreva o assunto do chamado">{{ $chamado->assunto }}</textarea>
                </div>
                <div class="form-group">
                    <label for="nivel_de_prioridade">Nível de Prioridade</label>
                    <select name="nivel_de_prioridade" id="nivel_de_prioridade" class="form-control">
                        <option value="">Selecione o nível de prioridade</option>
                        <option value="baixo" {{ $chamado->nivel_de_prioridade === 'baixo' ? 'selected' : '' }}>Baixo</option>
                        <option value="medio" {{ $chamado->nivel_de_prioridade === 'medio' ? 'selected' : '' }}>Médio</option>
                        <option value="alto" {{ $chamado->nivel_de_prioridade === 'alto' ? 'selected' : '' }}>Alto</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Editar Chamado</button>
            </form>
        </div>
    </div>
</body>

</html>
