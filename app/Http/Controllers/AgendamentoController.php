<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\Veiculo  ;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AgendamentoController extends Controller
{
    public function index()
    {
        $agendamentos = Agendamento::with(['cliente', 'veiculo'])
            ->orderBy('data_agendamento')
            ->paginate(12);

        return view('agendamentos-index', compact('agendamentos'));
    }

    public function create()
    {
        return view('agendamentos-form', [
            'agendamento' => new Agendamento,
            'clientes' => Cliente::orderBy('nome')->get(),
            'veiculos' => Veiculo::with('cliente')->orderBy('placa')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Agendamento::create($this->validated($request));

        return redirect()
            ->route('agendamentos.index')
            ->with('success', 'Agendamento cadastrado.');
    }

    public function edit(Agendamento $agendamento)
    {
        return view('agendamentos-form', [
            'agendamento' => $agendamento,
            'clientes' => Cliente::orderBy('nome')->get(),
            'veiculos' => Veiculo::with('cliente')->orderBy('placa')->get(),
        ]);
    }

    public function update(Request $request, Agendamento $agendamento)
    {
        $agendamento->update($this->validated($request));

        return redirect()
            ->route('agendamentos.index')
            ->with('success', 'Agendamento atualizado.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'id_cliente' => ['required', 'exists:clientes,id_cliente'],
            'id_veiculo' => [
                'required',
                Rule::exists('veiculos', 'id_veiculo')
                    ->where('id_cliente', $request->input('id_cliente')),
            ],
            'data_agendamento' => ['required', 'date'],
            'descricao_servico' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:Agendado,Em andamento,Concluído,Cancelado'],
        ]);
    }
}