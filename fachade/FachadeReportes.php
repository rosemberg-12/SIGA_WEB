<?php

/**
 * Created by PhpStorm.
 * User: estudiante
 * Date: 19/10/2016
 * Time: 20:27
 */
class FachadeResportes
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


}