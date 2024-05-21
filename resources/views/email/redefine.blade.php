@component('mail::message')
# Redefinição de Senha

Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.

@component('mail::button', ['url' => $url])
Redefinir Senha
@endcomponent

Seu token de redefinição de senha é: {{ $token }}

Se você não solicitou uma redefinição de senha, nenhuma ação adicional é necessária.

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
