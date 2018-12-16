<?php

namespace sistemaWeb;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class User extends Authenticatable
{
  
    protected $table='users';
    protected $primaryKey='id';
    protected $fillable = [
        'name','apellidos','email','password','direccion','titulo','otros_estudios','fecha_nac','dui','telefonos','otros_email',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function buscar($criterio=""){
    	if($criterio!='all'){
	    	return User::whereRaw(DB::raw("concat(name, ' ', apellidos) like '%" . $criterio . "%'"))->get();
    	}else{
    		return User::all();
    	}
    }
}
