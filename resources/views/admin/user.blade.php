@extends('layouts.painel')
@section('content')
<div class="container mt-2">
    <div class="container table-responsive">
    <h1 class="text-center mb-4">Lista de Usuários</h1>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Data de Criação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('layouts.footer')
@endsection
