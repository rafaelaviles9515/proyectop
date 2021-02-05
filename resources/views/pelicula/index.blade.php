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
    @include('base.session-status')
    @include('base.validation-errors')
 <div class="col-md-12 mx-auto my-3">
    <div class="card">
        <div class="card-header bg-info">
            <div class="row justify-content-between">
                    <h5 class="card-title  float-left" style="color: white">Películas registradas</h5>
                    <a href="{{route('pelicula.crear')}}" class="btn btn-success" ><i class="fas fa-plus"></i>
                        <span>Agregar
                            pelicula</span></a>
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
                            <th scope="col" width="5%">Acciones</th>  
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
                            <td class="text-center">
                                <a href="{{route('pelicula.edit',$pelicula->id)}}" class="btn btn-primary btn-edit btn-sm"
                                data-placement="bottom" title="Editar"><i class='fas fa-edit'></i></a>
                                <a href="{{route('pelicula.eliminar',$pelicula->id)}}"class="btn btn-danger btn-delete btn-sm"
                                data-placement="bottom" title="Eliminar"><i class='fas fa-trash'></i></a>
                            </td>                      
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