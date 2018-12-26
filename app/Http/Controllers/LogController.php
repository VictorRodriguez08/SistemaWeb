<?php

namespace sistemaWeb\Http\Controllers;

use Illuminate\Http\Request;

use sistemaWeb\Http\Requests;
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
            $usuarios=DB::table('log')->where('created_at','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(5);
            return view('registro.log.index',["usuarios"=>$usuarios,"searchText"=>$query]);
        } 	
    }

}
