<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 23/11/2016
 * Time: 08:54 PM
 */
class TipoBeneficiario
{
    private $id;
    private $descripcion;

    public function _GET($k){ return $this->$k; }
    public function _SET($k, $v){ return $this->$k = $v; }
}