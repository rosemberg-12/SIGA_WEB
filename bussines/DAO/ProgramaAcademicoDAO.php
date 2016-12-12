<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 11/12/2016
 * Time: 02:41 PM
 */
class ProgramaAcademicoDAO
{
    public function listarProgramasAcademicos(){
        include_once ('../bussines/DAO/Conection.php');
        require_once ('../bussines/DTO/ProgramaAcademico.php');

        $consulta = " SELECT * ";
        $consulta.= " FROM siga.programaacademico ";
        $consulta.= " ORDER BY prac_descripcion; ";

        $result = $conexion->query($consulta);

        $lista = array();

        foreach ($result as $row) {
        	$carrera = new ProgramaAcademico();

        	$carrera->_SET('id',$row['prac_id']);
        	$carrera->_SET('descripcion',$row['prac_descripcion']);

        	$lista[] = $carrera;
        }

        $conexion = null;

        return $lista;
    }

    public function getListaCodigos($criterioBusqueda){
        include_once ('../bussines/DAO/Conection.php');

        $consulta = " SELECT * ";
        $consulta.= " FROM siga.codigoprac ";
        $consulta.= " WHERE prac_id = ? ";
        $consulta.= " ORDER BY prac_id; ";

        $result = $conexion->prepare($consulta);
        $result->execute(array($criterioBusqueda['idCarrera']));

        $lista = array('codigoCarrera1'=>null,'codigoCarrera2'=>null);

        foreach ($result as $row) {

            if($lista['codigoCarrera1'] == null){
                $lista['codigoCarrera1'] = $row['copr_codigo'];
            }else{
                $lista['codigoCarrera2'] = $row['copr_codigo'];
            }
        }
        $conexion = null;

        return $lista;
    }
}