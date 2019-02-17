<?php

namespace sistemaWeb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tesis extends Model
{
    protected $table = "tesis";

    public function estado(){
    	return $this->belongsTo('sistemaWeb\Estado');
    }

    public function usuario_tesis(){
        return $this->hasMany('sistemaWeb\Usuario_tesis');
    }

    public static function obtener_todos(){
        return DB::table("tesis")
            ->select("tesis.id", "tesis.titulo", "tesis.fecha_ini", "tesis.fecha_fin", "estados.estado")
            ->join('estados', 'tesis.estado_id', '=', 'estados.id')
            ->orderBy('tesis.id', 'desc')
            
            ->get();
    }

    public function archivos_tesis(){
        return $this->hasMany('sistemaWeb\ArchivosTesis');
    }
}
