@extends('layouts.painel')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
        }

        .content {
            margin-top: 20px;
            display: flex;
            justify-content: flex-start;
        }

        .container {
            display: flex;
            justify-content: space-evenly;
            flex-direction: column;
            margin-top: 40px;
        }

        .text-center {
            margin-bottom: 25px;
        }

        .stars {
            display: flex;
            flex-direction: row;
        }

        .stars input.star:checked~label.star:before {
            content: '\f005';
            color: #FD4;
        }

        .stars input.star-5:checked~label.star:before {
            color: #FD4;
            text-shadow: 0 0 20px #952;
        }

        .stars label.star {
            font-size: 30px;
            padding: 0;
            font-family: FontAwesome;
            cursor: pointer;
        }

        .stars input.star {
            display: none;
        }

        .stars label.star:before {
            content: '\f006';
            color: #ccc;
            font-family: FontAwesome;
        }

        .stars label.star:hover:before {
            content: '\f005';
            color: #FD4;
            transition: all .25s;
        }

        .fa-star.checked {
            color: gold;
        }

        .fa-star {
            color: gray;
        }

        .table-responsive {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <div class="container mt-2">
        <div class="container">
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
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Título</th>
                            <th scope="col">Assunto</th>
                            <th scope="col">Usuário Solicitante</th>
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
                                                                    <td>{{ $chamado->user_name }}</td>
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
                                                                        @if (is_null($chamado->feedback))
                                                                            Ainda não há feedback
                                                                        @else
                                                                            {{ $chamado->feedback }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <!-- Exibição das estrelas para o rating -->
                                                                        <div class="stars" id="rating_{{ $chamado->id }}">
                                                                            @php
                                                                                $rating = $chamado->rating ?? 0; // Obtém o rating ou define como 0 se não existir
                                                                            @endphp
                                                                            @for ($i = 1; $i <= 5; $i++)
                                                                                <span class="fa fa-star {{ $i <= $rating ? 'checked' : '' }}"
                                                                                    style="color: {{ $i <= $rating ? 'gold' : 'gray' }};"></span>
                                                                            @endfor
                                                                        </div>
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
                                <td colspan="7" class = "text-center">Nenhum chamado encontrado.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</body>

</html>
@endsection