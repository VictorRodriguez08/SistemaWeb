<?php

namespace sistemaWeb\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use sistemaWeb\EstadosTesis;
use sistemaWeb\Http\Requests;
use sistemaWeb\Tesis;
use sistemaWeb\Estado;
use sistemaWeb\Log;
use sistemaWeb\Http\Requests\TesisRequest;
use sistemaWeb\Usuario_tesis;

class TesisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tesis = Tesis::obtener_todos();
        return view('principal.tesis.index',['tesis'=>$tesis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estadostesis = new EstadosTesis();

        $estados = Estado::all();
        return view('principal.tesis.create',['estados'=>$estados, 'ESTADOS_TESIS'=>$estadostesis]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TesisRequest $request)
    {
        $error = "";
        try{
            \DB::beginTransaction();

            $tesis = new Tesis();
                $tesis->titulo = $request->input('titulo');
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
            \DB::commit();
            return redirect('tesis/')->with('message', 'Tesis creada correctamente');
        }catch(\Exception $e){
            \DB::rollback();
        }

        return redirect('tesis/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TesisRequest $request, $id)
    {
        $tesis = Tesis::find($id);
        $tesis->titulo = $request->input('titulo');
        $tesis->estado_id = $request->input('estado_id');
        $tesis->fecha_ini = date('Y-m-d', strtotime( $request->input('fecha_ini')));
        $tesis->fecha_fin =  $request->input('fecha_fin') != null ? date('Y-m-d', strtotime($request->input('fecha_fin'))) : null;

        try{
            \DB::beginTransaction();

            $tesis->save();

            Log::agregar_log('tabla Tesis',Auth()->user()->id, 'Tesis actualizada con id: '.$tesis->id);
            Usuario_tesis::eliminar_por_tesis($id);



            foreach ($request->input('usuario_id') as $usuario_id) {
                $usuario = new Usuario_tesis();
                $usuario->user_id = explode('_',$usuario_id)[0];
                $usuario->rol = explode('_',$usuario_id)[1];
                $usuario->tesis_id = $tesis->id;

                $usuario->save();

                Log::agregar_log('tabla usuarioTesis',Auth()->user()->id, 'UsuarioTesis creado con id: '.$usuario->id);
            }

            \DB::commit();
            return redirect('tesis/')->with('message', 'Tesis actualizada correctamente');
        }catch(\Exception $e){
            \DB::rollback();
        }
        $estados = Estado::all();
        return view('principal.tesis.editar',['estados'=>$estados, 'tesis'=>$tesis]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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
}
