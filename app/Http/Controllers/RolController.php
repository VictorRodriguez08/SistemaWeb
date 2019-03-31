<?php

namespace sistemaWeb\Http\Controllers;

use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;

use DB;
use sistemaWeb\Http\Requests\RolRequest;
use Gate;

class RolController extends Controller
{
    private $operaciones_crud;
    private $menus_disponibles;

    public function __construct()
    {
        $this->operaciones_crud = config('app.operaciones_crud');
        $this->menus_disponibles = config('app.menus_disponibles');
    }

    public function index(Request $request)
    {
        if (Gate::allows('listar-seguridad')) {
            if ($request) {
                $roles = Role::all();

                return view('administracion.rol.index', ['selected'=>'seguridad'])
                    ->with('roles', $roles);
            }
        }
        return redirect('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('crear-seguridad')) {
            $rol = new Role();
            return view('administracion.rol.create',['selected'=>'seguridad',
                'operaciones_crud'=>$this->operaciones_crud,
                'menus_disponibles'=>$this->menus_disponibles])
                ->with('rol', $rol);
        }
        return redirect('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolRequest $request)
    {
        if (Gate::allows('crear-seguridad')) {
            try{
                \DB::beginTransaction();
                $rol = new Role();
                $rol->name = $request->input('rol');
                $permisos = array();
                $acciones = array();
                foreach ($this->menus_disponibles as $menu){
                    $valores = $request->input(strtolower($menu));
                    $acciones = [];
                    if($valores!=null){
                        foreach ($valores as $valor){
                            $acciones += array($valor . '-' . strtolower($menu) => true);
                        }
                        $permisos += $acciones;
                    }
                }
                $rol->permisos = json_encode($permisos);
                $rol->save();
                \DB::commit();
                return redirect('administracion/rol')->with('message', 'Rol creado correctamente');

            }catch(\Exception $e){
                \DB::rollback();
                return $e->getMessage();
            }

            $rol = new Role();
            return view('administracion.rol.create',['selected'=>'seguridad',
                'operaciones_crud'=>$this->operaciones_crud,
                'menus_disponibles'=>$this->menus_disponibles])
                ->with('rol', $rol);
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
        if (Gate::allows('actualizar-seguridad')) {
            $rol = Role::find($id);
            return view('administracion.rol.edita',['selected'=>'seguridad','operaciones_crud'=>$this->operaciones_crud,'menus_disponibles'=>$this->menus_disponibles])
                ->with('rol', $rol);
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
    public function update(RolRequest $request, $id)
    {
        if (Gate::allows('actualizar-seguridad')) {
            $rol = Role::find($id);
            try{
                \DB::beginTransaction();
                $rol->name = $request->input('rol');
                $permisos = array();
                $acciones = array();
                foreach ($this->menus_disponibles as $menu){
                    $valores = $request->input(strtolower($menu));
                    $acciones = [];
                    if($valores!=null){
                        foreach ($valores as $valor){
                            $acciones += array($valor . '-' . strtolower($menu) => true);
                        }
                        $permisos += $acciones;
                    }
                }
                $rol->permisos = json_encode($permisos);
                $rol->save();
                \DB::commit();
                return redirect('administracion/rol')->with('message', 'Rol editado correctamente');
            }catch(\Exception $e){
                \DB::rollback();
            }
            return view('administracion.rol.edit',['selected'=>'seguridad','operaciones_crud'=>$this->operaciones_crud,'menus_disponibles'=>$this->menus_disponibles])
                ->with('rol', $rol);
        }
        return redirect('home');
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

