<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/painel.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/painel.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Painel Administrativo</title>
</head>

<body>
    <div class="navbar">
        <a class="navbar-brand" href="#">LaraChamados</a>
        <div class="navbar-content">
            <a href="{{ route('chamados.index') }}"><i class="fas fa-list"></i> Chamados</a>
            <a href="{{ route('admin.index') }}"><i class="fas fa-cogs"></i> Painel Administrativo</a>
            <a href="{{ route('admin.user') }}"><i class="fas fa-users"></i> Lista de Usuarios</a>
            <a href="{{route('admin.graphics')}}"><i class="fas fa-chart-bar"></i> Gráficos</a>
            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>

</html>