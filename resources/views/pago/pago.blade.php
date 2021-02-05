@extends('base.base')

@section('title','Pago Pelicula')

@section('boostrap')
@endsection
@section('content')
		<section class="page-section bg-dark text-white">
        </section>
        <br>
        <br>
        <div align="center" class="container-sm">
			<h1>¿Desea pagar la pelicula {{$pelicula->titulo}}?</h1>
			<h3>Pelicula tiene un monto de $: {{$pelicula->saldo_compra}}</h3>
			
			<a type="button" class="btn btn-success" href="{{ route('pago.pago',$pelicula->id) }}">Si</a>
			<a type="button" class="btn btn-primary" href="{{ route('pelicula.index') }}">Cancelar</a>

		</div>
        
@endsection
@section('finalboostrap')
@endsection