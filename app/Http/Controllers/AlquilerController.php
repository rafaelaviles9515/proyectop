<?php

namespace App\Http\Controllers;

use App\Exports\AlquilerExport;
use App\Models\Alquiler;
use App\Models\MovimientoPelicula;
use App\Models\Pelicula;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AlquilerController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function alquilervista($id)
    {
    	$pelicula= Pelicula::findOrFail($id);

    	if ($pelicula->cantidad >0) {
    		return view('alquiler.alquiler',compact('pelicula'));
    	} else {
    		return redirect()->route('pelicula.index')->with('status','se acabo cupo para esa pelicula');
    	}
    	   
    }
    public function pago($id)
    {
    	//busco la pelicula y comparo el saldo el usuario con la compra de la pelicula
    	//verifico que tenga fodos suficientes
    	$pelicula= Pelicula::findOrFail($id);
    	if (Auth::user()->saldo >= $pelicula->saldo_alquiler) {
    		$pago= new Alquiler;
    		$date= Carbon::now();
	    	$pago->fecha_reserva=$date->format('Y-m-d');
	    	$pago->fecha_entrega=$date->addDay(3)->format('Y-m-d');
	    	$pago->monto=$pelicula->saldo_alquiler;
	    	$pago->user_id=Auth::user()->id;
	    	$pago->pelicula_id=$pelicula->id;
	    	$pago->estado_id=3;
	    	$pago->save();


	    	$pelicula->cantidad=$pelicula->cantidad - 1;
	    	$user=User::findOrFail(Auth::user()->id);
	    	$user->saldo=$user->saldo - $pelicula->saldo_alquiler;
	    	$user->save();
	    	if ($pelicula->cantidad<=0) {
	    		$pelicula->estado_id=2;
	    	}
	    	$pelicula->save();


	    	return redirect()->route('pelicula.index')->with('status','Pelicula Alquilada con exito');
    	} else {
    		return redirect()->route('pelicula.index')->with('status','Saldo insuficiente, no puede comprar la pelicula');
    	}
    	   
    }

    public function index()
    {
    	
    	if (Auth::user()->rol_id==1) {
    		$alquileres = DB::table('alquilers')
                            ->join('estados', 'alquilers.estado_id', '=', 'estados.id')
                            ->join('peliculas', 'alquilers.pelicula_id', '=', 'peliculas.id')
                            ->join('users', 'alquilers.user_id', '=', 'users.id')
                            ->select('alquilers.*', 'estados.nombre as estado_nombre','peliculas.titulo as pelicula_nombre','users.name as usuario_nombre')
                            ->where([
                                ['alquilers.id','!=',0],
                            ])
                            
                            ->get();
    		return view('alquiler.index',compact('alquileres'));
    	} else {
    		$alquileres = DB::table('alquilers')
                            ->join('estados', 'alquilers.estado_id', '=', 'estados.id')
                            ->join('peliculas', 'alquilers.pelicula_id', '=', 'peliculas.id')
                            ->join('users', 'alquilers.user_id', '=', 'users.id')
                            ->select('alquilers.*', 'estados.nombre as estado_nombre','peliculas.titulo as pelicula_nombre','users.name as usuario_nombre')
                            ->where([
                                ['alquilers.user_id','=',Auth::user()->id],
                                ['alquilers.estado_id','=',3],
                            ])
                            
                            ->get();
    		return view('alquiler.index',compact('alquileres'));
    	}
    	   
    }

    public function entregavista($id)
    {
    	$date= Carbon::now();
    	$fechaentrega=$date->format('Y-m-d');
    	$alquiler= Alquiler::findOrFail($id);
    	$pelicula=Pelicula::findOrFail($alquiler->pelicula_id);
    	$mensaje='';
    	if ($fechaentrega<=$alquiler->fecha_entrega) {
    		$mensaje='No pagara multa';
    	} else {
    		$mensaje='Pagara multa por mora';
    	}
    	

    	return view('alquiler.entregavista',compact('alquiler','pelicula','mensaje'));
    	   
    }

    public function entrega($id)
    {
    	//busco la pelicula y comparo el saldo el usuario con la compra de la pelicula
    	//verifico que tenga fodos suficientes
    	$alquiler= Alquiler::findOrFail($id);
    	$pelicula= Pelicula::findOrFail($alquiler->pelicula_id);

		$alquiler->estado_id=4;
		$alquiler->save();


    	$movimientoPelicula=new MovimientoPelicula;
    	$movimientoPelicula->nombre='Alquiler';
    	$movimientoPelicula->fecha_inicio=$alquiler->fecha_reserva;
    	$movimientoPelicula->fecha_final=$alquiler->fecha_entrega;
    	
    	$movimientoPelicula->user_id=$alquiler->user_id;
    	$movimientoPelicula->pelicula_id=$alquiler->pelicula_id;
    	

    	$pelicula->cantidad=$pelicula->cantidad + 1;
    	$user=User::findOrFail($alquiler->user_id);
    	//si paga mora tendria que ir aqui
    	$date= Carbon::now();
    	$fechaentrega=$date->format('Y-m-d');

    	if ($fechaentrega<=$alquiler->fecha_entrega) {
    		$user->saldo=$user->saldo;
    		$movimientoPelicula->monto=$alquiler->monto;
    	} else {
    		$user->saldo=$user->saldo - 2;
    		$movimientoPelicula->monto=$alquiler->monto+2;
    	}
    	$user->save();
    	$movimientoPelicula->save();
    	if ($pelicula->cantidad<=0) {
    		$pelicula->estado_id=2;
    	}
    	$pelicula->save();

	    return redirect()->route('alquiler.index')->with('status','Pelicula alquilada se regreso con exito');
    	 
        
    }

    public function export() 
    {
        return Excel::download(new AlquilerExport, 'Alquileres_de_Pelicula.xlsx');
    }


}
