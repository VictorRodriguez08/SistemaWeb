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
use Gate;

class CongresoController extends Controller
{
    public function __construct()
    {
    	//$this->middleware('auth');
        $this->operaciones_crud = config('app.operaciones_crud');
        $this->operaciones_menu = config('app.operaciones_menu');
        $this->menu_p = config('app.menu_p');
        $this->menus_disponibles = config('app.menus_disponibles');
    }

    public function index(Request $request)
    {
        if (Gate::allows('listar-congreso')) {
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
        return redirect('home');     	
    }

    public function show($id)
    {
        //$usuarios=User::find($id);
        //return view('administracion.usuario.show',["usuarios"=>$usuarios]);
    }

    public function create()
    {
        if (Gate::allows('crear-congreso')) {
    	return view("principal.congreso.create");
        }
        return redirect('home'); 
    }

    public function store(CongresoFormRequest $request)
    {
         if (Gate::allows('crear-congreso')) {   
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
        }
        return redirect('home'); 

    	//return Redirect::to('congreso/create');
    }

    public function edit($id)
    {
        if (Gate::allows('actualizar-congreso')) {
    	   return view("principal.congreso.edit",["congreso"=>Congreso::findOrFail($id)]);
        }
        return redirect('home');
    }

    public function update(CongresoFormRequest $request ,$id)
    {
        if (Gate::allows('actualizar-congreso')) {
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
        return redirect('home');

    }

    public function destroy($id)
    {
        if (Gate::allows('eliminar-congreso')) {
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
        return redirect('home');

    }
}
