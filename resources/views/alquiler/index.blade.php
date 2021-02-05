@extends('base.base')

@section('title','Detalle Alquiler')

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
                    <h5 class="card-title  float-left" style="color: white">Detalle Alquiler</h5>
                    <a href="{{route('alquiler.excel')}}" class="btn btn-success" ><i class="fas fa-plus"></i>
                    <span>Generar Excel</span></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" >Fecha Reserva</th>
                            <th scope="col" >Fecha Entrega</th>
                            <th scope="col" >Monto</th>
                            <th scope="col" >Pelicula</th>
                            <th scope="col" >Usuario</th>
                            <th scope="col" >Estado</th>
                            <th scope="col" width="5%">Entregar</th>  
                        </tr>
                    </thead>
                    <tbody>
                        
                        @forelse($alquileres as $alquiler)
                        <tr>
                            <td></td>
                            <td>{{$alquiler->fecha_reserva}}</td>
                            <td>{{$alquiler->fecha_entrega}}</td>
                            <td>{{$alquiler->monto}}</td>
                            <td>{{$alquiler->pelicula_nombre}}</td>
                            <td>{{$alquiler->usuario_nombre}}</td>
                            <td>{{$alquiler->estado_nombre}}</td>
                            @if($alquiler->estado_id==3)
                            <td class="text-center">
                                <a href="{{route('alquiler.entregavista',$alquiler->id)}}" class="btn btn-primary btn-edit btn-sm"
                                data-placement="bottom" title="Entregar"><i class='fas fa-edit'></i></a>
                            </td>
                            @else
                                  <td></td>
                            @endif                      
                        </tr>
                        @empty
							<tr>
							  <td>No detalles de alquiler</td>
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