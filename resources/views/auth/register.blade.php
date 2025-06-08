@extends('layouts.main')
@section('title', 'Login - Rusky Vet')
@section('content')
	<section class="py-7">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-5 col-lg-4">
					<h1 class="h3 mb-3">Criar nova conta</h1>
					<p>Já possui uma conta? <a href="{{ route('login') }}">Faça o login</a>.</p>

					<form class="mt-5" action="{{ route('register') }}" method="POST">
						@csrf
						<div class="form-group">
							<label for="name">Nome</label>
							<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
							@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="email">E-mail</label>
							<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}">
							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="form-group">
							<label for="password">Senha</label>
							<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<p>
							Ao se cadastrar, você concorda com nossos <a href="https://i.ibb.co/dkQZns3/nemly-nemlerey.jpg" target="_blank">termos de uso</a>.
						</p>

						<button type="submit" class="btn btn-primary btn-block mt-4">Cadastrar</button>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection
