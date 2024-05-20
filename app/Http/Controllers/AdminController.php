<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamado;

class AdminController extends Controller
{
    public function adminIndex()
    {
        $chamados = Chamado::all();
        return view('admin.chamados.index', ['chamados' => $chamados]);
    }


    public function filterByStatus($status)
    {
        $chamados = Chamado::where('status', $status)->get();
        return view('admin.chamados.index', ['chamados' => $chamados, 'selectedStatus' => $status]);
    }

    public function acceptChamado($id)
    {
        try {

            $chamado = Chamado::find($id);

            if (!$chamado || $chamado->status !== 0) {
                return redirect()->back()->with('error', 'Chamado não encontrado ou já aceito.');
            }

            $chamado->update([
                'status' => 1
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

            if (!$chamado || $chamado->status !== 1) {
                return redirect()->back()->with('error', 'Chamado não encontrado ou não está aceito.');
            }

            $chamado->update(['status' => 2]);

            return redirect()->back()->with('success', 'Chamado marcado como solucionado com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Houve algum erro ao marcar o chamado como solucionado: ' . $e->getMessage());
        }
    }
}
