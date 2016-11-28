<?php

/**
 * Created by PhpStorm.
 * User: estudiante
 * Date: 19/10/2016
 * Time: 20:27
 */
class FachadeOne
{
    public function iniciarSesion($documento, $contrasena, $tipo){
        require_once('../model/ControllerSession.php');
        $controlador = new ControllerSession();
        return $controlador->iniciarSesion($documento, $contrasena, $tipo);
    }

}