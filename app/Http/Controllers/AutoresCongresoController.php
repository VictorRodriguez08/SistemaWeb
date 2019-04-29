<?php

namespace sistemaWeb\Http\Controllers;

use Illuminate\Http\Request;

use phpDocumentor\Reflection\Types\Object_;
use sistemaWeb\ArchivosCongreso;
use sistemaWeb\Http\Requests;
use sistemaWeb\AutoresCongreso;
use sistemaWeb\Log;
use sistemaWeb\User;
use sistemaWeb\Congreso;
use Illuminate\Support\Facades\Redirect;
use sistemaWeb\Http\Requests\AutoresCongresoFormRequest;
use DB;
use Input;

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
            $autores_congresos=AutoresCongreso::groupBy('tema')->orderBy('id','desc')
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
        $users = User::all();
        $congresos = Congreso::all();
    	return view("principal.autores_congreso.create",['users'=>$users,'congresos'=>$congresos]);
    }

    public function store(AutoresCongresoFormRequest $request)
    {
    	try {
    		\DB::beginTransaction();

                $usuarios = $request->get('usuario_id');


                $id = 0;
                foreach($usuarios as $u){

                    $autores_congreso=new AutoresCongreso;

                    $autores_congreso->user_id= $u;
                    $autores_congreso->congreso_id = $request->get('congreso_id');
                    $autores_congreso->carrera = $request->get('carrera');
                    $autores_congreso->tema = $request->get('tema');
                    $autores_congreso->dia = $request->get('dia');
                    $autores_congreso->save();

                    if($id==0){
                        $id = $autores_congreso->congreso_id;
                    }
                }

                $file = $request->file('url_archivo');
                $destinationPath = 'uploads/congreso/archivos/' . $id;
                $archivoCongreso = new ArchivosCongreso();
                $archivoCongreso->nombre_archivo = $file->getClientOriginalName();
                $archivoCongreso->congreso_id = $id;
                $archivoCongreso->save();
                $file->move($destinationPath,$file->getClientOriginalName());

                Log::agregar_log('tabla Autores Congreso',Auth()->user()->id, 'Autor de Congreso creado con id: '.$autores_congreso->id);

	        \DB::commit();
            return redirect('autores_congreso/')->with('message', 'Autor de congreso creado correctamente');
    		
    	} catch (Exception $e) {
    		\DB::rollback();
    		
    	}


    	
    }

    public function edit($id)
    {
        $users = User::all();
        $congresos = Congreso::all();

        $autores = $this->GetAutoresCongreso($id);
        $autor_congreso = AutoresCongreso::find($id);

    	return view("principal.autores_congreso.edit",['users'=>$users,'congresos'=>$congresos,"autores_congreso"=>$autores, 'autor_congreso'=>$autor_congreso]);
    }

    public function update(AutoresCongresoFormRequest $request ,$id)
    {
    	try {
    		\DB::beginTransaction();

            $usuarios = $request->get('usuario_id');

            //Eliminar los usuario congreso anteriores
            $usuarios_anteriores = $this->GetAutoresCongreso($id);

            foreach ($usuarios_anteriores as $usuario){
                $autor = AutoresCongreso::find($usuario['id_autor']);

                if($autor != null)
                    $autor->delete();
            }

            $file = $request->file('url_archivo');

            if($file != null){
                $destinationPath = 'uploads/congreso/archivos/' . $usuarios_anteriores[0]['congreso_id'];
                $archivoCongreso = new ArchivosCongreso();
                $archivoCongreso->nombre_archivo = $file->getClientOriginalName();
                $archivoCongreso->congreso_id = $usuarios_anteriores[0]['congreso_id'];
                $archivoCongreso->save();
                $file->move($destinationPath,$file->getClientOriginalName());

                $nombre_archivo = $archivoCongreso->nombre_archivo;
            }

            foreach($usuarios as $u){

                if($id==0){
                    $id = $u;
                }
                $autores_congreso=new AutoresCongreso;

                $autores_congreso->user_id= $u;
                $autores_congreso->congreso_id = $request->get('congreso_id');
                $autores_congreso->carrera = $request->get('carrera');
                $autores_congreso->tema = $request->get('tema');

                $autores_congreso->dia = $request->get('dia');
                $autores_congreso->save();
            }

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

    		$usuarios = $this->GetAutoresCongreso($id);

    		if(count($usuarios) > 0){
                foreach ($usuarios as $usuario){
                    \DB::table('autores_congreso')->where('id', '=' , $usuario['id_autor'])->delete();
                }

                Log::agregar_log('tabla Autores Congreso',Auth()->user()->id, 'Autor de congreso eliminado con id: ' .$id);
            }

	    	\DB::commit();
    		
    	} catch (Exception $e) {
    		\DB::rollback();
    	}

    	return Redirect::to('autores_congreso');

    }

    public function uploading(){
        $file=Input::file('archivo');
        $aleatorio=str_random(6);
        $nombre= $aleatorio.'-'.$file->getClientOriginalName();
        $file->move('uploads',$nombre);
    }

    public function GetArchivos($id){
        $autor_congreso = AutoresCongreso::find($id);

        $datos = array();

        if($autor_congreso != null){

            foreach ($autor_congreso as $autor){
                $datos[] = array(
                    'id'=>$id,
                    'url_archivo'=>$autor->url_archivo
                );
            }

            return $datos;
        }

        return null;
    }

    public function GetAutoresCongreso($id){
        $autor_congreso = AutoresCongreso::find($id);

        $datos = array();

        if($autor_congreso != null){
            $autores = AutoresCongreso::where('congreso_id','=',$autor_congreso->congreso_id)
                ->where('tema','=',$autor_congreso->tema)
                ->where('carrera','=',$autor_congreso->carrera)->get();

            foreach ($autores as $autor){
                $datos[] = array(
                    'id_autor'=>$autor->id,
                    'id'=>$autor->user->id,
                    'congreso_id'=>$autor->congreso_id,
                    'nombre'=>$autor->user->name . " " . $autor->user->apellidos
                );
            }

            return $datos;
        }

        return null;

    }
}
