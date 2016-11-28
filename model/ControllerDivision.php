<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 27/11/2016
 * Time: 11:01 PM
 */
class ControllerDivision
{
    /**
     * Metodo para listar las divisiones registradas en el sistema
     * @param $path rita para acceder archivos
     * @return string codigo HTML para mostrar la informacion
     */
    public function listarDivisiones($path){
        include_once ($path.'bussines/DAO/DivisionDAO.php');
        include_once ($path.'model/General.php');

        $divisionDAO =new DivisionDAO();
        $listaDivisiones = $divisionDAO->listarDivisiones($path);

        $table = " <table border='1'> ";
        $table.= " <thead> ";
        $table.= " <tr> ";
        $table.= " <td>ABREV.</td> ";
        $table.= " <td>DESCRIPCION</td> ";
        $table.= " <td>JEFE DIVISION</td> ";
        //$table.= " <td>ESTADO</td> ";
        $table.= " <td>ACCIONES</td> ";
        $table.= " <tr> ";
        $table.= " </thead> ";

        if(count($listaDivisiones)>0){
            $table.= " <tbody> ";
            foreach ($listaDivisiones as $division){
                $persona= $division->_GET('jefe');
                $encrypt = encriptar($division->_GET('id'));
                $boss = encriptar($persona->_GET('idUsuario'));
                $table.= " <tr> ";
                $table.= " <td style='text-align: center'>".$division->_GET('abreviatura')."</td> ";
                $table.= " <td style='text-align: center'>".$division->_GET('nombre')."</td> ";
                $table.= " <td style='text-align: center'>".$persona->_GET('nombre')." ".$persona->_GET('apellido')."</td> ";
                //$table.= " <td style='text-align: center'>".$division->_GET('estado')."</td> ";
                $table.= " <td style='text-align: center'><a href='editarDivision.php?divi=$encrypt'>Editar</a> | <a href='asignarJefe.php?divi=$encrypt&jefe=$boss'>Cambiar Jefe</a></td> ";
                $table.= " </tr> ";
            }
            $table.= " </tbody> ";
        }else{
            $table.= " <tbody> ";
            $table.= " <tr> ";
            $table.= " <td colspan='6'>No hay registros en el sistema</td>";
            $table.= " </tr> ";
            $table.= " </tbody> ";
        }
        $table.= " </table> ";

        return $table;
    }
}