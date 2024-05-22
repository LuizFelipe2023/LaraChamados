<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/layout.css')}}">
    <title>Layout</title>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-content">
            <a href="#">Chamados</a>
            <a href="#">Criar Chamado</a>
            <a href="#">Logout</a>
            <a href="#">Painel Administrativo</a>
        </div>
    </div>
    <div class="main-content">
        <header>
            <div class="container-header-fixed">
                <h2>LaraChamados</h2>
            </div>
        </header>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>

</html>