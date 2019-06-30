<?php

namespace sistemaWeb\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use sistemaWeb\ArchivosTesis;
use sistemaWeb\EstadosTesis;
use sistemaWeb\Http\Requests;
use sistemaWeb\Tesis;
use sistemaWeb\Estado;
use sistemaWeb\Log;
use sistemaWeb\Http\Requests\TesisRequest;
use sistemaWeb\Usuario_tesis;
use sistemaWeb\User;
use Gate;
use PDF;

class TesisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response


     */

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
        if (Gate::allows('listar-tesis')) {
            $query=trim($request->get('searchText'));


            //return Tesis::buscar("Tesis Prueba Sistemas hh");
            //return Tesis::find(21)->ultimo_archivo();
            if($query == null){
                $tesis = Tesis::obtener_todos();
            }else{
                $tesis = Tesis::buscar($query);
            }


            return view('principal.tesis.index',['tesis'=>$tesis,"searchText"=>$query]);
        }
        return redirect('home');
    }

    public function generar_cartas($id, $tipo){
            $tesis = Tesis::find($id);
            if($tesis != null){
                if($tipo == 3){
                    $pdf=PDF::loadView('reportes.carta_asesor',array('tesis' => $tesis));
                    return $pdf->stream('asesor.pdf');
                }else{
                    $pdf=PDF::loadView('reportes.carta_avances',array('tesis' => $tesis,'tipo'=>$tipo));
                    return $pdf->stream('carta.pdf');
                }

            }
            return false;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('crear-tesis')) {
        $estadostesis = new EstadosTesis();

        $estados = Estado::all();
        return view('principal.tesis.create',['estados'=>$estados, 'ESTADOS_TESIS'=>$estadostesis]);
         }
        return redirect('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TesisRequest $request)
    {
        if (Gate::allows('crear-tesis')) {
            $error = "";

            try{
                \DB::beginTransaction();

                    $tesis = new Tesis();
                    $tesis->titulo = $request->input('titulo');
                    $tesis->carrera = $request->input('carrera');
                    $tesis->facultad = $request->input('facultad');
                    $tesis->estado_id = $request->input('estado_id');
                    $tesis->fecha_ini = date('Y-m-d', strtotime( $request->input('fecha_ini')));
                    $tesis->fecha_fin = $request->input('fecha_fin') != null ? date('Y-m-d', strtotime($request->input('fecha_fin'))) : null;
                    $tesis->save();

                    Log::agregar_log('tabla Tesis',Auth()->user()->id, 'Tesis creada con id: '.$tesis->id);
                    foreach ($request->input('usuario_id') as $usuario_id) {
                         $usuario = new Usuario_tesis();
                        $usuario->user_id = explode('_',$usuario_id)[0];
                        $usuario->rol = explode('_',$usuario_id)[1];
                         $usuario->tesis_id = $tesis->id;

                         $usuario->save();

                        Log::agregar_log('tabla usuarioTesis',Auth()->user()->id, 'UsuarioTesis creado con id: '.$usuario->id);
                     }


                    foreach ($request->input('usuario_id') as $usuario_id) {
                        $user_id = explode('_',$usuario_id)[0];
                        $rol = explode('_',$usuario_id)[1];
                        $user = User::find($user_id);
                        $nombre_usuario = $user->name . " " . $user->apellidos;

                        $emailController = new MailController();
                        $emailController->notificacion_agregado_investigacion($user_id,$tesis->titulo,$nombre_usuario,$rol);

                        Log::agregar_log('tabla usuarioTesis',Auth()->user()->id, 'UsuarioTesis creado con id: '.$usuario->id);
                    }

                \DB::commit();
                return redirect('tesis/')->with('message', 'Tesis creada correctamente');
            }catch(\Exception $e){
                \DB::rollback();
            }

            return redirect('tesis/create');
        }
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         if (Gate::allows('listar-tesis')) {
        $tesis = Tesis::find($id);
        return view('principal.tesis.show',['tesis'=>$tesis]);
        }
        return redirect('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::allows('actualizar-tesis')) {
            $estados = Estado::all();
            $tesis = Tesis::find($id);
            $estadostesis = new EstadosTesis();

            return view('principal.tesis.editar',
                [
                    'estados'=>$estados,
                    'tesis'=>$tesis,
                    'ESTADOS_TESIS'=>$estadostesis
                ]);
        }
        return redirect('home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TesisRequest $request, $id)
    {
        if (Gate::allows('actualizar-tesis')) {
            $tesis = Tesis::find($id);
            $tesis->titulo = $request->input('titulo');
            $tesis->carrera = $request->input('carrera');
            $tesis->facultad = $request->input('facultad');
            $tesis->estado_id = $request->input('estado_id');
            $tesis->fecha_ini = date('Y-m-d', strtotime( $request->input('fecha_ini')));
            $tesis->fecha_fin =  $request->input('fecha_fin') != null ? date('Y-m-d', strtotime($request->input('fecha_fin'))) : null;

            $lista_usuario_notificados = array();

            $excepcion = "";
            try{
                \DB::beginTransaction();

                $tesis->save();

                Log::agregar_log('tabla Tesis',Auth()->user()->id, 'Tesis actualizada con id: '.$tesis->id);
                $lista_usuario_notificados = $tesis->usuario_tesis;

                Usuario_tesis::eliminar_por_tesis($id);

                foreach ($request->input('usuario_id') as $usuario_id) {
                    $usuario = new Usuario_tesis();
                    $usuario->user_id = explode('_',$usuario_id)[0];
                    $usuario->rol = explode('_',$usuario_id)[1];
                    $usuario->cargo = explode('_',$usuario_id)[2];
                    $usuario->tesis_id = $tesis->id;

                    $usuario->save();

                    Log::agregar_log('tabla usuarioTesis',Auth()->user()->id, 'UsuarioTesis creado con id: '.$usuario->id);
                }

                foreach ($request->input('usuario_id') as $usuario_id) {
                    $user_id = explode('_',$usuario_id)[0];
                    if(!$this->usuario_notificacion_enviada($lista_usuario_notificados, $user_id)){
                        $rol = explode('_',$usuario_id)[1];
                        $user = User::find($user_id);
                        $nombre_usuario = $user->name . " " . $user->apellidos;

                        $emailController = new MailController();
                        $emailController->notificacion_agregado_investigacion($user_id,$tesis->titulo,$nombre_usuario,$rol);
                    }
                }

                Log::agregar_log('tabla usuarioTesis',Auth()->user()->id, 'UsuarioTesis creado con id: '.$usuario->id);

                \DB::commit();

                return redirect('tesis/')->with('message', 'Tesis actualizada correctamente');
            }catch(\Exception $e){
                \DB::rollback();
                $excepcion = $e->getMessage();
                echo $excepcion;
                return;
            }

            $estados = Estado::all();
            return view('principal.tesis.editar',[
                'estados'=>$estados,
                'tesis'=>$tesis,
                'ESTADOS_TESIS'=>new EstadosTesis(),
                'excepcion'=>$excepcion
            ]);
        }
        return redirect('home');
    }

    private function usuario_notificacion_enviada($lista, $id_usuario){
        foreach ($lista as $item) {
            if($item->user_id == $id_usuario){
                return true;
            }
        }
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('eliminar-tesis')) {
            try{
                \DB::beginTransaction();
                    Usuario_tesis::eliminar_por_tesis($id);
                    \DB::table('tesis')->where('id', '=' , $id)->delete();

                    Log::agregar_log('tabla Tesis',Auth()->user()->id, 'Tesis eliminado con id: '.$id);
                \DB::commit();
                return redirect('tesis/')->with('message', 'Tesis eliminada correctamente');
            }catch(\Exception $e){
                \DB::rollback();
            }
            return Redirect::to('tesis');
        }
        return redirect('home');
    }

    public function GetUsuariosTesis($id){
        $tesis = Tesis::find($id);
        $nombre_usuarios = [];
        foreach ($tesis->usuario_tesis as $usuario){
            $rol = "";
            switch($usuario->rol){
                case 1:
                    $rol = "Alumno";
                    break;
                case 2:
                    $rol = "Asesor";
                    break;
                case 3:
                    $rol = "Jurado";
                    break;
            }
            $nombre_usuarios[] = array(
                'nombre'=>$usuario->user->name . " " . $usuario->user->apellidos,
                'rol'=>$rol
            );
        }
        return $nombre_usuarios;
    }

    public function SubirArchivo(Request $request){
        $file = $request->file('archivo');
        $id = $request->input('tesis_id');
        $tipo_archivo = $request->input('tipo_archivo');
        $destinationPath = 'uploads/tesis/archivos/' . $id;
        $archivoTesis = new ArchivosTesis();
        $archivoTesis->nombre_archivo = $file->getClientOriginalName();
        $archivoTesis->tesis_id = $id;
        $archivoTesis->tipo = $tipo_archivo;
        $archivoTesis->save();

        $file->move($destinationPath,$file->getClientOriginalName());
        return json_encode(array('id'=>$archivoTesis->id));
    }

    public function EliminarArchivo($id_tesis, $id){
        $nombre_archivo = ArchivosTesis::find($id)->nombre_archivo;
        try{
            \DB::beginTransaction();

            \DB::table('archivos_tesis')->where('id', '=' , $id)->delete();

            Log::agregar_log('tabla Archivos Tesis',Auth()->user()->id, 'Archivo eliminado con id: '.$id);
            \DB::commit();
            unlink('uploads/tesis/archivos/'. $id_tesis . "/" . $nombre_archivo);
            return 'ok';
        }catch(\Exception $e){
            \DB::rollback();
        }
        return 'error';
    }
}
