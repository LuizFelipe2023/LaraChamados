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
                'password' => 'required|string|confirmed|min:8',
                'setor' => 'required|in:Informática,Administrativa,Produção,Logística'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'setor' => $request->setor
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
                    return redirect()->route('admin.index')->with('success', 'Login bem-sucedido');
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
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();
        $token = Str::random(60);

        // Atualiza o token de redefinição de senha do usuário
        $user->update([
            'reset_token' => $token
        ]);

        // Notifica o usuário com o token de redefinição de senha
        Notification::route('mail', $user->email)->notify(new ResetPasswordNotification($token, $request->email));

        return redirect()->route('login')->with('success', 'Link de redefinição de senha enviado!');
    }
    public function showResetPasswordForm(Request $request)
    {
        $token = $request->token;
        return view('auth.reset-password', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('password.request')->withErrors('Este usuário não existe');
        }

        if ($request->token !== $user->reset_token) {
            return redirect()->route('password.request')->withErrors('Token inválido');
        }
        
        $user->password = Hash::make($request->password);
        $user->reset_token = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Senha redefinida com sucesso');
    }
}
