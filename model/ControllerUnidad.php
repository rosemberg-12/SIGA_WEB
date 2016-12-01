<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 30/11/2016
 * Time: 10:18 PM
 */
class ControllerUnidad
{
    /**
     * Metodo para listar unidades de una division especifica
     * @param $idDivision identificador de la division
     * @return string codigoHTML con la informacion
     */
    public function listarUnidadesPorDivision($idDivision){
        include_once ('../bussines/DAO/UnidadDAO.php');
        include_once ('../model/General.php');

        $unidadDAO = new UnidadDAO();
        $listaUnidades = $unidadDAO->listarUnidadesPorDivision($idDivision);

        $table = " <table id='tabla-unidades' class='table table-bordered table-hover'> ";
        $table.= " <thead> ";
        $table.= " <tr> ";
        $table.= " <th style='text-align: center'>UNIDAD</th> ";
        $table.= " <th style='text-align: center'>COORDINADOR</th> ";
        $table.= " <th style='text-align: center'>ESTADO</th> ";
        $table.= " <th style='text-align: center'>ACCIONES</th> ";
        $table.= " </tr> ";
        $table.= " </thead> ";
        
        if(count($listaUnidades)>0){
            $table.= " <tbody> ";
            foreach ($listaUnidades as $unidad){

                $coordinador = $unidad->_GET('coordinador');
                $encrypt = encriptar($unidad->_GET('id'));

                $table.= " <tr> ";
                $table.= " <td style='text-align: center'>".$unidad->_GET('nombre')."</td> ";
                $table.= " <td style='text-align: center'>".$coordinador->_GET('nombre')." ".$coordinador->_GET('apellido')."</td> ";
                $table.= " <td style='text-align: center'>".$unidad->_GET('estado')."</td> ";
                $table.= " <td style='text-align: center'><a href='editarUnidad.php?unid=$encrypt'>Editar</a> | <a href='cambiarCoordinador.php?unid=$encrypt'>Cambiar Coordinador</a></td> ";
                $table.= " </tr> ";
            }
            $table.= " </tbody> ";
        }else{
            $table.= " <tbody> ";
            $table.= " <tr> ";
            $table.= " <td colspan='4'>No hay registros en el sistema</td>";
            $table.= " </tr> ";
            $table.= " </tbody> ";
        }
        $table.= " </table> ";

        return $table;
    }
}