<?php

namespace sistemaWeb;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';

    public function usuario(){
        return $this->belongsTo('sistemaWeb\User');
    }

    public function rol(){
        return $this->belongsTo('sistemaWeb\Role');
    }

    public static function eliminar_por_usuario($id_usuario){
        self::where('user_id',"=", $id_usuario)->delete();
    }
}
