<!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="{{ route('index') }}">Inicio</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('alquiler.index')}}">Detalle Alquiler</a></li>
                        @auth
                        @if(Auth::user()->rol_id==1)
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('movimientopelicula.index')}}">Movimiento Peliculas</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('pelicula.index')}}">Administrar Películas</a></li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('registrar.index') }}">Registrar</a>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
						@else
						<li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('login') }}">Login</a></li>
						@endauth
                    </ul>
                </div>
            </div>
        </nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>