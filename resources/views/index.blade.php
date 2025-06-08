@extends('layouts.main')
@section('title', 'Rusky Vet - A saúde do seu cão em primeiro lugar')
@section('content')
	<section class="py-7 overlay">
		<div class="container text-center">
			<h1 class="text-white">Bem-vindo(a) à Rusky</h1>

			<div class="row justify-content-center">
				<div class="col-md-7">
					<p class="lead text-white mt-4">A melhor empresa de saúde canina do mundo, agora com agendamento de consultas online.</p>
					<p class="mt-5">
						<a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">Agende sua consulta</a>
					</p>
				</div>
			</div>
		</div>
	</section>

	<section class="border-top py-7">
		<div class="container">
			<div class="row align-items-center justify-content-between">
				<div class="col-12 col-md-6">
					<h3>
						Nós ligamos para você,<br>
						<span class="text-primary-desat">Mas seu cachorro em primeiro lugar.</span>
					</h3>
					<p class="lead text-muted mb-5 mb-lg-0 mt-4">
						Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nostrum, fugit!
					</p>
				</div>

				<div class="col-md-6 text-lg-right text-center">
					<img src="{{ asset('images/section-1.jpg') }}" width="80%" class="radius">
				</div>
			</div>
		</div>
	</section>

	<section class="border-top py-7">
		<div class="container">
			<div class="row align-items-center justify-content-between">
				<div class="col-md-6 text-lg-left text-center">
					<img src="{{ asset('images/section-2.jpg') }}" width="80%" class="radius">
				</div>

				<div class="col-12 col-md-6">
					<h3 class="mt-5 mt-lg-0">
						Sua experiência conosco<br> <span class="text-primary-desat">será surpreendente.</span>
					</h3>
					<p class="lead text-muted mt-4">
						Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nostrum, fugit!
					</p>
				</div>
			</div>
		</div>
	</section>
@endsection
