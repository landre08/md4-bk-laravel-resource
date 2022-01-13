<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tarefa;

class TarefaController extends Controller
{
    public function list()
    {
        // Listando todos
        $list = Tarefa::all();

        return view('tarefas.list', [
            'list' => $list
        ]);
    }

    public function add()
    {
        return view('tarefas.add');
    }

    // Utilizando validação do Laravel
    public function addAction(Request $request)
    {
        // Caso não passe, ele retorna para a tela anterior que no caso é o tarefas.add com os erros
        $request->validate([
            'titulo' => ['required', 'string']
        ]);
        
        $titulo = $request->input('titulo');

        $t = new Tarefa;
        $t->titulo = $titulo;
        $t->save();

        return redirect()->route('tarefas.list');
    }

    public function edit($id)
    {
        $data = Tarefa::find($id);

        if ($data) {
            return view('tarefas.edit', ['data' => $data]);
        } else {
            return redirect()->route('tarefas.list');
        }
        
    }

    public function editAction(Request $request, $id)
    {
        if ($request->filled('titulo')) {
            $titulo = $request->input('titulo');
        
            // Forma 1:
            /*
            $t = Tarefa::find($id);
            $t->titulo = $titulo;
            $t->save();
            */

            // Forma 2 (Colocar o fillable no model):
            Tarefa::find($id)->update(['titulo' => $titulo]);

            return redirect()->route('tarefas.list');
        } else {
            return redirect()->route('tarefas.edit', ['id' => $id])->with('warning', 'Você não preencheu o título');
        }
    }

    public function del($id)
    {
        Tarefa::find($id)->delete();

        return redirect()->route('tarefas.list');
    }

    public function done($id)
    {
        // Opção 1: select + update
        // Opção2: update matemático

        // Opção 2:
        $t = Tarefa::find($id);

        if ($t) {
            $t->resolvido = 1 - $t->resolvido;
            $t->save();
        }

        return redirect()->route('tarefas.list');
    }
}
