<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    public function index()
    {
        $veiculo = Veiculo::with('cliente')->orderBy('placa')->paginate(12);

        return view('veiculos-index', compact('veiculos'));
    }

    public function create()
    {
        return view('veiculos-form', [
            'veiculo' => new Veiculo,
            'clientes' => Cliente::orderBy('nome')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_cliente' => ['required', 'exists:clientes,id_cliente'],
            'placa' => ['required', 'string', 'max:10', 'unique:veiculos,placa'],
            'marca' => ['required', 'string', 'max:50'],
            'modelo' => ['required', 'string', 'max:50'],
            'ano' => ['required', 'integer', 'between:1950,'.(now()->year + 1)],
        ]);
        Veiculo::create($data);

        return redirect()->route('veiculos.index')->with('success', 'Veículo cadastrado.');
    }
}