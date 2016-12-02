<?php

/**
 * Created by PhpStorm.
 * User: estudiante
 * Date: 19/10/2016
 * Time: 20:27
 */
class FachadeOne
{
    public function cargarDivisionesGestionDivision(){
        require_once('../model/ControllerDivision.php');
        $cDivision = new ControllerDivision();
        return $cDivision->cargarDivisionesGestionDivision();
    }

    public function asignarJefeDivision($jefe, $division){
        require_once('../../model/ControllerDivision.php');
        $cDivision = new ControllerDivision();
        return $cDivision->asignarJefeDivision($jefe, $division);
    }

    public function asignarCoordinadorUnidad($jefe, $uni){
        require_once('../../model/ControllerUnidad.php');
        $cDivision = new ControllerUnidad();
        return $cDivision->asignarCoordinadorUnidad($jefe, $uni);
    }

    public function actualizarUnid($nombre, $abr, $codigo, $estado, $id){
        require_once('../../model/ControllerUnidad.php');
        $cDivision = new ControllerUnidad();
        return $cDivision->actualizarUnid($nombre, $abr, $codigo, $estado, $id);
    }

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

    public function  crearUnidad($nombre, $abreviatura, $cod, $divi){
        require_once('../../model/ControllerUnidad.php');
        $cDivision = new ControllerUnidad();
        return $cDivision->crearUnidad($nombre, $abreviatura, $cod, $divi);
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

    public function getDivInformationServices($id, $path){
        require_once($path.'model/ControllerDivision.php');
        $cDivision = new ControllerDivision();
        return $cDivision->getDivInformationService($id, $path);
    }

    public function getUnidadInformation($id, $path){
        require_once($path.'model/ControllerUnidad.php');
        $cDivision = new ControllerUnidad();
        return $cDivision->getUnidadInformation($id, $path);
    }


    /**
     * Metodo para listar las actividad de una unidad especifica
     * @param $idUnidad identificador d ela unidad
     * @return string codigoHTML a mostrar
     */
    public function listarActividades($idUnidad){
        require_once ('../model/ControllerActividad.php');
        $cActividad = new ControllerActividad();
        return $cActividad->listarActividadPorUnidad($idUnidad);
    }

    /**
     * Metodo para listar unidades de una division especifica
     * @param $idDivision identificador de la division
     * @return string codigoHTML con la informacion
     */
    public function listarUnidades($idDivision){
        require_once ('../model/ControllerUnidad.php');
        $cUnidad = new ControllerUnidad();
        return $cUnidad->listarUnidadesPorDivision($idDivision);
    }


    /**
     * Metodo para listar unidades de una division especifica
     * @param $idDivision identificador de la division
     * @return string codigoHTML con la informacion
     */
    public function listarUnidadesServices($idDivision, $path){
        require_once ($path.'model/ControllerUnidad.php');
        $cUnidad = new ControllerUnidad();
        return $cUnidad->listarUnidadesPorDivisionServices($idDivision, $path);
    }

    public function cargarAllUsers($selected, $divi){
        require_once("../".'model/ControllerUsuario.php');
        $cDivision = new ControllerUsuario();
        return $cDivision->cargarAllUsers($selected, $divi);
    }

    public function cargarAllUsersForUnidad($selected, $unid){
        require_once("../".'model/ControllerUsuario.php');
        $cDivision = new ControllerUsuario();
        return $cDivision->cargarAllUsersForUnidad($selected, $unid);
    }

}