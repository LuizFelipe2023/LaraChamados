<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Register - LaraChamados</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Register - LaraChamados</h2>
            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" placeholder="Nome">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Seu email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Sua senha">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirme sua senha">
                </div>
                <div class="form-group">
                    <label for="setor">Setor</label>
                    <select name="setor" id="setor_id">
                        <option value="">Selecione um setor</option>
                        <option value="Informática">Informática</option>
                        <option value="Administrativa">Administrativa</option>
                        <option value="Produção">Produção</option>
                        <option value="Logística">Logística</option>
                    </select>
                </div>
                <button type="submit" class="submit_login">Register</button>
            </form>
            <p>Tem uma conta? <a href="{{ route('login') }}">Logue Aqui</a></p>
            <p>Esqueceu sua senha? <a href="{{ route('password.request') }}">Clique aqui para redefinir</a></p>
        </div>
    </div>
</body>

</html>
