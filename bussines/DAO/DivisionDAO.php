<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 27/11/2016
 * Time: 11:01 PM
 */
class DivisionDAO
{
    /**
     * Metodo para listar las divisiones registradas en el sistema
     * @param $path rita para acceder archivo
     * @return array lista con la informacion solicitada
     */
    public function listarDivisiones($path){
        include ($path.'bussines/DAO/Conection.php');
        require_once ($path.'bussines/DTO/Division.php');
        require_once ($path.'bussines/DTO/Persona.php');

        $consulta = " SELECT divi.*, pers.* ";
        $consulta.= " FROM siga.division divi ";
        $consulta.= " INNER JOIN siga.persona pers ON (pers.pers_usu_id = divi.divi_jefe) ";

        $result = $conexion->query($consulta);

        $lista = array();

        foreach ($result as $row){
            $division = new Division();

            $division->_SET('id',$row['divi_id']);
            $division->_SET('nombre',$row['divi_nombre']);
            $division->_SET('abreviatura',$row['divi_abreviatura']);

            $jefe = new Persona();
            $jefe->_SET('idUsuario',$row['pers_usu_id']);
            $jefe->_SET('nombre',$row['pers_nombre']);
            $jefe->_SET('apellido',$row['pers_apellido']);
            $jefe->_SET('idTipoDocumento',$row['tido_id']);
            $jefe->_SET('numeroDocumento',$row['pers_numdocumento']);

            $division->_SET('jefe', $jefe);

            $lista[] = $division;
        }

        $conexion = null;

        return $lista;
    }
}