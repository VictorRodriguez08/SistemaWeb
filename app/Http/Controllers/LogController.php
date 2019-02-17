<?php

namespace sistemaWeb\Http\Controllers;

use Illuminate\Http\Request;

use sistemaWeb\Http\Requests;
use sistemaWeb\Log;
use sistemaWeb\User;

use Illuminate\Support\Facades\Redirect;


use sistemaWeb\Http\Requests\UsuarioFormRequest;
use sistemaWeb\Http\Controllers\Controller;
//use Barryvdh\DomPDF\Facade as PDF;
use Codedge\Fpdf\Facades\Fpdf as Fpdf;
use PDF;
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
            $rango_fechas = false;
            $query=trim($request->get('searchText'));
            preg_match('/^\d{2}\-\d{2}\-\d{4}$/', $query, $fecha_inicial);
            preg_match('/^\d{2}\-\d{2}\-\d{4}$/', $query, $fecha_final);
            
            if(count($fecha_inicial) > 0 && count($fecha_final) > 0){
                $rango_fechas = true;
            }

            $query1=trim($request->get('searchText1'));

            $logs=Log::buscar($query, $query1);
            //return $logs;

            $logs=Log::buscar($query, $query1, $rango_fechas);

            if($request->get('esPdf') == "true"){
                $pdf=PDF::loadView('registro.log.show1',array('logs' => $logs));
                return $pdf->stream('logs.pdf');
            }else{
                return view('registro.log.index',["logs"=>$logs,"searchText"=>$query,"searchText1"=>$query1]);
            }
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








}
