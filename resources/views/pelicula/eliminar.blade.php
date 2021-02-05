@extends('base.base')

@section('title','Eliminar Pelicula')

@section('boostrap')
@endsection
@section('content')
		<section class="page-section bg-dark text-white">
        </section>
        <br>
        <br>
        <div align="center" class="container-sm">
			<h1>¿Desea eliminar la pelicula {{$pelicula->titulo}}?</h1>
			
			<a type="button" class="btn btn-danger" href="{{ route('pelicula.delete',$pelicula->id) }}">Si</a>
			<a type="button" class="btn btn-primary" href="{{ route('pelicula.index') }}">Cancelar</a>

		</div>
        
@endsection
@section('finalboostrap')
@endsection