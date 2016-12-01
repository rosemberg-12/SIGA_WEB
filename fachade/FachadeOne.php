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
     * Metodo para lsitar Asistencias por una actividad especifica
     * @param $idActividad identificador de la actividad
     * @return string codigoHTML con la informacion
     */
    public function listarAsistencias($idActividad){
        require_once ('../model/ControllerAsistencia.php');
        $cAsistencia = new ControllerAsistencia();
        return $cAsistencia->listarAsistenciaPorActividad($idActividad);
    }
}