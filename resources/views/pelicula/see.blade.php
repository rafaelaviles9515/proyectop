@extends('base.base')

@section('title','Ver Pelicula')

@section('boostrap')
@endsection
@section('content')
		<section class="page-section bg-dark text-white">
        </section>
        <br>
        <br>
        <br>
        <div class="container-sm">
			<div class="card">
			  <div class="card-body">
			    <h2 class="card-title">Pelicula: {{$pelicula->titulo}} </h2>
			    <p class="card-text">Cantidad disponible: {{$pelicula->cantidad}},Compra: ${{$pelicula->saldo_compra}},Alquiler: $ {{$pelicula->saldo_alquiler}}</p>
			  </div>
			  <div class="card-body">
			  	<h6 class="card-title">Disponibilidad: {{$pelicula->estado_nombre}},
						    	Categoria: {{$pelicula->categoria_nombre}}</h6>
				<p class="card-text"><small class="text-muted">Año: {{$pelicula->ano}}</small></p>
			  </div>
			</div>
			
			<br>
			<a type="button" class="btn btn-primary" href="{{ route('pelicula.index') }}">Regresar</a>
        </div>
@endsection
@section('finalboostrap')
@endsection
