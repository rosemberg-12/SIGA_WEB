<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 22/11/16
 * Time: 06:11 PM
 */
class Division
{
    private $id;
    private $nombre;
    private $abreviatura;
    private $estado;
    private $jefe;

    public function _GET($k){ return $this->$k; }
    public function _SET($k, $v){ return $this->$k = $v; }

}