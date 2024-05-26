@extends('layouts.painel')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/admin_index.css')}}">
    <title>Painel Administrativo</title>
</head>

<body>
    <div class="container">
        <h1>Lista de Chamados - Painel Administrativo</h1>
        @if (count($chamados) > 0)
            <div class="container-list-chamados">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Assunto</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
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
                    </tbody>
                </table>
            </div>
        @else
            <p>Nenhum chamado encontrado.</p>
        @endif
        
    </div>
    @include('layouts.footer_admin')
</body>

</html>
@endsection
