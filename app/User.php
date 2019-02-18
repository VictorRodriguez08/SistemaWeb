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

    public function usuario_tesis(){
        return $this->hasMany('sistemaWeb\Usuario_tesis');
    }

    public function rol_usuario(){
        return $this->hasMany('sistemaWeb\RoleUser');
    }

    public function primer_rol(){
        $primer_rol = $this->rol_usuario()->first();
        if($primer_rol == null){
            $primer_rol = new RoleUser();
        }
        return $primer_rol;
    }

    public static function obtener_administradores(){
        $usuarios = self::all();
        $administradores     = array();
        $rol_administrador = Rol::where('name','=','Administrador')->first();
        foreach ($usuarios as $item) {
            foreach ($item->rol_usuario()->get() as $usuario_rol){
                if($usuario_rol->role_id == $rol_administrador->id){
                    $administradores[] = $item;
                }
            }
        }
        return $administradores;
    }

    public static function buscar($criterio=""){
    	if($criterio!='all'){
	    	return User::whereRaw(DB::raw("concat(name, ' ', apellidos) like '%" . $criterio . "%'"))->get();
    	}else{
    		return User::all();
    	}
    }
}
