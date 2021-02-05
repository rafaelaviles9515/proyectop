@extends('base.base')

@section('title','Movimientos de Pelicula')

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
                    <h5 class="card-title  float-left" style="color: white">Movimientos de Peliculas</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" >Movimiento</th>
                            <th scope="col" >Fecha de inicio</th>
                            <th scope="col" >Fecha final</th>
                            <th scope="col" >Pelicula</th>
                            <th scope="col" >Cliente</th> 
                            <th scope="col" >Monto</th> 
                        </tr>
                    </thead>
                    <tbody>
                        
                        @forelse($movimientoPelicula as $movimiento)
                        <tr>
                            <td></td>
                            <td>{{$movimiento->nombre}}</td>
                            <td>{{$movimiento->fecha_inicio}}</td>
                            <td>{{$movimiento->fecha_final}}</td>
                            <td>{{$movimiento->nombre_pelicula}}</td>
                            <td>{{$movimiento->nombre_cliente}}</td>
                            <td>{{$movimiento->monto}}</td>
                        @empty
                            <tr>
                              <td>No hay movimientos</td>
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