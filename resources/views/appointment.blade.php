@extends('layouts.main')

@section('content')
	<h2>Agendar consulta</h2>

	<form action="{{ route('appointment.store') }}" method="POST">
		@csrf

		<div class="form-group">
			<label for="patient_id">Cachorro</label>
			<select name="patient_id" id="patient_id" class="form-control" required>
				<option value="">Selecione um cachorro</option>
				@foreach ($patients as $patient)
					<option value="{{ $patient->id }}">{{ $patient->name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="appointment_date">Data</label>
			<input type="date" name="appointment_date" id="appointment_date" class="form-control" required min="{{ date('Y-m-d') }}">
		</div>

		<div class="form-group">
			<label for="appointment_time">Horário</label>
			<select name="appointment_time" id="appointment_time" class="form-control" required>
				<option value="">Selecione uma data para ver os horários</option>
			</select>
		</div>

		<button type="submit" class="btn btn-primary">Agendar</button>
		<a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
	</form>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#appointment_date').on('change', function() {
		var date = $(this).val();
		var timeSelect = $('#appointment_time');
		
		timeSelect.html('<option value="">Carregando...</option>');

		if (!date) {
			timeSelect.html('<option value="">Selecione uma data para ver os horários</option>');
			return;
		}

		$.ajax({
			url: '{{ route("appointment.slots") }}',
			type: 'GET',
			data: { date: date },
			success: function(data) {
				timeSelect.html('');
				if (data.length > 0) {
					$.each(data, function(key, value) {
						timeSelect.append('<option value="' + value + '">' + value + '</option>');
					});
				} else {
					timeSelect.html('<option value="">Nenhum horário disponível</option>');
				}
			},
			error: function(xhr) {
				console.log(xhr.responseText);
				timeSelect.html('<option value="">Erro ao buscar horários</option>');
			}
		});
	});
});
</script>
@endsection
