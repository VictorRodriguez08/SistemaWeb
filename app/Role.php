<?php

namespace sistemaWeb;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
 
	 protected $table='roles';


    public function rol_usuario(){
        return $this->hasMany('sistemaWeb\RoleUser');
    }

    public function users()
    {
        return $this
            ->belongsToMany('sistemaWeb\User')
            ->withTimestamps();
    }

    public function hasAccess(array $permisos)
    {
        foreach ($permisos as $permiso) {
            if ($this->hasPermission($permiso))
                return true;
        }
        return false;
    }

    private function hasPermission($permiso)
    {
        $permisos = json_decode($this->permisos);
        return isset($permisos->$permiso);
    }

}
