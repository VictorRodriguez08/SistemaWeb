<?php

namespace sistemaWeb\Http\Controllers;

use Illuminate\Http\Request;

use sistemaWeb\Http\Requests;
use sistemaWeb\User;
use sistemaWeb\Log;
use Illuminate\Support\Facades\Redirect;
use sistemaWeb\Http\Requests\UsuarioFormRequest;
use DB;

class UsuarioController extends Controller
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
            $usuarios=DB::table('users')->where('name','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(5);
            return view('administracion.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query]);
        } 	
    }

    public function show($id)
    {
        $usuarios=User::find($id);
        return view('administracion.usuario.show',["usuarios"=>$usuarios]);
    }



    public function buscar($criterio=""){
        return User::buscar($criterio);
    }

    public function create()
    {
    	return view("administracion.usuario.create");
    }

    public function store(UsuarioFormRequest $request)
    {
    	$usuario=new User;
    	$usuario->name=$request->get('name');
    	$usuario->apellidos=$request->get('apellidos');
    	$usuario->email=$request->get('email');
    	$usuario->password=bcrypt($request->get('password'));
    	$usuario->direccion=$request->get('direccion');
    	$usuario->titulo=$request->get('titulo');
    	$usuario->otros_estudios=$request->get('otros_estudios');
    	$usuario->fecha_nac=$request->get('fecha_nac');
    	$usuario->dui=$request->get('dui');
    	$usuario->telefonos=$request->get('telefonos');
    	$usuario->otros_email=$request->get('otros_email');
    	$usuario->save();

    	//Enviar notificacion al administrador
        $emailController = new MailController();
        $emailController->email($usuario->id);

        Log::agregar_log('tabla Usuario',Auth()->user()->id, 'Usuario creado con id: '.$usuario->id);

    	return Redirect::to('administracion/usuario');
    }

    public function edit($id)
    {
    	return view("administracion.usuario.edit",["usuario"=>User::findOrFail($id)]);
    }

    public function update(UsuarioFormRequest $request ,$id)
    {
    	$usuario=User::findOrFail($id);
    	$usuario->name=$request->get('name');
    	$usuario->apellidos=$request->get('apellidos');
    	$usuario->email=$request->get('email');
    	$usuario->password=bcrypt($request->get('password'));
    	$usuario->direccion=$request->get('direccion');
    	$usuario->titulo=$request->get('titulo');
    	$usuario->otros_estudios=$request->get('otros_estudios');
    	$usuario->fecha_nac=$request->get('fecha_nac');
    	$usuario->dui=$request->get('dui');
    	$usuario->telefonos=$request->get('telefonos');
    	$usuario->otros_email=$request->get('otros_email');
    	$usuario->update();

        Log::agregar_log('tabla Usuario',Auth()->user()->id, 'Usuario modificado con id: '.$usuario->id);

    	return Redirect::to('administracion/usuario');

    }

    public function destroy($id)
    {
    	$usuario =DB::table('users')->where('id', '=' , $id)->delete();

    	Log::agregar_log('tabla Usuario',Auth()->user()->id, 'Usuario eliminado con id: ' .$usuario->id);
    	return Redirect::to('administracion/usuario');

    }

    public function GetUsuarios($id){
        $usuario = User::find($id);
        
        $nombres_ape[] = array('nombre'=>$usuario->name." ". $usuario->user->apellidos);
        return $nombre_ape;
    }
}
