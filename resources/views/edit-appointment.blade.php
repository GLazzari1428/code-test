@extends('layouts.main')
@section('title', 'Rusky Vet - A saúde do seu cão em primeiro lugar')
@section('content')
	<section class="py-6 border-bottom">
		<div class="container text-center">
			<h1>Consulta #1</h1>

			<div class="row mt-4 justify-content-center">
				<div class="col-md-10 text-left">

					<div class="text-center mb-4">
						<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSDJVdoqib2dry6LTBDWU_0WWvWON_zdAMn_w&usqp=CAU" class="radius" height="140">
					</div>

					<table class="table">
						<tbody>
							<tr>
								<th>Consulta</th>
								<td>1</td>
							</tr>
							<tr>
								<th>Status</th>
								<td>AGENDADA</td>
							</tr>
							<tr>
								<th>Data e hora</th>
								<td>10/10/2020 10:10</td>
							</tr>
							<tr>
								<th>Nome do paciente</th>
								<td>Scooby-Doo</td>
							</tr>
							<tr>
								<th>Raça</th>
								<td>Dogue Alemão</td>
							</tr>
							<tr>
								<th>Idade</th>
								<td>7 dias</td>
							</tr>
							<tr>
								<th>Dono</th>
								<td>Salsicha Billy Rogers</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="row mt-6 justify-content-center">
				<div class="col-md-6 text-left">
					<form action="" method="POST">
						<div class="form-group">
							<label for="notes">Observações</label>
							<textarea name="notes" rows="7" class="form-control @error('notes') is-invalid @enderror" id="notes"></textarea>
							@error('notes')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<button type="submit" class="btn btn-primary btn-block mt-4">Salvar e finalizar consulta</button>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection
