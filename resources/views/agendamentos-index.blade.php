@extends('layout-app')

@section('title', 'Agendamentos')

@section('content')
    <h1>Agendamentos</h1>
    <p>Serviços organizados por data e horário.</p>
    <p><a href="{{ route('agendamentos.create') }}">Cadastrar agendamento</a></p>

    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Horário</th>
                <th>Cliente</th>
                <th>Contato</th>
                <th>Veículo</th>
                <th>Placa</th>
                <th>Serviço</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($agendamentos as $agendamento)
                <tr>
                    <td>{{ $agendamento->data_agendamento->format('d/m/Y') }}</td>
                    <td>{{ $agendamento->data_agendamento->format('H:i') }}</td>
                    <td>{{ $agendamento->cliente->nome }}</td>
                    <td>
                        {{ $agendamento->cliente->telefone
                            ?: $agendamento->cliente->email
                            ?: 'Não informado' }}
                    </td>
                    <td>{{ $agendamento->veiculo->marca }} {{ $agendamento->veiculo->modelo }}</td>
                    <td>{{ $agendamento->veiculo->placa }}</td>
                    <td>{{ $agendamento->descricao_servico }}</td>
                    <td>{{ $agendamento->status }}</td>
                    <td><a href="{{ route('agendamentos.edit', $agendamento) }}">Editar</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Nenhum agendamento cadastrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $agendamentos    ->links() }}
@endsection