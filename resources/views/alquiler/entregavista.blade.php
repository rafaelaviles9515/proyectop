@extends('base.base')

@section('title','Entregar Alquiler')

@section('boostrap')
@endsection
@section('content')
		<section class="page-section bg-dark text-white">
        </section>
        <br>
        <br>
        <div align="center" class="container-sm">
			<h1>¿Desea entregar la pelicula {{$pelicula->titulo}}?</h1>
			<h3>Pelicula tiene un monto de alquiler $: {{$pelicula->saldo_alquiler}}</h3>
			<h3>Aviso: {{$mensaje}}</h3>
			
			<a type="button" class="btn btn-success" href="{{ route('alquiler.entrega',$alquiler->id) }}">Si</a>
			<a type="button" class="btn btn-primary" href="{{ route('alquiler.index') }}">Cancelar</a>

		</div>
        
@endsection
@section('finalboostrap')
@endsection