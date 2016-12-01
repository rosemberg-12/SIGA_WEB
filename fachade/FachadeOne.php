<?php

/**
 * Created by PhpStorm.
 * User: estudiante
 * Date: 19/10/2016
 * Time: 20:27
 */
class FachadeOne
{
    public function  actualizarDiv($nombre, $abr, $estado, $id){
        require_once('../../model/ControllerDivision.php');
        $cDivision = new ControllerDivision();
        return $cDivision->actualizarDiv($nombre, $abr, $estado, $id);
    }
    public function  actualizarUser($nombre, $apellido, $tipoDoc, $doc, $pass,$id , $estado){
        require_once('../../model/ControllerUsuario.php');
        $cDivision = new ControllerUsuario();
        return $cDivision->actualizarUser($nombre, $apellido, $tipoDoc, $doc, $pass,$id, $estado );
    }

    public function  crearUser($nombre, $apellido, $tipoDoc, $doc, $pass ){
        require_once('../../model/ControllerUsuario.php');
        $cDivision = new ControllerUsuario();
        return $cDivision->crearUser($nombre, $apellido, $tipoDoc, $doc, $pass );
    }

    public function  crearDivision($nombre, $abreviatura ){
        require_once('../../model/ControllerDivision.php');
        $cDivision = new ControllerDivision();
        return $cDivision->crearDivision($nombre, $abreviatura );
    }

    public function iniciarSesion($tipoDocumento ,$documento, $contrasena, $tipo){
        require_once('../model/ControllerSession.php');
        $controlador = new ControllerSession();
        return $controlador->iniciarSesion($tipo, $documento, $contrasena, $tipoDocumento);
    }


    /**
     * Metodo para mostrar una tabla con los Divisions registrados en el sistema
     * @param $path rita para acceder archivos
     * @return string codigo HTML para mostrar la informacion
     */
    public function listarUsuarios(){
        require_once('../model/ControllerUsuario.php');
        $cDivision = new ControllerUsuario();
        return $cDivision->listarUsuarios();
    }

    /**
     * Metodo para mostrar una tabla con las Divisiones registradas en el sistema
     * @param $path rita para acceder archivos
     * @return string codigo HTML para mostrar la informacion
     */
    public function listarDivisiones($path){
        require_once($path.'model/ControllerDivision.php');
        $cDivision = new ControllerDivision();
        return $cDivision->listarDivisiones($path);
    }
    public function getUserInformation($id, $path){
        require_once($path.'model/ControllerUsuario.php');
        $cDivision = new ControllerUsuario();
        return $cDivision->getUserInformation($id, $path);
    }

    public function getDivInformation($id, $path){
        require_once($path.'model/ControllerDivision.php');
        $cDivision = new ControllerDivision();
        return $cDivision->getDivInformation($id, $path);
    }


}