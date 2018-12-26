<?php

namespace sistemaWeb;

use Illuminate\Database\Eloquent\Model;

class Usuario_tesis extends Model
{
    protected $table = "usuario_tesis";

    public function tesis(){
        return $this->belongsTo('sistemaWeb\Tesis');
    }

    public function user(){
        return $this->belongsTo('sistemaWeb\User');
    }

    public static function eliminar_por_tesis($id){
        return Usuario_tesis::where('tesis_id',"=", $id)->delete();
    }
}
