<?php

namespace sistemaWeb;

use Illuminate\Database\Eloquent\Model;

class Tesis extends Model
{
    protected $table = "tesis";

    public function estado(){
    	return $this->belongsTo('sistemaWeb\Estado');
    }

    public function usuario_tesis(){
        return $this->hasMany('sistemaWeb\Usuario_tesis');
    }
}
