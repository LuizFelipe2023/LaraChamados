<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;
use App\Models\User;

class AdminController extends Controller
{
    public function adminIndex()
    {
        $chamados = Chamado::all();
        return view('admin.index', ['chamados' => $chamados]);
    }

    public function listarUsuarios()
    {
        $Users = User::all();
        return view('admin.user', ['users' => $Users]);
    }

    public function filterByStatus(Request $request)
    {
        $status = $request->input('status');
        $chamados = Chamado::where('is_resolved', $status)->get();
        return view('admin.index', ['chamados' => $chamados, 'selectedStatus' => $status]);
    }


    public function acceptChamado($id)
    {
        try {
            $chamado = Chamado::find($id);

            if (!$chamado || $chamado->is_resolved !== 0) {
                return redirect()->back()->with('error', 'Chamado não encontrado ou já aceito.');
            }

            $chamado->update([
                'is_resolved' => 1
            ]);

            return redirect()->back()->with('success', 'Chamado Aceito com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Houve algum erro ao aceitar o chamado: ' . $e->getMessage());
        }
    }

    public function solveChamado($id)
    {
        try {
            $chamado = Chamado::find($id);

            if (!$chamado || $chamado->is_resolved !== 1) {
                return redirect()->back()->with('error', 'Chamado não encontrado ou não está aceito.');
            }

            $chamado->update(['is_resolved' => 2]);

            return redirect()->back()->with('success', 'Chamado marcado como solucionado com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Houve algum erro ao marcar o chamado como solucionado: ' . $e->getMessage());
        }
    }
}
