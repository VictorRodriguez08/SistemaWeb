<?php

namespace sistemaWeb;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
 
	 protected $table='roles';

	 protected $primaryKey="id";

	 public $timestamps=false;

	 protected $fillable=[
	 		'rol'
	 ];

	 protected $guarded=[

	 ];

    public function rol_usuario(){
        return $this->hasMany('sistemaWeb\RoleUser');
    }

}
