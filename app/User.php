<?php

namespace sistemaWeb;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table='users';


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
        $rol_administrador = Role::where('name','=','Administrador')->first();
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

    public function roles()
    {
        return $this
            ->belongsToMany('sistemaWeb\Role')
            ->withTimestamps();
    }

    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    /**
     * Checks if User has access to $permisos.
     * @param array $permisos
     * @return bool
     */
    public function hasAccess(array $permisos)
    {
        // check if the permission is available in any role
        foreach ($this->roles as $role) {
            if($role->hasAccess($permisos)) {
                return true;
            }
        }
        return false;
    }
}
