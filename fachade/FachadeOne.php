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

    public function cargarComboUnidades($id_div, $path){
        require_once($path.'model/ControllerDivision.php');
        $cDivision = new ControllerDivision();
        return $cDivision->cargarComboUnidad($id_div, $path);
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

    public function asignarResponsableActividad($jefe, $uni){
        require_once('../../model/ControllerUnidad.php');
        $cDivision = new ControllerUnidad();
        return $cDivision->asignarResponsableActividad($jefe, $uni);
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

    public function  actualizarActividad($nombre, $tipoAct, $tipoProg, $anio, $sem, $f_ini, $f_fin, $dedic, $acti , $status){
        require_once('../../model/ControllerActividad.php');
        $cDivision = new ControllerActividad();
        return $cDivision->actualizarActividad($nombre, $tipoAct, $tipoProg, $anio, $sem, $f_ini, $f_fin, $dedic, $acti, $status);
    }

    public function  crearActividad($nombre, $tipoAct, $tipoProg, $anio, $sem, $f_ini, $f_fin, $dedic, $uni ){
        require_once('../../model/ControllerActividad.php');
        $cDivision = new ControllerActividad();
        return $cDivision->crearActividad($nombre, $tipoAct, $tipoProg, $anio, $sem, $f_ini, $f_fin, $dedic, $uni);
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

    public function getActInformation($id, $path){
        require_once($path.'model/ControllerActividad.php');
        $cDivision = new ControllerActividad();
        return $cDivision->getActInformation($id, $path);
    }


    /**
     * Metodo para listar las actividad de una unidad especifica
     * @param $idUnidad identificador d ela unidad
     * @return string codigoHTML a mostrar
     */
    public function listarActividades($idUnidad){
        require_once ('../model/ControllerActividad.php');
        $cActividad = new ControllerActividad();
        return $cActividad->listarActividadPorUnidad($idUnidad, "../");
    }

    /**
     * Metodo para listar las actividad de una unidad especifica
     * @param $idUnidad identificador d ela unidad
     * @return string codigoHTML a mostrar
     */
    public function listarActividadesServices($idUnidad, $path){
        require_once ($path.'model/ControllerActividad.php');
        $cActividad = new ControllerActividad();
        return $cActividad->listarActividadPorUnidad($idUnidad, $path);
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

    public function cargarAllUsersForActividad($selected, $unid){
        require_once("../".'model/ControllerUsuario.php');
        $cDivision = new ControllerUsuario();
        return $cDivision->cargarAllUsersForUnidad($selected, $unid);
    }

    public function getComboTipoActividad(){
        require_once('../model/ControllerActividad.php');
        $cDivision = new ControllerActividad();
        return $cDivision->getComboTipoActividad();
    }

    public function getComboTipoActividadSelected($selected){
        require_once('../model/ControllerActividad.php');
        $cDivision = new ControllerActividad();
        return $cDivision->getComboTipoActividadSelected($selected);
    }

    public function getComboPrograma(){
        require_once('../model/ControllerActividad.php');
        $cDivision = new ControllerActividad();
        return $cDivision->getComboPrograma();
    }

    public function getComboProgramaSelected($selected){
        require_once('../model/ControllerActividad.php');
        $cDivision = new ControllerActividad();
        return $cDivision->getComboProgramaSelected($selected);
    }

}