<?php

namespace sistemaWeb;

use Illuminate\Database\Eloquent\Model;

class AutoresCongreso extends Model
{
    //
    protected $table='autores_congreso';
        protected $primaryKey='id';
    protected $fillable = [
        'user_id','congreso_id','carrera','tema','url_archivo','dia','updated_at','created_at'
    ];
}
