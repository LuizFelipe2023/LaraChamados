<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/forgot.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forgot Password</title>
</head>
<body>
    <div class="container">
        <h2>Forgot Password Form</h2>
         <div class="container-form">
              <form action="{{ route('password.email') }}" method="POST">
                @csrf
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                    <button type="submit">Enviar</button>
              </form>
              <p>Deseja voltar pra tela de login <a href="{{ route('login') }}">Clique Aqui</a></p>
         </div>
    </div>
</body>
</html>
