<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 30/11/2016
 * Time: 11:01 PM
 */
class UnidadDAO
{
    /**
     * Metodo para listar las unidades de una division especifica
     * @param $idDivision identificador de la division
     * @return array lista con la infomracion solicitada
     */
    public function listarUnidadesPorDivision($idDivision){
        include ('../bussines/DAO/Conection.php');
        require_once ('../bussines/DTO/Unidad.php');
        require_once ('../bussines/DTO/Persona.php');

        $consulta = " SELECT unid.*, pers.*, tido.tido_abreviatura  ";
        $consulta.= " FROM siga.unidad unid ";
        $consulta.= " INNER JOIN siga.persona pers ON (pers.usu_id = unid.unid_coordinador) ";
        $consulta.= " INNER JOIN siga.tipodocumento tido ON (tido.tido_id = pers.tido_id) ";
        $consulta.= " WHERE unid.divi_id = ? ; ";

        $result = $conexion->prepare($consulta);
        $result->execute(array($idDivision));

        $lista = array();

        foreach($result as $row){
            $unidad = new Unidad();

            $unidad->_SET('id',$row['unid_id']);
            $unidad->_SET('idDivision',$row['divi_id']);
            $unidad->_SET('nombre',$row['unid_nombre']);
            $unidad->_SET('abreviatura',$row['unid_abreviatura']);
            $unidad->_SET('codigo',$row['unid_codigo']);
            $unidad->_SET('estado',$row['unid_estado']);

            $coordinador = new Persona();

            $coordinador->_SET('id',$row['usu_id']);
            $coordinador->_SET('nombre',$row['pers_nombre']);
            $coordinador->_SET('apellido',$row['pers_apellido']);
            $coordinador->_SET('numeroDocumento',$row['pers_numdocumento']);
            $coordinador->_SET('abreviaturaTipoDocumento',$row['tido_abreviatura']);
            $coordinador->_SET('idTipoDocumento',$row['tido_id']);

            $unidad->_SET('coordinador',$coordinador);
            $lista[] = $unidad;
        }
        $conexion = null;

        return $lista;
    }

}