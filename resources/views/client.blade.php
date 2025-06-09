@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h2>Meus cachorros</h2>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#newPatientModal">
                Cadastrar novo cachorro
            </button>
            <a href="{{ route('appointment.create') }}" class="btn btn-secondary">
                Agendar consulta
            </a>
        </div>
    </div>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Espécie</th>
                <th>Raça</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td>
                        @if ($patient->photo)
                            <img src="{{ asset('storage/' . $patient->photo) }}" alt="Foto de {{ $patient->name }}" width="50" height="50" style="object-fit: cover; border-radius: 50%;">
                        @else
                            <img src="https://via.placeholder.com/50" alt="Sem foto" width="50" height="50" style="border-radius: 50%;">
                        @endif
                    </td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->species }}</td>
                    <td>{{ $patient->breed }}</td>
                    <td>
                        <a href="{{ route('patient.edit', $patient) }}" class="btn btn-sm btn-info">Editar</a>
                        <form action="{{ route('patient.delete', $patient) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>
    
    <h2>Minhas consultas</h2>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Data</th>
                <th>Hora</th>
                <th>Cachorro</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->appointment_date->format('d/m/Y') }}</td>
                    <td>{{ $appointment->appointment_date->format('H:i') }}</td>
                    <td>{{ $appointment->patient->name }}</td>
                    <td>
                        @if ($appointment->status == 'scheduled')
                            <span class="badge badge-primary">Agendada</span>
                        @elseif ($appointment->status == 'finished')
                            <span class="badge badge-success">Finalizada</span>
                        @else
                            <span class="badge badge-secondary">{{ ucfirst($appointment->status) }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhuma consulta agendada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="modal fade" id="newPatientModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastrar novo cachorro</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('patient.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="species">Espécie</label>
                            <input type="text" name="species" id="species" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="breed">Raça</label>
                            <input type="text" name="breed" id="breed" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="photo">Foto</label>
                            <input type="file" name="photo" id="photo" class="form-control-file">
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
