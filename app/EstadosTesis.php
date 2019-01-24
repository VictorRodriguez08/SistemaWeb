<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 10/1/2019
 * Time: 19:27
 */

namespace sistemaWeb;


class EstadosTesis
{
    public $PERFIL;
    public $ANTEPROYECTO;
    public $TESIS;

    public function __construct()
    {
        $this->PERFIL = 1;
        $this->ANTEPROYECTO = 2;
        $this->TESIS = 3;
    }
}