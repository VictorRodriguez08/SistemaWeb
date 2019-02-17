<?php

namespace sistemaWeb\Http\Controllers;

use Illuminate\Http\Request;

use sistemaWeb\Http\Requests;

use sistemaWeb\Congreso;
use sistemaWeb\Log;
use sistemaWeb\User;
use Illuminate\Support\Facades\Redirect;
use sistemaWeb\Http\Requests\CongresoFormRequest;
use DB;

class CongresoController extends Controller
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
            $congresos=DB::table('congreso')
            ->where('nombre','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('principal.congreso.index',["congresos"=>$congresos,"searchText"=>$query]);
        } 	
    }

    public function show($id)
    {
        //$usuarios=User::find($id);
        //return view('administracion.usuario.show',["usuarios"=>$usuarios]);
    }

    public function create()
    {
    	return view("principal.congreso.create");
    }

    public function store(CongresoFormRequest $request)
    {
    	try {
    		\DB::beginTransaction();

    		$congreso=new Congreso;
	    	$congreso->nombre=$request->get('nombre');
	    	$congreso->fecha_ini=date('Y-m-d', strtotime( $request->input('fecha_ini')));
	    	$congreso->fecha_entrega=date('Y-m-d', strtotime( $request->input('fecha_entrega')));
	    	$congreso->fecha_fin=date('Y-m-d', strtotime( $request->input('fecha_fin')));
	    	$congreso->save();

	        Log::agregar_log('tabla Congreso',Auth()->user()->id, 'Congreso creado con id: '.$congreso->id);

	        \DB::commit();
            return redirect('congreso/')->with('message', 'Congreso creado correctamente');
    		
    	} catch (Exception $e) {
    		\DB::rollback();
    		
    	}


    	return Redirect::to('congreso/create');
    }

    public function edit($id)
    {
    	return view("principal.congreso.edit",["congreso"=>Congreso::findOrFail($id)]);
    }

    public function update(CongresoFormRequest $request ,$id)
    {
    	$congreso=Congreso::findOrFail($id);
		$congreso->nombre=$request->get('nombre');
    	$congreso->fecha_ini=date('Y-m-d', strtotime( $request->input('fecha_ini')));
    	$congreso->fecha_entrega=date('Y-m-d', strtotime( $request->input('fecha_entrega')));
    	$congreso->fecha_fin=date('Y-m-d', strtotime( $request->input('fecha_fin')));
    	try {
    		\DB::beginTransaction();

    		$congreso->update();

        	Log::agregar_log('tabla Congreso',Auth()->user()->id, 'Congreso modificado con id: '.$congreso->id);

        	\DB::commit();
            return redirect('congreso/')->with('message', 'Congreso actualizado correctamente');
    		
    	} catch (Exception $e) {
    		\DB::rollback();
    		
    	}
    	

    	return Redirect::to('congreso');

    }

    public function destroy($id)
    {
    	try {
    		\DB::beginTransaction();

	    	\DB::table('congreso')->where('id', '=' , $id)->delete();

	    	Log::agregar_log('tabla Congreso',Auth()->user()->id, 'Congreso eliminado con id: ' .$id);
	    	\DB::commit();
    		
    	} catch (Exception $e) {
    		\DB::rollback();
    		
    	}

    	return Redirect::to('congreso');

    }
}
