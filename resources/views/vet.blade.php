@extends('layouts.main')

@section('content')
    <h2>Consultas agendadas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Data</th>
                <th>Hora</th>
                <th>Cliente</th>
                <th>Paciente</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->appointment_date->format('d/m/Y') }}</td>
                    <td>{{ $appointment->appointment_date->format('H:i') }}</td>
                    <td>{{ $appointment->user->name }}</td>
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
                    <td>
                        <a href="{{ route('appointment.edit', $appointment) }}" class="btn btn-info btn-sm">
                            @if ($appointment->status == 'finished')
                                Ver
                            @else
                                Atender
                            @endif
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
