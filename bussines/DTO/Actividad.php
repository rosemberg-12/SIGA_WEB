<?php

/**
 * Created by PhpStorm.
 * User: Brian Alexis Sierra Ferrer
 * Date: 23/11/2016
 * Time: 08:44 PM
 */
class Actividad
{
    private $id;
    private $idUnidad;
    private $descripcion;
    private $idTipoActividad;
    private $fechaInicio;
    private $fechaFina;
    private $idTipoPrograma;
    private $estado;
    private $dedicacion;
    private $idResponsable;

    public function _GET($k){ return $this->$k; }
    public function _SET($k, $v){ return $this->$k = $v; }
}