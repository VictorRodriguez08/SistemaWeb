<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class TablaPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permisos de usuarios
        Permission::create([
        	 
        	'name'			=>'Navegar Usuarios',
        	'slug'			=>'users.index',
        	'description'	=>'Listar y navegar todoslos usuarios del sistema',
        ]);

          Permission::create([
        	//Permisos de usuarios 
        	'name'			=>'Ver detalle de Usuarios',
        	'slug'			=>'users.show',
        	'description'	=>'Ver el detalle de cada usuarios del sistema',
        ]);  

          Permission::create([
        	//Permisos de usuarios 
        	'name'			=>'Editar de Usuarios',
        	'slug'			=>'users.edit',
        	'description'	=>'Editar datos de los usuarios del sistema',
        ]);

          Permission::create([
        	//Permisos de usuarios 
        	'name'			=>'Eliminar Usuario',
        	'slug'			=>'users.destroy',
        	'description'	=>'Eliminar un usuario del sistema',
        ]);

         //Permisos de Roles 
          Permission::create([
        	 
        	'name'			=>'Navegar roles',
        	'slug'			=>'roles.index',
        	'description'	=>'Listar y navegar todoslos roles del sistema',
        ]);

          Permission::create([
        	//Permisos de rol 
        	'name'			=>'Ver detalle de roles',
        	'slug'			=>'roles.show',
        	'description'	=>'Ver el detalle de cada rol del sistema',
        ]); 
          Permission::create([
        	//Permisos de rol 
        	'name'			=>'Crear roles',
        	'slug'			=>'roles.create',
        	'description'	=>'Ver el detalle de cada rol del sistema',
        ]);  
 

          Permission::create([
        	//Permisos de rol 
        	'name'			=>'Editar de roles',
        	'slug'			=>'roles.edit',
        	'description'	=>'Editar datos de los rol del sistema',
        ]);

          Permission::create([
        	//Permisos de rol 
        	'name'			=>'Eliminar roles',
        	'slug'			=>'roles.destroy',
        	'description'	=>'Eliminar un rol del sistema',
        ]);


         //Permisos de Lineas de investigacion
         Permission::create([
        	 
        	'name'			=>'Navegar Lineas de Investigacion',
        	'slug'			=>'lineas_inv.index',
        	'description'	=>'Listar y navegar todoslos linea de investigacion del sistema',
        ]);

          Permission::create([
        	//Permisos de Lineas de Investigacion 
        	'name'			=>'Ver detalle de Lineas de Investigacion',
        	'slug'			=>'lineas_inv.show',
        	'description'	=>'Ver el detalle de cada linea de investigacion del sistema',
        ]); 
          Permission::create([
        	//Permisos de Lineas de Investigacion 
        	'name'			=>'Crear Lineas de Investigacion',
        	'slug'			=>'lineas_inv.create',
        	'description'	=>'Ver el detalle de cada linea de investigacion del sistema',
        ]);  
 

          Permission::create([
        	//Permisos de Lineas de Investigacion 
        	'name'			=>'Editar de Lineas de Investigacion',
        	'slug'			=>'lineas_inv.edit',
        	'description'	=>'Editar datos de los linea de investigacion del sistema',
        ]);

          Permission::create([
        	//Permisos de Lineas de Investigacion 
        	'name'			=>'Eliminar Lineas de Investigacion',
        	'slug'			=>'lineas_inv.destroy',
        	'description'	=>'Eliminar un linea de investigacion del sistema',
        ]);
    }
}
