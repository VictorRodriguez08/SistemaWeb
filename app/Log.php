<?php

namespace sistemaWeb;

use Illuminate\Database\Eloquent\Model;
use DB;
class Log extends Model
{
     protected $table='log';

	 protected $primaryKey="id";   



	 protected $fillable=[
	 		'nombre_tabla',
	 		'id_user',
	 		'accion_realizada',
	 		'updated_at',
	 		'created_at',
	 ];

	 protected $guarded=[

	 ];

	 public static function buscar($query, $query1, $rango_fechas=false){
	 	if($rango_fechas){
	 		return self::from('log as l')
            ->join('users as u','l.id_user','=','u.id')
            ->select('l.id','l.nombre_tabla','u.name as user_n','u.apellidos as user_a','u.email as email','l.accion_realizada','l.updated_at','l.created_at')
            ->where(DB::raw('CONCAT(u.name," ",u.apellidos)'),'LIKE',"%".$query."%" )
            ->orwhere(function($sql) use ($query,$query1){
                $sql->where('l.created_at','>=', "". $query . " 00:00:00")
                ->where('l.created_at','<=',"". $query1 . " 23:59:59");
            })
            ->orwhere('u.email','LIKE',"%".$query."%")
            ->orderBy('id','desc')
            ->Where(function($sql) use ($query,$query1){
                $sql->where('l.created_at','>=',  date('Y-m-d', strtotime($query)) . " 00:00:00")
                ->where('l.created_at','<=',  date('Y-m-d', strtotime($query1)) . " 23:59:59");
            })
            ->orderBy('l.id','desc')
            ->paginate(5);
	 	}else{
	 		return self::from('log as l')
            ->join('users as u','l.id_user','=','u.id')
            ->select('l.id','l.nombre_tabla','u.name as user_n','u.apellidos as user_a','u.email as email','l.accion_realizada','l.updated_at','l.created_at')
            ->where(DB::raw('CONCAT(u.name," ", u.apellidos)'), 'like', "%" . $query. "%")
            ->orwhere('u.email','LIKE',"%".$query."%")
            ->orderBy('l.id','desc')
            ->paginate(5);
	 	}
	 	
	 }

	 public static function agregar_log($nombre_tabla, $id, $accion){
         Log::create([
             'nombre_tabla'=>$nombre_tabla,
             'id_user'=>$id,
             'accion_realizada'=> $accion]);
     }

}
