<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;
use Illuminate\Support\Facades\Auth;

class ChamadoController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $chamados = Chamado::where('user_id',$user->id)->get();
        return view('chamados.index', ['chamados' => $chamados]);
    }
    

    public function create()
    {
        return view('chamados.create');
    }

    public function storeChamado(Request $request)
    {
        try {
            if (Auth::check()) {
                $user = Auth::user();

                $request->validate([
                    'titulo' => 'required|min:3|max:100',
                    'assunto' => 'required|min:4|max:500',
                    'nivel_de_prioridade' => 'required|in:baixo,medio,alto'
                ]);

                Chamado::create([
                    'titulo' => $request->titulo,
                    'assunto' => $request->assunto,
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_setor' => $user->setor,
                    'nivel_de_prioridade' => $request->nivel_de_prioridade,
                    'is_resolved' => 0
                ]);

                return redirect()->route('chamados.index')->with('success', 'Chamado criado com sucesso');
            } else {
                return redirect()->route('login')->with('error', 'Você precisa estar autenticado para criar um chamado.');
            }
        } catch (\Exception $e) {
            \Log::error('Erro ao criar chamado: ' . $e->getMessage());
            return redirect()->route('chamados.index')->with('error', 'Houve um erro ao criar um chamado no sistema. Por favor, tente novamente mais tarde.');
        }
    }


    public function editChamado($id)
    {
        $user = Auth::user();
        $chamado = Chamado::where('id', $id)->where('user_id', $user->id)->first();

        if (!$chamado) {
            return redirect()->route('chamados.index')->with('error', 'Chamado não encontrado ou você não tem permissão para editá-lo.');
        }

        return view('chamados.edit', ['chamado' => $chamado]);
    }

    public function updateChamado(Request $request, $id)
    {
        try {
            $user = Auth::user();
            $chamado = Chamado::where('id', $id)->where('user_id', $user->id)->first();

            if (!$chamado) {
                return redirect()->route('chamados.index')->with('error', 'Chamado não encontrado ou você não tem permissão para editá-lo.');
            }

            $request->validate([
                'titulo' => 'required|min:3|max:100',
                'assunto' => 'required|min:4|max:500',
                'nivel_de_prioridade' => 'required|in:baixo,medio,alto'  // Validação do enum
            ]);

            $chamado->update([
                'titulo' => $request->titulo,
                'assunto' => $request->assunto,
                'nivel_de_prioridade' => $request->nivel_de_prioridade
            ]);

            return redirect()->route('chamados.index')->with('success', 'Chamado atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('chamados.index')->with('error', 'Houve um erro ao atualizar o chamado: ' . $e->getMessage());
        }
    }
    public function deleteChamado($id)
    {
        try {
            $user_id = Auth::id();
            $chamado = Chamado::where('id', $id)->where('user_id', $user_id)->first();

            if (!$chamado) {
                return redirect()->back()->with('error', 'Chamado não encontrado ou você não tem permissão para deletá-lo.');
            }

            $chamado->delete();

            return redirect()->back()->with('success', 'Chamado deletado com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Houve um erro ao deletar o chamado: ' . $e->getMessage());
        }
    }
}
