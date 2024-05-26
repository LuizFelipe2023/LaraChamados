<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/admin_layout.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Painel Administrativo</title>
</head>

<body>
    <div class="sidebar">
        <figure>
            <img src="{{ asset('imgs/_e8cae7cd-aff0-4827-89f7-39650336d240.jpg') }}" alt="">
            <figcaption>LaraChamados</figcaption>
        </figure>
        <div class="sidebar-content">
            <a href="{{route('admin.index')}}"><i class="fas fa-cogs"></i> Painel Administrativo</a>
        </div>
    </div>
    <div class="main-content">
        <header>
            <div class="container-header-fixed">
                <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </header>
    </div>
    <div class="content">
        @yield('content')
    </div>

</body>
</html>
