<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 27/11/2016
 * Time: 11:01 PM
 */
class ControllerDivision
{

    public function cargarDivisionesGestionDivision(){
        include_once ("../".'bussines/DAO/DivisionDAO.php');
        include_once ("../".'model/General.php');

        $divisionDAO =new DivisionDAO();
        $listaDivisiones = $divisionDAO->listarDivisiones();
        $listaComboDivisiones=Array();

        $usuario=$_SESSION['usuario'];

        if(strcmp($_SESSION['tipo_usuario']+"", "1")==0){
            $listaComboDivisiones=$listaDivisiones;
        }
        else{
            foreach ($listaDivisiones as $div) {
                $idJefeDiv=$div->_GET('jefe')->_GET('idUsuario');
                $idCurrentyUser=$usuario->_GET('id');

                if(strcmp($idJefeDiv, $idCurrentyUser)==0){
                    $listaComboDivisiones[]=$div;
                }
            }
        }
        $concat="<option value='-1'>Seleccione uno</option>";

        foreach ($listaComboDivisiones as $div) {
            if(strcmp(($div->_GET('estado')),'A')==0)
            $concat.='<option value="'.$div->_GET('id').'">'.$div->_GET('nombre').'</option>';
        }

        if(empty($concat)){
            return "<option value='-1'>No hay Divisiones para cargar</option>";
        }

        return $concat;




    }

    public function asignarJefeDivision($jefe, $division){
        include_once ('../../bussines/DAO/DivisionDAO.php');
        $usuarioDAO =new DivisionDAO();
        return  $usuarioDAO->asignarJefeDivision($jefe, $division);
    }

    public function actualizarDiv($nombre, $abr, $estado , $id){

        include_once ('../../bussines/DAO/DivisionDAO.php');

        $usuarioDAO =new DivisionDAO();
        return  $usuarioDAO->actualizarDiv($nombre, $abr, $estado, $id );

    }

    public function crearDivision($nombre, $abreviatura ){

        include_once ('../../bussines/DAO/DivisionDAO.php');

        $divisionDAO =new DivisionDAO();
        return $divisionDAO->crearDivision($nombre, $abreviatura);
    }

    public function getDivInformation($id, $path){
        include_once ($path.'bussines/DAO/DivisionDAO.php');
        include_once ($path.'model/General.php');

        $divisionDAO =new DivisionDAO();
        $listaDivisiones = $divisionDAO->listarDivisiones();


        $index=0;
        while($index<count($listaDivisiones)){
            if( $listaDivisiones[$index]->_GET('id')==$id ){
                return  $listaDivisiones[$index];
            }
            $index++;
        }

        return null;
    }

    public function getDivInformationService($id, $path){
        include_once ($path.'bussines/DAO/DivisionDAO.php');
        include_once ($path.'model/General.php');

        $divisionDAO =new DivisionDAO();
        $listaDivisiones = $divisionDAO->listarDivisionesService($path);


        $index=0;
        while($index<count($listaDivisiones)){
            if( $listaDivisiones[$index]->_GET('id')==$id ){
                return  $listaDivisiones[$index];
            }
            $index++;
        }

        return null;
    }


    /**
     * Metodo para listar las divisiones registradas en el sistema
     * @param $path rita para acceder archivos
     * @return string codigo HTML para mostrar la informacion
     */
    public function listarDivisiones($path){
        include_once ($path.'bussines/DAO/DivisionDAO.php');
        include_once ($path.'model/General.php');

        $divisionDAO =new DivisionDAO();
        $listaDivisiones = $divisionDAO->listarDivisiones();

        $table = " <table  id='tabla-usuarios' class='table table-bordered table-hover'> ";
        $table.= " <thead> ";
        $table.= " <tr> ";
        $table.= " <td>Abreviatura</td> ";
        $table.= " <td>Descripción</td> ";
        $table.= " <td>Jefe de division</td> ";
        $table.= " <td>Estado</td> ";
        $table.= " <td>Acciones</td> ";
        $table.= " </tr> ";
        $table.= " </thead> ";

        if(count($listaDivisiones)>0){
            $table.= " <tbody> ";
            foreach ($listaDivisiones as $division){
                $estado="";
                if(strcmp(($division->_GET('estado')),'A')==0){
                    $estado="Activo";
                }
                else{
                    $estado="Desactivado";
                }

                $persona= $division->_GET('jefe');
                $encrypt = encriptar($division->_GET('id'));
                $boss = encriptar($persona->_GET('idUsuario'));
                $table.= " <tr> ";
                $table.= " <td>".$division->_GET('abreviatura')."</td> ";
                $table.= " <td>".$division->_GET('nombre')."</td> ";
                $table.= " <td>".$persona->_GET('nombre')." ".$persona->_GET('apellido')."</td> ";
              $table.= " <td>".$estado."</td> ";
                $table.= " <td><a href='editarDivision.php?divi=$encrypt'>Editar</a> | <a href='asignarJefe.php?divi=$encrypt&jefe=$boss'>Cambiar Jefe</a></td> ";
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
        $table.= " <tfoot> ";
        $table.= " <tr> ";
        $table.= " <td>Abreviatura</td> ";
        $table.= " <td>Descripción</td> ";
        $table.= " <td>Jefe de division</td> ";
       $table.= " <td>Estado</td> ";
        $table.= " <td>Acciones</td> ";
        $table.= " </tr> ";
        $table.= " </tfoot> ";
        $table.= " </table> ";

        return $table;
    }
}