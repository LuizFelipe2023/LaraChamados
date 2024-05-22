@extends('layouts.index')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Lista de Chamados</h1>
        <div class="container-list-chamados">
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Assunto</th>
                        <th>Usuário Solicitante</th>
                        <th>Setor do Usuário</th>
                        <th>Nível de Prioridade</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    @include('layouts.footer')
</body>
</html>
@endsection
