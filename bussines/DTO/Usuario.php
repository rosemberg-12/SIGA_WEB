<?php

/**
 * Created by PhpStorm.
 * User: Brian Alexis Sierra Ferrer
 * Date: 22/11/16
 * Time: 05:57 PM
 */
class Usuario
{
    private $id;
    private $nick;
    private $contrasena;
    private $estado;
    private $persona;

    public function _GET($k){ return $this->$k; }
    public function _SET($k, $v){ return $this->$k = $v; }

}