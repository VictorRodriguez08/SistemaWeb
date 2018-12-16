<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddFilesToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->string('apellidos',100)->after('name');
            $table->string('direccion',200)->after('password');
            $table->string('titulo',100)->after('direccion');
            $table->string('otros_estudios',100)->after('titulo')->nullable();
            $table->date('fecha_nac')->after('otros_estudios');
            $table->string('dui',10)->after('fecha_nac');
            $table->string('telefonos',100)->after('dui');
            $table->string('otros_email',200)->after('telefonos')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table){

            $table->dropColumn('apellidos');
            $table->dropColumn('direccion');
            $table->dropColumn('titulo');
            $table->dropColumn('otros_estudios');
            $table->dropColumn('fecha_nac');
            $table->dropColumn('dui');
            $table->dropColumn('telefonos');
            $table->dropColumn('otros_email');

        });
    }
}
