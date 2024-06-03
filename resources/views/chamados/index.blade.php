@extends('layouts.index')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script src="{{asset('js/modal.js')}}"></script>
    <title>Lista de Chamados</title>
</head>

<body>
    <div class="container mt-4">
        <div class="container table-responsive py-5">
            <h1 class="text-center mt-3 mb-3">Lista de Chamados</h1>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Título</th>
                        <th>Assunto</th>
                        <th>Usuário Solicitante</th>
                        <th>Setor do Usuário</th>
                        <th>Nível de Prioridade</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chamados as $chamado)
                    <tr>
                        <td>{{ $chamado->titulo }}</td>
                        <td>{{ $chamado->assunto }}</td>
                        <td>{{ $chamado->user_name }}</td>
                        <td>{{ $chamado->user_setor }}</td>
                        <td>{{ $chamado->nivel_de_prioridade }}</td>
                        <td>
                            @if ($chamado->is_resolved == 0)
                            Pendente
                            @elseif ($chamado->is_resolved == 1)
                            Aceito
                            @else
                            Resolvido
                            @endif
                        </td>
                        <td>
                            <div class="d-flex">
                                @if ($chamado->is_resolved != 2)
                                <a href="{{ route('chamados.edit', $chamado->id) }}" class="btn btn-sm btn-primary mb-2 me-2">Editar</a>
                                <button class="btn btn-sm btn-danger btn-delete" data-delete-url="{{ route('chamados.delete', $chamado->id) }}">Excluir</button>
                                @endif
                                @if ($chamado->is_resolved == 2)
                                <a href="{{ route('chamados.feedback', ['chamado_id' => $chamado->id]) }}" class="btn btn-sm btn-success mb-2 me-2">Feedback</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="deleteModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Tem certeza de que deseja excluir este chamado?</p>
                </div>
                <div class="modal-footer">
                    <button id="cancelDelete" class="btn btn-secondary" onclick="closeDeleteModal()">Cancelar</button>
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
@endsection