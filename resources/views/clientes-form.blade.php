@extends('layout-app')

@section('title', $cliente->exists ? 'Editar cliente' : 'Cadastrar cliente')

@section('content')
    <h1>{{ $cliente->exists ? 'Editar cliente' : 'Cadastrar cliente' }}</h1>

    <form
        method="post"
        action="{{ $cliente->exists ? route('clientes.update', $cliente) : route('clientes.store') }}"
    >
        @csrf
        @if ($cliente->exists)
            @method('PUT')
        @endif

        <div>
            <label for="nome">Nome completo *</label>
            <input
                id="nome"
                name="nome"
                value="{{ old('nome', $cliente->nome) }}"
                maxlength="100"
                required
            >
        </div>

        <div>
            <label for="email">E-mail</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $cliente->email) }}"
                maxlength="100"
            >
        </div>

        <div>
            <label for="telefone">Telefone</label>
            <input
                id="telefone"
                name="telefone"
                value="{{ old('telefone', $cliente->telefone) }}"
                maxlength="20"
                required
            >
        </div>

        <div>
            <label for="cpf">CPF</label>
            <input
                id="cpf"
                name="cpf"
                value="{{ old('cpf', $cliente->cpf) }}"
                maxlength="20"
                required
            >
            <p>O CPF é armazenado criptografado no banco de dados.</p>
        </div>

        <button type="submit">{{ $cliente->exists ? 'Salvar alterações' : 'Cadastrar cliente' }}</button>
        <a href="{{ route('clientes.index') }}">Cancelar</a>
    </form>
@endsection