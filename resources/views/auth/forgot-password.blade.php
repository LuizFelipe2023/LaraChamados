<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/forgot.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Forgot Password</title>
</head>
<body>
    <div class="container">
        <h2>Forgot Password Form</h2>
         <div class="container-form">
              <form action="" method="">
                    <label for="Email">Email:</label>
                    <input type="email" name="email" id="email">
                    <button type="submit">Enviar</button>
              </form>
              <p>Deseja voltar pra tela de login <a href="{{ route('login') }}">Clique Aqui</a></p>
         </div>
    </div>
</body>
</html>