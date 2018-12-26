<?php

namespace sistemaWeb\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use sistemaWeb\Http\Requests;
use sistemaWeb\Tesis;
use sistemaWeb\Estado;
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
        $tesis = Tesis::all();
        return view('principal.tesis.index',['tesis'=>$tesis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::all();
        return view('principal.tesis.create',['estados'=>$estados]);
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
                $tesis->fecha_fin =  date('Y-m-d', strtotime($request->input('fecha_fin')));
                $tesis->save();

                foreach ($request->input('usuario_id') as $usuario_id) {
                     $usuario = new Usuario_tesis();
                     $usuario->user_id = $usuario_id;
                     $usuario->tesis_id = $tesis->id;
                     $usuario->save();
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
        return view('principal.tesis.editar',['estados'=>$estados, 'tesis'=>$tesis]);
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
        $tesis->fecha_fin =  date('Y-m-d', strtotime($request->input('fecha_fin')));

        try{
            \DB::beginTransaction();

            $tesis->save();

            Usuario_tesis::eliminar_por_tesis($id);

            foreach ($request->input('usuario_id') as $usuario_id) {
                $usuario = new Usuario_tesis();
                $usuario->user_id = $usuario_id;
                $usuario->tesis_id = $tesis->id;
                $usuario->save();
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
        //
    }
}
