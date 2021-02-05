<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeliculaRequest;
use App\Models\Categoria;
use App\Models\Estado;
use App\Models\Pelicula;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeliculaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index()
    {
    	//se uso join, para poder unir tablas que tienen llave foranea y poder traer dichas tablas y usar dicha informacion
        //$peliculas= Pelicula::all();
        $peliculas = DB::table('peliculas')
                            ->join('estados', 'peliculas.estado_id', '=', 'estados.id')
                            ->join('categorias', 'peliculas.categoria_id', '=', 'categorias.id')
                            ->select('peliculas.*', 'estados.nombre as estado_nombre','categorias.nombre as categoria_nombre')
                            ->where([
                                ['peliculas.id','!=',0],
                            ])
                            ->groupBy('peliculas.id')
                            ->get();
                            
        return view('pelicula.index',compact('peliculas'));
    }

     public function create()
    {
    	$categorias= Categoria::all();
        return view('pelicula.create',compact('categorias'));
            
    }

    public function store(PeliculaRequest $request)
    {
        //se crea una pelicula
        $pelicula= new Pelicula;
        $pelicula->titulo=$request->titulo;
        //verifico si el checkbox fue seleccionado o no 
        if ($request->estreno==true) {
        	$pelicula->estreno=1;
        } else {
        	$pelicula->estreno=0;
        }
        
        $pelicula->ano=$request->ano;
        $pelicula->cantidad=$request->cantidad;
        $pelicula->saldo_compra=$request->saldo_compra;
        $pelicula->saldo_alquiler=$request->saldo_alquiler;
        $pelicula->categoria_id=$request->categoria_id;
        
        //se verifica si hay cantidad de pelicula y si hay se agrega disponible al estado_id de pelicula
        if ($pelicula->cantidad>0) {
        	$pelicula->estado_id=1;
        }
        else{
        	$pelicula->estado_id=2;
        }
        
        $pelicula->save();
        return redirect()->route('pelicula.index')->with('status','pelicula creada con exito');
        
    }

    public function edit($id)
    {
    	$pelicula= Pelicula::findOrFail($id);
    	$categoriaSeleccionada=Categoria::where('id',$pelicula->categoria_id)->first();
    	$categorias=Categoria::where('id','!=',$pelicula->categoria_id)->get();
        return view('pelicula.edit',compact('pelicula','categoriaSeleccionada','categorias'));
    }

    public function update(PeliculaRequest $request,$id)
    {
        $pelicula= Pelicula::findOrFail($id);
        $pelicula->titulo=$request->titulo;
        if ($request->estreno==true) {
        	$pelicula->estreno=1;
        } else {
        	$pelicula->estreno=0;
        }
        
        $pelicula->ano=$request->ano;
        $pelicula->cantidad=$request->cantidad;
        $pelicula->saldo_compra=$request->saldo_compra;
        $pelicula->saldo_alquiler=$request->saldo_alquiler;
        $pelicula->categoria_id=$request->categoria_id;
        
        //se verifica si hay cantidad de pelicula y si hay se agrega disponible al estado_id de pelicula (1=Disponible, 2=No Disponible)
        if ($pelicula->cantidad>0) {
        	$pelicula->estado_id=1;
        }
        else{
        	$pelicula->estado_id=2;
        }
        
        $pelicula->save();
        return redirect()->route('pelicula.index')->with('status','pelicula actualizada con exito');
    }
    public function vistaeliminar($id)
    {

    	$pelicula= Pelicula::findOrFail($id);
        return view('pelicula.eliminar',compact('pelicula'));
        
    }
    public function delete(Pelicula $pelicula)
    {

	    try {
	        
	        $pelicula->delete();
	        return redirect()->route('pelicula.index')->with('status','pelicula eliminado con exito');
	    } catch (QueryException $e) {
	        return redirect()->route('pelicula.index')->with('status','la pelicula tiene registros asociados, no puede eliminarla');
	        }
    }


}
