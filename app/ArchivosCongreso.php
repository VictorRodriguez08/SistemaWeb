<?php


namespace sistemaWeb;


use Illuminate\Database\Eloquent\Model;

class ArchivosCongreso extends Model
{
    protected $table = 'archivos_congreso';

    public function congreso(){
        return $this->belongsTo('sistemaWeb\Congreso');
    }

    public function user(){
        return $this->belongsTo('sistemaWeb\User');
    }
}
