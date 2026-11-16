@extends('layout-app')

@section('title', 'Veículos')

@section('content')
    <h1>Veículos</h1>
    <p>Veículos cadastrados e seus respectivos proprietários.</p>
    <p><a href="{{ route('veiculos.create') }}">Cadastrar veículo</a></p>

    <table>
        <thead>
            <tr>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Ano</th>
                <th>Proprietário</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($veiculos as $veiculo)
                <tr>
                    <td>{{ $veiculo->placa }}</td>
                    <td>{{ $veiculo->marca }}</td>
                    <td>{{ $veiculo->modelo }}</td>
                    <td>{{ $veiculo->ano }}</td>
                    <td>{{ $veiculo->cliente->nome }}</td>
                    <td>{{ $veiculo->cliente->telefone }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Nenhum veículo cadastrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $veiculos->links() }}
@endsection