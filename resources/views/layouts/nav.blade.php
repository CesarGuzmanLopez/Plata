<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div id="topbar" class="d-none d-lg-flex align-items-center fixed-top ">
		<div class="container d-flex">
			<div class="contact-info mr-auto">
				<i class="fa fa-envelope"></i> <a href="mailto:contact@example.com">contact@example.com</a>
				<i class="fa fa-phone"></i> +1 5589 55488 55
			</div>
			<div class="social-links">
				<a href="#" class="twitter"><i class="fa fa-twitter"></i></a> <a
					href="#" class="facebook"><i class="fa fa-facebook"></i></a> <a
					href="#" class="instagram"><i class="fa fa-instagram"></i></a> <a
					href="#" class="skype"><i class="fa fa-skype"></i></a> <a href="#"
					class="linkedin"><i class="fa fa-linkedin"></i></a>
			</div>
		</div>
	</div>
	<b><a class="navbar-brand" href="{{route('/')}}">Plata</a></b> <a
		class="navbar-brand" href="{{route('/index')}}">Escritorio</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse"
		data-target="#navbarSupportedContent"
		aria-controls="navbarSupportedContent" aria-expanded="false"
		aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active"></li>
			<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
				href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false"> Cursos y preguntas </a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{route('/')}}">Administracion
						Cursos Temas Grados</a> <a class="dropdown-item"
						href="{{route('/')}}">Crear un curso</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="{{route('/')}}">Reactivos</a>
				</div></li>
			<li>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav mr-auto">

					</ul>
					<!-- Right Side Of Navbar -->
					<!-- Authentication Links -->
					@guest
					<li class="nav-item"><a class="nav-link"
						href="{{ route('login') }}">{{ __('Login') }}</a></li> @else <a
						id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
						role="button" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false" v-pre> {{ Auth::user()->name }} <span
						class="caret"></span>
					</a> <a class="dropdown-item" href="{{ route('logout') }}"
						onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						{{ __('Logout') }} </a>

					<form id="logout-form" action="{{ route('logout') }}" method="POST"
						style="display: none;">@csrf</form>
					@endguest

				</div>
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0">
			<input class="form-control mr-sm-2" type="search"
				placeholder="Search" aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form>
	</div>
</nav>