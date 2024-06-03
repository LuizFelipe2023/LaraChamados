@extends('layouts.painel')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/painel.css')}}">
    <title>Painel Administrativo</title>
</head>

<body>
    <div class="container mt-4">
        <div class="container table-responsive">
            <label for="status">Filtrar por status:</label>
            <form action="{{ route('admin.filterByStatus') }}" method="GET" class="d-flex align-items-end mb-4">
                <select name="status" id="status" class="form-select me-2 custom-select-sm">
                    <option value="0">Pendente</option>
                    <option value="1">Aceito</option>
                    <option value="2">Resolvido</option>
                </select>
                <button type="submit" class="btn btn-secondary">Filtrar</button>
            </form>
            <h1 class="text-center mt-3">Lista de Chamados - Painel Administrativo</h1>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Título</th>
                        <th scope="col">Assunto</th>
                        <th scope="col">Status</th>
                        <th scope="col">Feedback</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($chamados) > 0)
                    @foreach ($chamados as $chamado)
                    <tr>
                        <td>{{ $chamado->id }}</td>
                        <td>{{ $chamado->titulo }}</td>
                        <td>{{ $chamado->assunto }}</td>
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
                            @if ($chamado->feedback == null)
                            Ainda não há feedback
                            @else
                            {{ $chamado->feedback }}
                            @endif
                        </td>
                        <td>
                            @if ($chamado->rating == null)
                            Ainda não há rating
                            @else
                            {{ $chamado->rating }}
                            @endif
                        </td>
                        <td>
                            @if ($chamado->is_resolved == 0)
                            <form action="{{ route('admin.acceptChamado', $chamado->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Aceitar</button>
                            </form>
                            @elseif ($chamado->is_resolved == 1)
                            <form action="{{ route('admin.solveChamado', $chamado->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning">Resolver</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7" class="text-center">Nenhum chamado encontrado.</td>
                    </tr>
                    @endif
                </tbody>

            </table>
        </div>
    </div>
    @include('layouts.footer')
</body>

</html>
@endsection