<?php

namespace sistemaWeb\Http\Controllers;

use Illuminate\Http\Request;

use sistemaWeb\Http\Requests;
use sistemaWeb\Log;
use sistemaWeb\User;

use Illuminate\Support\Facades\Redirect;


use sistemaWeb\Http\Requests\UsuarioFormRequest;
use sistemaWeb\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;



use DB;


class LogController extends Controller
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
            $query1=trim($request->get('searchText1'));
            $logs=DB::table('log as l')
            ->join('users as u','l.id_user','=','u.id')
            ->select('l.id','l.nombre_tabla','u.name as user_n','u.apellidos as user_a','u.email as email','l.accion_realizada','l.updated_at','l.created_at')

            ->where ('l.created_at','LIKE','%'.$query.'%')
            ->orwhere(DB::raw('CONCAT(u.name," ",u.apellidos)'),'LIKE',"%".$query."%" )
            ->orwhere('u.name','LIKE','%'.$query.'%')
            ->orwhere('u.apellidos','LIKE','%'.$query.'%')
            ->orwhere ('l.created_at','LIKE','%'.$query.'%')
            ->orwhere('l.updated_at','LIKE','%'.$query.'%')
            ->orwhere(DB::raw('CONCAT(u.name," ",u.apellidos," ",l.created_at," ",l.updated_at)'),'LIKE',"%".$query."%" )
            ->orwhere('u.email','LIKE','%'.$query.'%')
            ->orwhere(DB::raw('CONCAT(l.created_at," ",l.created_at)'),'LIKE',"%".$query."%" )
                     
            ->orderBy('id','desc')
            ->paginate(5);
            
            return view('registro.log.index',["logs"=>$logs,"searchText"=>$query,"searchText1"=>$query1]);
        } 	
    }


    public function show($id)
    {
        $logs=Log::find($id);
        
        $view=view('registro/log/show',compact('logs'));
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('logs');
    }

       public function pdf($id)
    {
      $logs = Log::all($id); 
      
        $view = PDF::loadView('registro/log/show1', compact('logs'));

        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('logs.pdf');

        
    }






}
