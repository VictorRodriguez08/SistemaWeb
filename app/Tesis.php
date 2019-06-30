<?php

namespace sistemaWeb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        if(Auth::user()->hasRole("Administrador")){
            return self::select("tesis.id", "tesis.titulo", "tesis.fecha_ini", "tesis.fecha_fin", "estados.estado")
                ->join('estados', 'tesis.estado_id', '=', 'estados.id')
                ->orderBy('tesis.id', 'desc')
                ->paginate(10);
        }else{
            return self::select("tesis.id", "tesis.titulo", "tesis.fecha_ini", "tesis.fecha_fin", "estados.estado")
                ->join('estados', 'tesis.estado_id', '=', 'estados.id')
                ->join('usuario_tesis', 'tesis.id', '=', 'usuario_tesis.tesis_id')
                ->where('usuario_tesis.user_id', '=', Auth::user()->id)
                ->orderBy('tesis.id', 'desc')
                ->paginate(10);
        }
    }

    public static function buscar($criterio){
        if(!Auth::user()->hasRole("Administrador")) {
            return DB::table("tesis")
                ->select("tesis.id", "tesis.titulo", "tesis.fecha_ini", "tesis.fecha_fin", "estados.estado")
                ->join('estados', 'tesis.estado_id', '=', 'estados.id')
                ->join('usuario_tesis', 'usuario_tesis.tesis_id', '=', 'tesis.id')
                ->join('users', 'usuario_tesis.user_id', '=', 'users.id')
                ->whereRaw(DB::raw('tesis.titulo like "%' . $criterio . '%"'))
                ->orwhereRaw(DB::raw('facultad like "%' . $criterio . '%"'))
                ->orwhereRaw(DB::raw('carrera like "%' . $criterio . '%"'))
                ->orwhereRaw(DB::raw('concat(users.name, " ", users.apellidos) like "%' . $criterio . '%"'))
                ->distinct()
                ->get();
        }else{
            return DB::table("tesis")
                ->select("tesis.id", "tesis.titulo", "tesis.fecha_ini", "tesis.fecha_fin", "estados.estado")
                ->join('estados', 'tesis.estado_id', '=', 'estados.id')
                ->join('usuario_tesis', 'usuario_tesis.tesis_id', '=', 'tesis.id')
                ->join('users', 'usuario_tesis.user_id', '=', 'users.id')
                ->Where(function ($query) {
                    $query->where('user.id', '=', Auth::user()->id)
                        ->orWwhere('estados.estado', '=', 'Finalizado');
                })
                ->whereRaw(DB::raw('tesis.titulo like "%' . $criterio . '%"'))
                ->orwhereRaw(DB::raw('facultad like "%' . $criterio . '%"'))
                ->orwhereRaw(DB::raw('carrera like "%' . $criterio . '%"'))
                ->orwhereRaw(DB::raw('concat(users.name, " ", users.apellidos) like "%' . $criterio . '%"'))
                ->distinct()
                ->get();
        }
    }

    public function obtener_asesor(){
        return $this->usuario_tesis()->where('rol','=','2')->first();
    }

    public static function obtener_jurados($id){
        return DB::table("tesis")
            ->select('users.name', 'users.apellidos','users.titulo','usuario_tesis.cargo')
            ->join('estados', 'tesis.estado_id', '=', 'estados.id')
            ->join('usuario_tesis', 'usuario_tesis.tesis_id', '=', 'tesis.id')
            ->join('users', 'usuario_tesis.user_id', '=', 'users.id')
            ->where('usuario_tesis.rol','=','3')
            ->where('tesis.id','=',$id)
            ->get();
    }

    public function archivos_tesis(){
        return $this->hasMany('sistemaWeb\ArchivosTesis');
    }

    public function ultimo_archivo(){
        return $this->archivos_tesis()->get()->last();
    }

}
