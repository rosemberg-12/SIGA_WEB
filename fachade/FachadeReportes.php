<?php

/**
 * Created by PhpStorm.
 * User: estudiante
 * Date: 19/10/2016
 * Time: 20:27
 */
class FachadeReportes
{
    /**
     * Metodo para listar Asistencia con la informacion necesaria para mostrar en los reportes
     * @param $criterioBusqueda criterio de busqueda para la consulta
     * @param $objPHPExcel document excel
     */
    public function generarInformeExcelMEN($criterioBusqueda, & $objPHPExcel,$path){
        require_once($path.'model/ControllerReportes.php');
        $reportes = new ControllerReportes();
        $reportes->crearInformeExcelMEN($criterioBusqueda,$objPHPExcel,$path);
    }


    /**
     * Metodo para mostrar una tabla con los Divisions registrados en el sistema
     * @param $path rita para acceder archivos
     * @return string codigo HTML para mostrar la informacion
     */
    public function listarDivisions($path){
        require_once($path.'model/ControllerDivision.php');
        $cDivision = new ControllerDivision();
        return $cDivision->listarDivisions($path);
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
}