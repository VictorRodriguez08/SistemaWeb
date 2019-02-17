<?php

namespace sistemaWeb\Http\Controllers;

use Illuminate\Http\Request;

use sistemaWeb\Http\Requests;
use sistemaWeb\Rol;
use sistemaWeb\RoleUser;
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
        $emailController->notificacion_usuario_nuevo($usuario->id);

        Log::agregar_log('tabla Usuario',$usuario->id, 'Usuario creado con id: '.$usuario->id);

    	return Redirect::to('administracion/usuario');
    }

    public function edit($id)
    {
        $rol = Rol::all();

    	return view("administracion.usuario.edit",[
    	    "usuario"=>User::findOrFail($id),
            "roles"=>$rol
        ]);
    }

    public function update(UsuarioFormRequest $request ,$id)
    {
        $usuario=User::findOrFail($id);
        $estado_anterior = $usuario->estado;
        $excepcion = "";
        try{
            \DB::beginTransaction();

            $usuario->name=$request->get('name');
            $usuario->apellidos=$request->get('apellidos');
            $usuario->email=$request->get('email');
            if($request->get('cambiarClave')){
                $usuario->password=bcrypt($request->get('password'));
            }
            $usuario->direccion = $request->get('direccion');
            $usuario->titulo = $request->get('titulo');
            $usuario->otros_estudios = $request->get('otros_estudios');
            $usuario->fecha_nac = $request->get('fecha_nac');
            $usuario->dui = $request->get('dui');
            $usuario->telefonos = $request->get('telefonos');
            $usuario->otros_email = $request->get('otros_email');
            $usuario->estado = $request->get('estado_id');

            $usuario->update();

            RoleUser::eliminar_por_usuario($id);
            $usuario_rol = new RoleUser();
            $usuario_rol->role_id = $request->get('role_id');
            $usuario_rol->user_id = $id;
            $usuario_rol->save();

            Log::agregar_log('tabla Usuario',Auth()->user()->id, 'Usuario modificado con id: '.$usuario->id);

            \DB::commit();

            //enviar el email si el usuario esta activo
            if($estado_anterior == 0 && $usuario->estado == 1){
                $emailController = new MailController();
                $emailController->notificacion_activacion_usuario($usuario->id);
            }
            return Redirect::to('administracion/usuario');
        }catch( \Exception $e){
            \DB::rollback();
            $excepcion = $e->getMessage();
            echo $excepcion;
            return 'test';
        }

        $rol = Rol::all();

        return view("administracion.usuario.edit", [
            "usuario" => $usuario,
            "roles"=>$rol,
            'excepcion'=>$excepcion
        ]);

    }

    public function destroy($id)
    {
    	$usuario = DB::table('users')->where('id', '=' , $id)->delete();

    	Log::agregar_log('tabla Usuario',Auth()->user()->id, 'Usuario eliminado con id: ' .$usuario->id);
    	return Redirect::to('administracion/usuario');

    }

    public function GetUsuarios($id){
        $usuario = User::find($id);
        
        $nombres_ape[] = array('nombre'=>$usuario->name." ". $usuario->user->apellidos);
        return $nombres_ape;
    }
}
