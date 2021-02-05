<?php

namespace App\Http\Controllers;

use App\Models\MovimientoPelicula;
use App\Models\Pago;
use App\Models\Pelicula;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pagovista($id)
    {

    	$pelicula= Pelicula::findOrFail($id);

    	if ($pelicula->cantidad >0) {
    		return view('Pago.pago',compact('pelicula'));
    	} else {
    		return redirect()->route('pelicula.index')->with('status','se acabo cupo para esa pelicula');
    	}
    	 
        
    }
    public function pago($id)
    {
    	//busco la pelicula y comparo el saldo el usuario con la compra de la pelicula
    	//verifico que tenga fodos suficientes
    	$pelicula= Pelicula::findOrFail($id);
    	if (Auth::user()->saldo > $pelicula->saldo_compra) {
    		$pago= new Pago;
    		$date= Carbon::now();
	    	$pago->fecha_pago=$date->format('Y-m-d');
	    	$pago->monto=$pelicula->saldo_compra;
	    	$pago->user_id=Auth::user()->id;
	    	$pago->pelicula_id=$pelicula->id;
	    	$pago->save();

	    	$movimientoPelicula=new MovimientoPelicula;
	    	$movimientoPelicula->nombre='Compra';
	    	$movimientoPelicula->fecha_inicio=$pago->fecha_pago;
	    	$movimientoPelicula->fecha_final=$pago->fecha_pago;
	    	$movimientoPelicula->monto=$pago->monto;
	    	$movimientoPelicula->user_id=$pago->user_id;
	    	$movimientoPelicula->pelicula_id=$pago->pelicula_id;
	    	$movimientoPelicula->save();

	    	$pelicula->cantidad=$pelicula->cantidad - 1;
	    	$user=User::findOrFail(Auth::user()->id);
	    	$user->saldo=$user->saldo - $pelicula->saldo_compra;
	    	$user->save();
	    	if ($pelicula->cantidad<=0) {
	    		$pelicula->estado_id=2;
	    	}
	    	$pelicula->save();


	    	return redirect()->route('pelicula.index')->with('status','Pelicula comprada con exito');
    	} else {
    		return redirect()->route('pelicula.index')->with('status','Saldo insuficiente, no puede comprar la pelicula');
    	}
    	 
        
    }

}
