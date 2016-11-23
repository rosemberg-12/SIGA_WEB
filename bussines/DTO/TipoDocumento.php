<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 22/11/16
 * Time: 06:13 PM
 */
class TipoDocumento
{
    private $id;
    private $descripcion;
    private $abreviatura;

    public function _GET($k){ return $this->$k; }
    public function _SET($k, $v){ return $this->$k = $v; }
}