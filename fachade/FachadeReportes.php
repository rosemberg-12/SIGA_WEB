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

    public function generarReportePDF($criterioBusqueda){
        require_once('../model/ControllerReportes.php');
        $reportes = new ControllerReportes();
        return $reportes->listarAsistenciaReportePDF($criterioBusqueda);
    }


    public function getComboCarreras(){
        require_once('../model/ControllerReportes.php');
        $reportes = new ControllerReportes();
        return $reportes->getComboCarreras();
    }



}