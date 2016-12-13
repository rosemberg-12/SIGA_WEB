<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 13/12/2016
 * Time: 04:18 AM
 */
class ControllerCarrera
{
    public function getListaCarrera($path){
        include_once ('../bussines/DAO/ProgramaAcademicoDAO.php');
        $pracDAO = new ProgramaAcademicoDAO();
        $lista = $pracDAO->getCarreras($path);

        $table = "";

        if(count($lista)>0){
            foreach ($lista as $prac){
                $table.= " <tr> ";
                $table.= " <td> ".$prac->_GET('descripcion')." </td> ";
                $table.= " <td> ".$prac->_GET('codigo')." </td> ";
                $table.= " <td> <a href='agregarCodigo.php?carrera=".$prac->_GET('id')."'>agregar código</a> </td> ";
                $table.= " </tr> ";
            }
        }else{
            $table.= " <tr><td colspan='3'>No hay datos en el sistema</td></tr> ";
        }


        return $table;
    }


    public function crearCarrera($prac){
        include_once ('../../bussines/DAO/ProgramaAcademicoDAO.php');
        $pracDAO = new ProgramaAcademicoDAO();
        return $pracDAO->registrarCarrera($prac);
    }

    public function agregarCodigoCarrera($prac){
        include_once ('../../bussines/DAO/ProgramaAcademicoDAO.php');
        $pracDAO = new ProgramaAcademicoDAO();
        return $pracDAO->actualizarCarrera($prac);
    }
}