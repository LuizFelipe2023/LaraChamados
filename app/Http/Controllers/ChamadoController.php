<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Chamado;

class ChamadoController extends Controller
{

    public function layout()
    {
        return view('layouts.index');
    }
    
    public function index()
    {
        $user = auth()->user();
        $chamados = Chamado::where('user_id', $user->id)->get();
        return view('chamados.index', ['chamados' => $chamados]);
    }


    public function create()
    {
        return view('chamados.create');
    }

    public function storeChamado(Request $request)
    {
        try {

            $request->validate([
                'titulo' => 'required|min:3|max:100',
                'assunto' => 'required|min:4|max:500',
                'user_id' => 'required',
                'setor_id' => 'required',
                'nivel_de_prioridade' => 'required'
            ]);

            $user = auth()->user();
            $user_id = $user->id;
            $setor_id = $user->setor_id;


            Chamado::create([
                'titulo' => $request->titulo,
                'assunto' => $request->assunto,
                'user_id' => $user_id,
                'setor_id' => $setor_id,
                'nivel_de_prioridade' => $request->nivel_de_prioridade,
                'status' => 0
            ]);

            return redirect()->route('chamados.index')->with('sucess', 'Chamado criado com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('chamados.index')->with('error', 'Houve um erro ao criar um chamado no sistema: ' . $e->getMessage());
        }
    }

    public function editChamado($id)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $chamado = Chamado::where('id', $id)->where('user_id', $user_id)->first();

        if (!$chamado) {
            return redirect()->route('chamados.index')->with('error', 'Chamado não encontrado ou você não tem permissão para editá-lo.');
        }
        return view('chamados.edit', ['chamado' => $chamado]);
    }

    public function updateChamado(Request $request, $id)
    {
        try {

            $user = auth()->user();
            $user_id = $user->id;

            $chamado = Chamado::where('id', $id)->where('user_id', $user_id)->first();

            if (!$chamado) {
                return redirect()->route('chamados.index')->with('error', 'Chamado não encontrado ou você não tem permissão para editá-lo.');
            }

            $request->validate([
                'titulo' => 'required|min:3|max:100',
                'assunto' => 'required|min:4|max:500',
                'user_id' => 'required',
                'setor_id' => 'required',
                'nivel_de_prioridade' => 'required'
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
            $user = auth()->user();
            $user_id = $user->id;

            $chamado = Chamado::where('id', $id)->where('user_id', $user_id)->first();

            if (!$chamado) {
                return redirect()->back()->with('error', 'Chamado não encontrado ou você não tem permissão para editá-lo.');
            }

            $chamado->delete();

            return redirect()->back()->with('success', 'Chamado deletado com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Houve um erro ao deletar o chamado: ' . $e->getMessage());
        }
    }
}
