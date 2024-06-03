<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Index</title>
</head>

<body>
    <div class="navbar">
        <a class="navbar-brand" href="#">LaraChamados</a>
        <div class="navbar-content">
            <a href="{{ route('chamados.index') }}"><i class="fas fa-list"></i> Chamados</a>
            <a href="{{ route('chamados.create') }}"><i class="fas fa-plus"></i> Criar Chamado</a>
            <a href="{{route('admin.index')}}"><i class="fas fa-cogs"></i> Painel Administrativo</a>
            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
    <div class="content">
        @yield('content')
    </div>

    @include('layouts.footer')
</body>

</html>
