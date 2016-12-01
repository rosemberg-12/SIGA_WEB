<?php

/**
 * Created by PhpStorm.
 * User: Brian Alexis Sierra Ferrer
 * Date: 23/11/2016
 * Time: 08:32 PM
 */
class Unidad
{
    private $id;
    private $idDivision;
    private $nombre;
    private $abreviatura;
    private $codigo;
    private $estado;
    private $coordinador;

    public function _GET($k){ return $this->$k; }
    public function _SET($k, $v){ return $this->$k = $v; }

}