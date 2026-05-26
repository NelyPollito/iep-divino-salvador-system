<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Subgrade;
use Illuminate\Http\Request;

class SubgradeController extends Controller
{
    public function index()
    {
        // Cargamos subgrado -> grado -> semestre -> periodo
        $subgrades = Subgrade::with('degree.semester.period')
                    ->orderBy('idsubgrade', 'DESC')
                    ->get();

        return view('subgrades.index', compact('subgrades'));
    }
    public function create()
    {
        // Cargamos los grados activos con sus periodos para el selector
        $degrees = Degree::with('semester.period')->where('status', 1)->get();
        return view('subgrades.create', compact('degrees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subgrade_name' => 'required|string|max:50',
            'iddegree'      => 'required|exists:degrees,iddegree',
        ]);

        Subgrade::create([
            'subgrade_name' => $request->subgrade_name,
            'iddegree'      => $request->iddegree,
            'status'        => 1,
        ]);

        return redirect()->route('subgrades.index')->with('add_successSubgrade', 'OK');
    }
    public function edit($id)
    {
        // Buscamos el subgrado con sus relaciones
        $subgrade = Subgrade::findOrFail($id);
        
        // Grados activos con su periodo para el selector
        $degrees = Degree::with('semester.period')->get();
        
        return view('subgrades.edit', compact('subgrade', 'degrees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subgrade_name' => 'required|string|max:50',
            'iddegree'      => 'required|exists:degrees,iddegree',
            'status'        => 'required|in:0,1'
        ]);

        $subgrade = Subgrade::findOrFail($id);
        $subgrade->update([
            'subgrade_name' => $request->subgrade_name,
            'iddegree'      => $request->iddegree,
            'status'        => $request->status,
        ]);

        return redirect()->route('subgrades.index')->with('update_successSubgrade', 'OK');
    }
    public function showDelete($id)
    {
        // Buscamos el subgrado con sus relaciones para mostrar info detallada al usuario
        $subgrade = Subgrade::with('degree.semester.period')->findOrFail($id);
        return view('subgrades.delete', compact('subgrade'));
    }

    public function destroy($id)
    {
        $subgrade = Subgrade::findOrFail($id);
        
        // Desactivación lógica (status = 0)
        $subgrade->update(['status' => 0]);

        return redirect()->route('subgrades.index')->with('delete_successSubgrade', 'OK');
    }

}