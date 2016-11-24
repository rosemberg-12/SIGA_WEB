<?php

/**
 * Created by PhpStorm.
 * User: Brian Alexis Sierra Ferrer
 * Date: 23/11/2016
 * Time: 08:49 PM
 */
class Asistencia
{
    private $id;
    private $idActividad;
    private $idBeneficiario;
    private $idTipoDocumento;
    private $documentoBeneficiario;
    private $nombresBeneficiario;
    private $codigoBeneficiario;


    public function _GET($k){ return $this->$k; }
    public function _SET($k, $v){ return $this->$k = $v; }
}