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
    private $semestre;
    private $anoActividad;
    private $fechaInicio;
    private $fechaFin;
    private $idTipoPrograma;
    private $nombreTipoPrograma;
    private $estado;
    private $dedicacion;
    private $idResponsable;
    private $tipoDocumentoResponsable;
    private $numeroDocumentoResponsable;
    private $abreviaturaDivision;


    public function _GET($k){ return $this->$k; }
    public function _SET($k, $v){ return $this->$k = $v; }
}