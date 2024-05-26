<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Criar Chamado - LaraChamados</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Criar Chamado - LaraChamados</h2>
            <form action="{{ route('chamados.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Título do chamado">
                </div>
                <div class="form-group">
                    <label for="assunto">Assunto</label>
                    <textarea name="assunto" id="assunto" rows="4" placeholder="Descreva o assunto do chamado"></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" name = "user_id" value = "{{Auth::user()->id}}">
                    <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="user_setor" value="{{ Auth::user()->setor }}">
                    <label for="nivel_de_prioridade">Nível de Prioridade</label>
                    <select name="nivel_de_prioridade" id="nivel_de_prioridade">
                        <option value="">Selecione o nível de prioridade</option>
                        <option value="baixo">Baixo</option>
                        <option value="medio">Médio</option>
                        <option value="alto">Alto</option>
                    </select>
                </div>
                <button type="submit" class="submit_login">Criar Chamado</button>
            </form>
        </div>
    </div>
</body>

</html>
