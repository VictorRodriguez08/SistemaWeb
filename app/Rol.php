<?php

namespace sistemaWeb;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
 
	 protected $table='roles';

	 protected $primaryKey="id_rol"   

	 public $timestamps=false;

	 protected $fillable=[
	 		'rol'
	 ];

	 protected $guarded=[

	 ];

}
