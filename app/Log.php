<?php

namespace sistemaWeb;

use Illuminate\Database\Eloquent\Model;

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

}
