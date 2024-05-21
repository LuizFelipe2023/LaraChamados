<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function storeRegister(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'passsword' => 'required|string|confirmed|min:8',
            ]);

            $user =  User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'tipo' => 0
            ]);

            if (!$user) {
                return redirect()->back()->with('error', 'Falha ao cadastrar o usuario');
            }

            return redirect()->route('login')->with('success', 'Usuario cadastrado com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Houve um erro no processo de registro de usuario: ' . $e->getMessage());
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                if (Auth::user()->tipo == 1) {
                    return redirect()->route('admin.chamados.index')->with('success', 'Login bem-sucedido');
                }
                return redirect()->route('chamados.index')->with('success', 'Login bem-sucedido');
            } else {
                return back()->withErrors([
                    'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
                    'password' => 'Senha incorreta'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Houve algum erro ao processar o login: ' . $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout realizado com sucesso');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email'
            ]);

            $userExists = User::where('email', $request->email)->first();

            if (!$userExists) {
                return redirect()->route('login')->with('errors', 'Este Usuario não existe');
            }

            $token = Str::random(60);

            $userExists->update([
                'reset_token' => $token
            ]);

            Notification::route('mail', $request->email)->notify(new ResetPasswordNotification($token));

            return redirect()->route('login')->with('success', 'Link de redefinição de senha enviado!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Houve algum erro ao processar a solicitação: ' . $e->getMessage());
        }
    }

    public function showResetPasswordForm($token, $email)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $email]);
    }

    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|string|confirmed|min:8',
            ]);


            $user = User::where('email', $request->email)->first();


            if (!$user) {
                return redirect()->route('password.request')->withErrors('Este usuário não existe');
            }


            if (!Hash::check($request->token, $user->reset_token)) {
                return redirect()->route('password.request')->withErrors('Token inválido');
            }


            $user->password = Hash::make($request->password);
            $user->reset_token = null;
            $user->save();

            return redirect()->route('login')->with('success', 'Senha redefinida com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Houve um erro ao redefinir a senha: ' . $e->getMessage());
        }
    }
}
