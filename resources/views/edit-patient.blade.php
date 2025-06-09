@extends('layouts.main')

@section('content')
    <h2>Editar Cachorro</h2>

    <form action="{{ route('patient.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $patient->name }}" required>
        </div>

        <div class="form-group">
            <label for="species">Espécie</label>
            <input type="text" name="species" id="species" class="form-control" value="{{ $patient->species }}" required>
        </div>

        <div class="form-group">
            <label for="breed">Raça</label>
            <input type="text" name="breed" id="breed" class="form-control" value="{{ $patient->breed }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ route('client.dashboard') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
