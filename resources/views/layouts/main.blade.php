<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

		<link rel="stylesheet" href="{{ asset('css/app.css') }}?v=1">
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;900&display=swap" rel="stylesheet">

		<link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
    </head>
    <body>
		<nav class="navbar navbar-scroll-top fixed-top navbar-expand-lg navbar-light bg-white border-bottom">
			<div class="container">
				<a href="{{ route('index') }}" class="navbar-brand">
                    <img src="{{ asset('images/logo.png') }}" class="mr-2" width="25">
                    <strong>Rusky Vet</strong>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Abrir menu">
					<span class="menu-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="menu">
					<ul class="navbar-nav ml-auto">
						@guest
							<li class="nav-item">
								<a class="nav-link" href="{{ route('login') }}">Login</a>
							</li>
						@else
							<li class="nav-item dropdown">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									{{ explode(' ', trim(auth()->User()->name))[0] }}
								</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<a href="{{ auth()->User()->type === 'VET' ? route('vet') : route('client') }}" class="dropdown-item">Painel</a>
									<a class="dropdown-item" href="{{ route('logout') }}" onClick="event.preventDefault();document.getElementById('logout-form').submit();">
										Logout
									</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
										@csrf
									</form>
								</div>
							</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav>

		@yield('content')

		<footer>
			<div class="container">
				<div class="row">
					<div class="col-12 text-center text-muted">© Rusky Vet - Todos os direitos reservados.</div>
				</div>
			</div>
		</footer>

		<script src="{{ asset('js/app.js') }}?v=1" type="text/javascript"></script>
		<script>
			@if(session('toast'))
				toast('{{ session('toast') }}');
			@endif
		</script>
		@stack('scripts')
	</body>
</html>
