<?php

namespace sistemaWeb;

use Illuminate\Database\Eloquent\Model;
use BD;

class Congreso extends Model
{
    protected $table='congreso';
        protected $primaryKey='id';
    protected $fillable = [
        'nombre','fecha_ini','fecha_entrega','fecha_fin','updated_at','created_at'
    ];
}
