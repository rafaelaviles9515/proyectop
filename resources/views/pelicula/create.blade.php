@extends('base.base')

@section('title','Crear Pelicula')

@section('boostrap')
@endsection
@section('content')
		<section class="page-section bg-dark text-white">
        </section>
        <div class="container-sm">
        	<br>
			<h1 align="center">Crear Película</h1>
			
			@include('base.session-status')
			@include('base.validation-errors')
			<form method="POST" action="{{route('pelicula.store')}}">
			<div class="form-group">
				@csrf
				<div class="form-group">
				<label>
					Nombre de titulo
				<input class="form-control" type="text" name="titulo" required>
				</label>
				</div>

				<div class="form-group form-check">
				<input class="form-check-input" type="checkbox"class="form-check-input" name="estreno" id="estreno" value="estreno">
				<label class="form-check-label" for="estreno">
					Estreno
				</label>
				</div>

				<div class="form-group">
				<label >
					Año
				<input class="form-control" type="number" name="ano" required>
				</label>
				</div>

				<div class="form-group">
				<label >
					Cantidad de peliculas
				<input class="form-control" type="number" min="0" pattern="^[0-9]+" name="cantidad" required>
				</label>
				</div>

				<div class="form-group">
				<label >
					Precio de venta
				<input class="form-control" type="number" any name="saldo_compra" >
				</label>
				</div>

				<div class="form-group">
				<label >
					Precio de alquiler
				<input class="form-control" type="number" name="saldo_alquiler" >
				</label>
				</div>

				<label>
				Seleccione categoria
					<select class="form-control custom-select" id="categoria_id" name="categoria_id" required>
						<option selected>Seleccione</option>
						@foreach($categorias as $categoria)
		                	<option value="{{$categoria->id}}" >{{$categoria->nombre}}</option>
		                @endforeach
					</select>
				</label>


			</div>
			<button type="submit" class="btn btn-success">Guardar</button>
			<a type="button" class="btn btn-primary" href="{{ route('pelicula.index') }}">Regresar</a>

			</div>
        	</form>
        </div>

@endsection
@section('finalboostrap')
@endsection