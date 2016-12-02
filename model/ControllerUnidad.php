<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 30/11/2016
 * Time: 10:18 PM
 */
class ControllerUnidad
{


    public function asignarCoordinadorUnidad($jefe, $uni){
        include_once ('../../bussines/DAO/UnidadDAO.php');
        $unidadDAO =new UnidadDAO();
        return  $unidadDAO->asignarCoordinadorUnidad($jefe, $uni);
    }

    public function asignarResponsableActividad($jefe, $uni){
        include_once ('../../bussines/DAO/ActividadDAO.php');
        $actividadDAO =new ActividadDAO();
        return  $actividadDAO->asignarResponsableActividad($jefe, $uni);
    }

    public function  crearUnidad($nombre, $abreviatura, $cod, $divi){
        include_once ('../../bussines/DAO/UnidadDAO.php');

        $unidadDao =new UnidadDAO();
        return $unidadDao->crearUnidad($nombre, $abreviatura, $cod, $divi);
    }

    public function actualizarUnid($nombre, $abr, $codigo, $estado, $id){

        include_once ('../../bussines/DAO/UnidadDAO.php');

        $unidadDao =new UnidadDAO();
        return  $unidadDao->actualizarUnid($nombre, $abr, $codigo, $estado, $id);

    }

    public function getUnidadInformation($id, $path){
        include_once ($path.'bussines/DAO/UnidadDAO.php');
        include_once ($path.'model/General.php');

        $unidadDao =new UnidadDAO();
        $unidad = $unidadDao->getUnidadById($id, $path);

        return $unidad;

    }

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
        $table.= " <th>UNIDAD</th> ";
        $table.= " <th>COORDINADOR</th> ";
        $table.= " <th>ESTADO</th> ";
        $table.= " <th>ACCIONES</th> ";
        $table.= " </tr> ";
        $table.= " </thead> ";

        if(count($listaUnidades)>0){
            $table.= " <tbody> ";
            foreach ($listaUnidades as $unidad){

                $estado="";
                if(strcmp(($unidad->_GET('estado')),'A')==0){
                    $estado="Activo";
                }
                else{
                    $estado="Desactivado";
                }

                $coordinador = $unidad->_GET('coordinador');
                $encrypt = encriptar($unidad->_GET('id'));

                $table.= " <tr> ";
                $table.= " <td style='text-align: center'>".$unidad->_GET('nombre')."</td> ";
                $table.= " <td style='text-align: center'>".$coordinador->_GET('nombre')." ".$coordinador->_GET('apellido')."</td> ";
                $table.= " <td style='text-align: center'>".$estado."</td> ";
                $table.= " <td style='text-align: center'><a href='editarUnidad.php?unid=$encrypt'>Editar</a> | <a href='cambiarCoordinador.php?unid=$encrypt'>Cambiar Coordinador</a></td> ";
                $table.= " </tr> ";
            }
            $table.= " </tbody> ";
            $table.= " <tfoot> ";
            $table.= " <tr> ";
            $table.= " <th>UNIDAD</th> ";
            $table.= " <th>COORDINADOR</th> ";
            $table.= " <th>ESTADO</th> ";
            $table.= " <th>ACCIONES</th> ";
            $table.= " </tr> ";
            $table.= " </tfoot> ";
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

    /**
     * Metodo para listar unidades de una division especifica
     * @param $idDivision identificador de la division
     * @return string codigoHTML con la informacion
     */
    public function listarUnidadesPorDivisionServices($idDivision, $path){
        include_once ($path.'bussines/DAO/UnidadDAO.php');
        include_once ($path.'model/General.php');

        $unidadDAO = new UnidadDAO();
        $listaUnidades = $unidadDAO->listarUnidadesPorDivisionServices($idDivision, $path);
        $table=' <div style="text-align: center;"><h3>Unidades de la división</h3> </div>';

        $table.= " <table id='tabla-unidades' class='table table-bordered table-hover'> ";
        $table.= " <thead> ";
        $table.= " <tr> ";
        $table.= " <th>CODIGO</th> ";
        $table.= " <th>UNIDAD</th> ";
        $table.= " <th>ABREVIATURA</th> ";
        $table.= " <th>COORDINADOR</th> ";
        $table.= " <th>ESTADO</th> ";
        $table.= " <th>ACCIONES</th> ";
        $table.= " </tr> ";
        $table.= " </thead> ";

        if(count($listaUnidades)>0){
            $table.= " <tbody> ";
            foreach ($listaUnidades as $unidad){
                $estado="";
                if(strcmp(($unidad->_GET('estado')),'A')==0){
                    $estado="Activo";
                }
                else{
                    $estado="Desactivado";
                }
                $coordinador = $unidad->_GET('coordinador');
                $encrypt = encriptar($unidad->_GET('id'));

                $table.= " <tr> ";
                $table.= " <td>".$unidad->_GET('codigo')."</td> ";
                $table.= " <td>".$unidad->_GET('nombre')."</td> ";
                $table.= " <td>".$unidad->_GET('abreviatura')."</td> ";
                $table.= " <td>".$coordinador->_GET('nombre')." ".$coordinador->_GET('apellido')."</td> ";
                $table.= " <td>".$estado."</td> ";
                $table.= " <td><a href='editarUnidad.php?unid=$encrypt'>Editar</a> | <a href='asignarCoordinador.php?unid=$encrypt&jefe=".$coordinador->_GET('idUsuario')."'>Cambiar Coordinador</a></td> ";
                $table.= " </tr> ";
            }
            $table.= " </tbody> ";
            $table.= " <tfoot> ";
            $table.= " <tr> ";
            $table.= " <th>CODIGO</th> ";
            $table.= " <th>UNIDAD</th> ";
            $table.= " <th>ABREVIATURA</th> ";
            $table.= " <th>COORDINADOR</th> ";
            $table.= " <th>ESTADO</th> ";
            $table.= " <th>ACCIONES</th> ";
            $table.= " </tr> ";
            $table.= " </tfoot> ";
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