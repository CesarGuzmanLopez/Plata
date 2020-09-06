<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<b><a class="navbar-brand" href="{{route('/')}}">Plata</a></b> <a
		class="navbar-brand" href="{{route('/')}}">Escritorio</a>
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
