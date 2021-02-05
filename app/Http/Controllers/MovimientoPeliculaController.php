<?php

namespace App\Http\Controllers;

use App\Exports\MovimientoExport;
use App\Models\MovimientoPelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MovimientoPeliculaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    	$movimientoPelicula= DB::table('movimiento_peliculas')
                            ->join('users', 'movimiento_peliculas.user_id', '=', 'users.id')
                            ->join('peliculas', 'movimiento_peliculas.pelicula_id', '=', 'peliculas.id')
                            ->select('movimiento_peliculas.*', 'users.name as nombre_cliente','peliculas.titulo as nombre_pelicula')
                            ->where([
                                ['movimiento_peliculas.id','!=',0],
                            ])
                            
                            ->get();
    	return view('movimientopelicula.index',compact('movimientoPelicula'));
        
    }

    public function export() 
    {
        return Excel::download(new MovimientoExport, 'Movimientos_de_Pelicula.xlsx');
    }


}
