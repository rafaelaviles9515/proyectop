@extends('base.base')

@section('title','Lista de Peliculas')

@section('boostrap')
@endsection
@section('content')
		<section class="page-section bg-dark text-white">
        </section>
 <br>
 <br>
 <br>
 
<div class="container-sm">
    @if(session('status'))
    <div class="alert alert-success" role="alert">
    @include('base.session-status')
    </div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger" role="alert">
    @include('base.validation-errors')
    </div>
    @endif
    
    
 <div class="col-md-12 mx-auto my-3">
    <div class="card">
        <div class="card-header bg-info">
            <div class="row justify-content-between">
                    <h5 class="card-title  float-left" style="color: white">Películas registradas</h5>
                    @if(Auth::user()->rol_id==1)
                    <a href="{{route('pelicula.crear')}}" class="btn btn-success" ><i class="fas fa-plus"></i>
                        <span>Agregar
                            pelicula</span></a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" >Titulo</th>
                            <th scope="col" >Estreno</th>
                            <th scope="col" >Categoria</th>
                            <th scope="col" >Año</th>
                            <th scope="col" >Estado</th>
                            <th scope="col" >Alquilar</th>
                            <th scope="col" >Comprar</th>
                            @if(Auth::user()->rol_id==1)
                            <th scope="col" width="5%">Acciones</th>
                            @else
                            <th scope="col" width="5%">Acciones</th>
                            @endif  
                        </tr>
                    </thead>
                    <tbody>
                        
                        @forelse($peliculas as $pelicula)
                        <tr>
                            <td></td>
                            <td>{{$pelicula->titulo}}</td>
                            @if($pelicula->estreno==1)
                            <td><input class="form-check" class="form-check-input" type="checkbox" value="{{$pelicula->estreno}}" id="{{$pelicula->estreno}}" checked>Estreno</td>
                            @else
                            <td><input class="form-check" class="form-check-input" type="checkbox" value="{{$pelicula->estreno}}" id="{{$pelicula->estreno}}">Presentando</td>
                            @endif
                            <td>{{$pelicula->categoria_nombre}}</td>
                            <td>{{$pelicula->ano}}</td>
                            <td>{{$pelicula->estado_nombre}}</td>
                            @if($pelicula->estado_id==1)
                            <td class="text-center">
                                <a href="{{route('pago.pagovista',$pelicula->id)}}" class="btn btn-info btn-edit btn-sm"
                                data-placement="bottom" title="Alquilar"><i class='fa fa-camera-retro fa-lg' aria-hidden="true"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="{{route('pago.pagovista',$pelicula->id)}}" class="btn btn-success btn-delete btn-sm"
                                data-placement="bottom" title="Comprar"><i class='fas fa-money-bill-alt'></i></a>
                            </td>
                            @else
                            <td></td>
                            <td></td>
                            @endif 
                            @if(Auth::user()->rol_id==1)
                            <td class="text-center">
                                <a href="{{route('pelicula.edit',$pelicula->id)}}" class="btn btn-primary btn-edit btn-sm"
                                data-placement="bottom" title="Editar"><i class='fas fa-edit'></i></a>
                                <a href="{{route('pelicula.eliminar',$pelicula->id)}}"class="btn btn-danger btn-delete btn-sm"
                                data-placement="bottom" title="Eliminar"><i class='fas fa-trash'></i></a>
                            </td>
                            @else
                            <td class="text-center">
                                <a href="{{route('pelicula.see',$pelicula->id)}}" class="btn btn-warning btn-eye btn-sm"
                                data-placement="bottom" title="Ver"><i class='fas fa-eye'></i></a>
                            </td>

                            @endif                      
                        </tr>
                        @empty
							<tr>
							  <td>No hay películas</td>
							</tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('finalboostrap')
<script type="text/javascript">
    $(document).ready(function (){
   var table = $('#datatable').DataTable({ 
    "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
    "columnDefs": [    { "visible": false, "targets": 0 }  ],
    "responsive": "true"        
   });
  });

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })  
</script>
@endsection