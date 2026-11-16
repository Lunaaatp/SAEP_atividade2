@extends('layout-app')

@section('title', $agendamento->exists ? 'Editar agendamento' : 'Cadastrar agendamento')

@section('content')
    <h1>{{ $agendamento->exists ? 'Editar agendamento' : 'Cadastrar agendamento' }}</h1>

    @if ($clientes->isEmpty() || $veiculos->isEmpty())
        <p>
            Cadastre um cliente e um veículo antes de criar um agendamento.
            <a href="{{ route('veiculos.create') }}">Cadastrar veículo</a>
        </p>
    @else
        <form
            method="post"
            action="{{ $agendamento->exists
                ? route('agendamentos.update', $agendamento)
                : route('agendamentos.store') }}"
        >
            @csrf
            @if ($agendamento->exists)
                @method('PUT')
            @endif

            <div>
                <label for="id_cliente">Cliente *</label>
                <select id="id_cliente" name="id_cliente" required>
                    <option value="">Selecione um cliente</option>
                    @foreach ($clientes as $cliente)
                        <option
                            value="{{ $cliente->id_cliente }}"
                            @selected(old('id_cliente', $agendamento->id_cliente) == $cliente->id_cliente)
                        >
                            {{ $cliente->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="id_veiculo">Veículo *</label>
                <select id="id_veiculo" name="id_veiculo" required>
                    <option value="">Selecione um veículo</option>
                    @foreach ($veiculos as $veiculo)
                        <option
                            value="{{ $veiculo->id_veiculo }}"
                            @selected(old('id_veiculo', $agendamento->id_veiculo) == $veiculo->id_veiculo)
                        >
                            {{ $veiculo->marca }} {{ $veiculo->modelo }}
                            - {{ $veiculo->placa }}
                            - {{ $veiculo->cliente->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="data_agendamento">Data e horário *</label>
                <input
                    id="data_agendamento"
                    name="data_agendamento"
                    type="datetime-local"
                    value="{{ old(
                        'data_agendamento',
                        $agendamento->exists
                            ? $agendamento->data_agendamento->format('Y-m-d\\TH:i')
                            : '',
                    ) }}"
                    required
                >
            </div>

            <div>
                <label for="descricao_servico">Serviço *</label>
                <input
                    id="descricao_servico"
                    name="descricao_servico"
                    value="{{ old('descricao_servico', $agendamento->descricao_servico) }}"
                    maxlength="255"
                    required
                >
            </div>

            <div>
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    @foreach (['Agendado', 'Em andamento', 'Concluído', 'Cancelado'] as $status)
                        <option
                            value="{{ $status }}"
                            @selected(old('status', $agendamento->status ?: 'Agendado') === $status)
                        >
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit">
                {{ $agendamento->exists ? 'Salvar alterações' : 'Cadastrar agendamento' }}
            </button>
            <a href="{{ route('agendamentos.index') }}">Cancelar</a>
        </form>
    @endif
@endsection