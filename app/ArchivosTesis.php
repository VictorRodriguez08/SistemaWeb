<?php

namespace sistemaWeb;

use Illuminate\Database\Eloquent\Model;

class ArchivosTesis extends Model
{
    protected $table = 'archivos_tesis';

    public function tesis(){
        return $this->belongsTo('sistemaWeb\Tesis');
    }
}
