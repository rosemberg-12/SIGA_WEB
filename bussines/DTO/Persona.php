<?php

/**
 * Created by PhpStorm.
 * User: Brian Alexis sierra
 * Date: 22/11/16
 * Time: 06:01 PM
 */
class Persona
{
    private $nombre;
    private $apellido;
    private $idTipoDocumento;
    private $abreviaturaTipoDocumento;
    private $numeroDocumento;
    private $idUsuario;

    public function _GET($k){ return $this->$k; }
    public function _SET($k, $v){ return $this->$k = $v; }

}