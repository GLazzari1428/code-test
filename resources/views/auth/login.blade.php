@extends('layouts.main')
@section('title', 'Login - Rusky Vet')
@section('content')
	<section class="py-7">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-5 col-lg-4">
					<h1 class="h3 mb-3">Acesse sua conta</h1>
					<p>Não possui uma conta? <a href="{{ route('register') }}">Cadastre-se</a>.</p>

					<form class="mt-5" action="{{ route('login') }}" method="POST">
						@csrf
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
							<input type="password" name="password" class="form-control" id="password">
							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<button type="submit" class="btn btn-primary btn-block mt-4">Entrar</button>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection
