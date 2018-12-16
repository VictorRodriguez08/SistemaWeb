<?php

namespace sistemaWeb\Http\Controllers;

use Illuminate\Http\Request;

use sistemaWeb\Http\Requests;

use sistemaWeb\Rol;
use Illuminate\Support\Facades\Redirect;
use sistemaWeb\Http\Request\RolRequest;
use DB;


class RolController extends Controller
{
    public function __contruct()
    {

    }

    public function index(Request $request)
    {
    	if ($request) {
    		$query=trim($request->get('searchText'));
    		$roles=DB::table('roles')->where('rol','LIKE','%'.$query.'%')
            ->paginate(7);
    		return view('administracion.rol.index',["roles"=>$roles,"searchText"=>$query]);
    	}
    }

    public function create()
    {
    	return view("administracion.rol.create");
    }

    public function store(RolRequest $request)
    {
    	$rol=new Rol;
    	$rol->rol=$request->get('rol');	
    	$rol->save();
    	return Redirect::to('administracion/rol');
    }

    public function show($id)
    {
    	return view("administracion.rol.show",["rol"=>Rol::finOrFail($id)]);
    }

    public function edit($id)
    {
    	return view("administracion.rol.edit",["rol"=>Rol::finOrFail($id)]);
    }
    public function update(RolRequest $request,$id)
    {
    	$rol=Rol::findOrFail($id);
    	$rol->rol=$request->get('rol');
    	$rol->update();
    	return Redirect::to('administracion/rol');
    }
    public function destroy($id)
    {
    	
    }
}
