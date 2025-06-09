@extends('layouts.main')

@section('content')
    <h2>Detalhes da Consulta</h2>

    <div class="card">
        <div class="card-header">
            Consulta de <strong>{{ $appointment->patient->name }}</strong> em {{ $appointment->appointment_date->format('d/m/Y \à\s H:i') }}
        </div>
        <div class="card-body">
            <p><strong>Dono(a):</strong> {{ $appointment->user->name }}</p>
            <p><strong>Paciente:</strong> {{ $appointment->patient->name }}</p>
            <p><strong>Raça:</strong> {{ $appointment->patient->breed }}</p>
            <p><strong>Status:</strong> 
                @if ($appointment->status == 'scheduled')
                    <span class="badge badge-primary">Agendada</span>
                @elseif ($appointment->status == 'finished')
                    <span class="badge badge-success">Finalizada</span>
                @endif
            </p>

            <hr>

            <form action="{{ route('appointment.update', $appointment) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="notes">Observações</label>
                    <textarea name="notes" id="notes" rows="5" class="form-control" {{ $appointment->status == 'finished' ? 'readonly' : 'required' }}>{{ $appointment->notes }}</textarea>
                </div>

                @if ($appointment->status == 'finished')
                    <p><strong>Consulta finalizada por:</strong> {{ $appointment->vet->name ?? 'N/A' }}</p>
                    <a href="{{ route('vet.dashboard') }}" class="btn btn-secondary">Voltar</a>
                @else
                    <button type="submit" class="btn btn-primary">Salvar e Finalizar Consulta</button>
                @endif
            </form>
        </div>
    </div>
@endsection
