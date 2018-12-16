<?php

namespace sistemaWeb;

use Illuminate\Foundation\Auth\User as Authenticatable;

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
}
