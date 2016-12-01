<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 30/11/2016
 * Time: 10:18 PM
 */
class ControllerActividad
{
    /**
     * Metodo para listar las actividades de una unidad del sistema
     * @param $idUnidad identificador de la unidad
     * @return string codigoHTML con la informacion
     */
    public function listarActividadPorUnidad($idUnidad){
        include_once ('../bussines/DAO/ActividadDAO.php');
        include_once ('../model/General.php');

        $actividadDAO = new ActividadDAO();

        $listaActividad = $actividadDAO->listarActividadesPorUnidad($idUnidad);

        $table = " <table id='tabla-actividades' class='table table-bordered table-hover'> ";
        $table.= " <thead> ";
        $table.= " <tr> ";
        $table.= " <th style='text-align: center'>ACTIVIDAD</th> ";
        $table.= " <th style='text-align: center'>RESPONSABLE</th> ";
        $table.= " <th style='text-align: center'>SEMESTRE</th> ";
        $table.= " <th style='text-align: center'>AÑO</th> ";
        $table.= " <th style='text-align: center'>FECHA INICIO</th> ";
        $table.= " <th style='text-align: center'>FECHA FIN</th> ";
        $table.= " <th style='text-align: center'>ESTADO</th> ";
        $table.= " <th style='text-align: center'>ACCIONES</th> ";
        $table.= " </tr> ";
        $table.= " </thead> ";

        if(count($listaActividad)>0){
            $table.= " <tbody> ";
            foreach ($listaActividad as $actividad){

                $responsable = $actividad->_GET('responsable');
                $encrypt = encriptar($actividad->_GET('id'));

                $table.= " <tr> ";
                $table.= " <td style='text-align: center'>".$actividad->_GET('descripcion')."</td> ";
                $table.= " <td style='text-align: center'>".$responsable->_GET('nombre')." ".$responsable->_GET('apellido')."</td> ";
                $table.= " <td style='text-align: center'>".$actividad->_GET('semestre')."</td> ";
                $table.= " <td style='text-align: center'>".$actividad->_GET('anoActividad')."</td> ";
                $table.= " <td style='text-align: center'>".$actividad->_GET('fechaInicio')."</td> ";
                $table.= " <td style='text-align: center'>".$actividad->_GET('fechaFin')."</td> ";
                $table.= " <td style='text-align: center'>".$actividad->_GET('estado')."</td> ";
                $table.= " <td style='text-align: center'><a href='editarActividad.php?acti=$encrypt'>Editar</a> | <a href='cambiarResponsable.php?acti=$encrypt'>Cambiar Responsable</a></td> ";
                $table.= " </tr> ";
            }
            $table.= " </tbody> ";
        }else{
            $table.= " <tbody> ";
            $table.= " <tr> ";
            $table.= " <td colspan='8'>No hay registros en el sistema</td>";
            $table.= " </tr> ";
            $table.= " </tbody> ";
        }
        $table.= " </table> ";

        return $table;
    }
}