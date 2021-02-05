@extends('base.base')

@section('title','Alquiler Pelicula')

@section('boostrap')
@endsection
@section('content')
		<section class="page-section bg-dark text-white">
        </section>
        <br>
        <br>
        <div align="center" class="container-sm">
			<h1>¿Desea alquilar la pelicula {{$pelicula->titulo}}?</h1>
			<h3>Pelicula tiene un monto de alquiler $: {{$pelicula->saldo_alquiler}}</h3>
			<h3>Tendra tres dias, despues de realizar su pago, para entregar pelicula</h3>
			
			<a type="button" class="btn btn-success" href="{{ route('alquiler.pago',$pelicula->id) }}">Si</a>
			<a type="button" class="btn btn-primary" href="{{ route('pelicula.index') }}">Cancelar</a>

		</div>
        
@endsection
@section('finalboostrap')
@endsection