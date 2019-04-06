<?php

namespace sistemaWeb\Http\Controllers;

use Illuminate\Http\Request;

use sistemaWeb\Http\Requests;
use sistemaWeb\AutoresCongreso;
use sistemaWeb\Log;
use sistemaWeb\User;
use sistemaWeb\Congreso;
use Illuminate\Support\Facades\Redirect;
use sistemaWeb\Http\Requests\AutoresCongresoFormRequest;
use DB;


class AutoresCongresoController extends Controller
{
    public function __construct()
    {
    	//$this->middleware('auth');

    }

    public function index(Request $request)
    {
         if ($request)
        {
            $query=trim($request->get('searchText'));
            $autores_congresos=DB::table('autores_congreso as ac')
            ->join('users as u','ac.user_id','=','u.id')
            ->join('congreso as c','ac.congreso_id','=','c.id')
            ->select('ac.id','u.name as user_n','u.apellidos as user_a','c.nombre as con','ac.carrera','ac.tema','ac.dia')
            ->where('u.name','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('principal.autores_congreso.index',["autores_congresos"=>$autores_congresos,"searchText"=>$query]);
        } 	
    }

    public function show($id)
    {
        //$usuarios=User::find($id);
        //return view('administracion.usuario.show',["usuarios"=>$usuarios]);
    }

    public function create()
    {
    	return view("principal.autores_congreso.create");
    }

    public function store(AutoresCongresoFormRequest $request)
    {
    	try {
    		\DB::beginTransaction();

    		$autores_congreso=new AutoresCongreso;
	    	$autores_congreso->user_id=$request->get('user_id');
	    	$autores_congreso->congreso_id=$request->get('congreso_id');
	    	$autores_congreso->carrera=$request->get('carrera');
	    	$autores_congreso->tema=$request->get('tema');
	    	$autores_congreso->url_archivo=$request->get('url_archivo');
	    	$autores_congreso->dia=$request->get('dia');
	    	$autores_congreso->save();

	        Log::agregar_log('tabla Autores Congreso',Auth()->user()->id, 'Autor de Congreso creado con id: '.$autores_congreso->id);

	        \DB::commit();
            return redirect('autores_congreso/')->with('message', 'Autor de congreso creado correctamente');
    		
    	} catch (Exception $e) {
    		\DB::rollback();
    		
    	}


    	return Redirect::to('autores_congreso/create');
    }

    public function edit($id)
    {
    	return view("principal.autores_congreso.edit",["autores_congreso"=>AutoresCongreso::findOrFail($id)]);
    }

    public function update(CongresoFormRequest $request ,$id)
    {
    	try {
    		\DB::beginTransaction();

    		$autores_congreso=AutoresCongreso::findOrFail($id);;
	    	$autores_congreso->user_id=$request->get('user_id');
	    	$autores_congreso->congreso_id=$request->get('congreso_id');
	    	$autores_congreso->carrera=$request->get('carrera');
	    	$autores_congreso->tema=$request->get('tema');
	    	$autores_congreso->url_archivo=$request->get('url_archivo');
	    	$autores_congreso->dia=$request->get('dia');

    		$congreso->update();

        	Log::agregar_log('tabla Autores Congreso',Auth()->user()->id, 'Autor de congreso modificado con id: '.$autores_congreso->id);

        	\DB::commit();
            return redirect('autores_congreso/')->with('message', 'Autor de congreso actualizado correctamente');
    		
    	} catch (Exception $e) {
    		\DB::rollback();
    		
    	}
    	

    	return Redirect::to('autores_congreso');

    }

    public function destroy($id)
    {
    	try {
    		\DB::beginTransaction();

	    	\DB::table('autores_congreso')->where('id', '=' , $id)->delete();

	    	Log::agregar_log('tabla Autores Congreso',Auth()->user()->id, 'Autor de congreso eliminado con id: ' .$id);
	    	\DB::commit();
    		
    	} catch (Exception $e) {
    		\DB::rollback();
    		
    	}

    	return Redirect::to('autores_congreso');

    }
}
