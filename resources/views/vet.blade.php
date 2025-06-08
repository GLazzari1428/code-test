@extends('layouts.main')
@section('title', 'Rusky Vet - A saúde do seu cão em primeiro lugar')
@section('content')
	<section class="py-6 border-bottom">
		<div class="container text-center">
			<h1>Olá {{ explode(' ', trim(auth()->User()->name))[0] }}!</h1>
		</div>
	</section>

	<section class="py-5 border-bottom">
		<div class="container text-center">
			<h3>Consultas agendadas</h3>
			<div class="row mt-5 justify-content-center">
				<div class="col-12 col-lg-10">
				<table class="table" style="width: 100%">
					<thead>
						<tr>
							<th>Status</th>
							<th>Nome do dono</th>
							<th>Nome do cachorro</th>
							<th>Data da consulta</th>
							<th>Horário</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>AGENDADA</td>
							<td>Salsicha</td>
							<td>Scooby-Doo</td>
							<td>10/10/2020</td>
							<td>10:00</td>
							<td>
								<a href="{{ route('vet.edit-appointment', 1) }}">Abrir</a>
							</td>
						</tr>
					</tbody>
				</table>

				</div>
			</div>
		</div>
	</section>
@endsection
