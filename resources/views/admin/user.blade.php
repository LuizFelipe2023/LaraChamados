@extends('layouts.painel')
<link rel="stylesheet" href="{{ asset('css/admin_index.css') }}">
@section('content')
<div class="container">
    <h1>Lista de Usuários</h1>
    <div class="container-list-chamados">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de Criação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->nome }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('layouts.footer_admin')
@endsection
