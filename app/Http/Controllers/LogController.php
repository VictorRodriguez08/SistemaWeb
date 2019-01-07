<?php

namespace sistemaWeb\Http\Controllers;

use Illuminate\Http\Request;

use sistemaWeb\Http\Requests;

use sistemaWeb\User;
use sistemaWeb\Log;
use Illuminate\Support\Facades\Redirect;
use sistemaWeb\Http\Requests\UsuarioFormRequest;
use DB;


class LogController extends Controller
{
        public function index(Request $request)
    {
         if ($request)
        {
            $query=trim($request->get('searchText'));
            $logs=DB::table('log as l')
            ->join('users as u','l.id_user','=','u.id')
            ->select('l.id','l.nombre_tabla','u.name as user_n','u.apellidos as user_a','u.email as email','l.accion_realizada','l.updated_at','l.created_at')
            ->where ('l.created_at','LIKE','%'.$query.'%')
            ->orwhere ('u.name','LIKE','%'.$query.'%')
            ->orwhere('l.updated_at','LIKE','%'.$query.'%')
            ->orwhere('u.name','LIKE','%'.$query.'%')
            ->orwhere('u.apellidos','LIKE','%'.$query.'%')
            ->orwhere('u.email','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(5);
            return view('registro.log.index',["logs"=>$logs,"searchText"=>$query]);
        } 	
    }

}
