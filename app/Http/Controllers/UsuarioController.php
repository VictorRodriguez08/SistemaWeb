<?php

namespace sistemaWeb\Http\Controllers;

use Illuminate\Http\Request;

use sistemaWeb\Http\Requests;
use sistemaWeb\Role;
use sistemaWeb\RoleUser;
use sistemaWeb\User;
use sistemaWeb\Log;
use Illuminate\Support\Facades\Redirect;
use sistemaWeb\Http\Requests\UsuarioFormRequest;
use DB;
use Gate;

class UsuarioController extends Controller
{
    private $operaciones_crud;
    private $menus_disponibles;

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
        if (Gate::allows('listar-seguridad')) {
           if ($request)
            {
                $query=trim($request->get('searchText'));

                $usuarios= User::where('name','LIKE','%'.$query.'%')
                    ->orderBy('id','desc')
                    ->paginate(7);

                return view('administracion.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query]);
            } 
        }
            return redirect('home');
         	
    }

    public function show($id)
    {
        if (Gate::allows('listar-seguridad')) {
        $usuarios=User::find($id);
        return view('administracion.usuario.show',["usuarios"=>$usuarios]);
        }
            return redirect('home');
    }



    public function buscar($tipo, $criterio="", $opcionBusqueda=""){
        return User::buscar($criterio,$opcionBusqueda, $tipo);
    }

    public function create()
    {
        //if (Gate::allows('crear-seguridad')) {
            # code...
            return view("administracion.usuario.create");
        //}
        //return redirect('home');
    	
    }

    public function store(UsuarioFormRequest $request)
    {
        if (Gate::allows('crear-seguridad')) {
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

            Log::agregar_log('tabla Usuario',Auth()->user()->id, 'Usuario creado con id: '.$usuario->id);

            return Redirect::to('administracion/usuario');
                
        }
        return redirect('home');

    }

    public function edit($id)
    {
        if (Gate::allows('actualizar-seguridad')) {
            $rol = Role::all();

        	return view("administracion.usuario.edit",[
        	    "usuario"=>User::findOrFail($id),
                "roles"=>$rol
            ]);
        }
        return redirect('home');
    }

    public function update(UsuarioFormRequest $request ,$id)
    {
        if (Gate::allows('actualizar-seguridad')) {
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
            $usuario->tipo_usuario = $request->get('tipo_usuario');

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
        }

        $rol = Role::all();

        return view("administracion.usuario.edit", [
            "usuario" => $usuario,
            "roles"=>$rol,
            'excepcion'=>$excepcion
        ]);
        }
        return redirect('home');

    }

    public function destroy($id)
    {
        if (Gate::allows('eliminar-seguridad')) {
            try {
                \DB::beginTransaction();
                $usuario = DB::table('users')->where('id', '=' , $id)->delete();
                Log::agregar_log('tabla Usuario',Auth()->user()->id, 'Usuario eliminado con id: '.$id);            
                \DB::commit();

            } catch (Exception $e) {
                \DB::rollback();
            }
            return Redirect::to('administracion/usuario');
        }
        return redirect('home');
    	

    }

    public function GetUsuarios($id){
        $usuario = User::find($id);
        
        $nombres_ape[] = array('nombre'=>$usuario->name." ". $usuario->user->apellidos);
        return $nombres_ape;
    }
}
