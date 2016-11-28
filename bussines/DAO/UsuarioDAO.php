<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 27/11/2016
 * Time: 09:22 PM
 */
class UsuarioDAO
{

    /**
     * Metodo para listar los usuario del sitema
     * @param $path ruta para el acceso de los archivos desde donde se envia la solicitud
     * @return array lista con la informacion de los usuario registrados en el sistema
     */
    public function listarUsuarios($path){
        include ($path.'bussines/DAO/Conection.php');
        require_once ($path.'bussines/DTO/Usuario.php');
        require_once ($path.'bussines/DTO/Persona.php');

        $consulta = " SELECT usu.*, pers.*, tido.tido_abreviatura ";
        $consulta.= " FROM siga.usuario usu ";
        $consulta.= " LEFT JOIN siga.persona pers ON (pers.pers_usu_id = usu.usu_id) ";
        $consulta.= " LEFT JOIN siga.tipodocumento tido ON (tido.tido_id = pers.tido_id) ";

        $result = $conexion->query($consulta);
        //$result->excute();

        $lista = array();

        foreach ($result as $row){
            $usuario = new Usuario();

            $usuario->_SET('id',$row['usu_id']);
            $usuario->_SET('nick',$row['usu_nick']);
            $usuario->_SET('contrasena',$row['usu_pass']);
            $usuario->_SET('estado',$row['usu_estado']);

            $persona = new Persona();

            $persona->_SET('idUsuario',$row['pers_usu_id']);
            $persona->_SET('nombre',$row['pers_nombre']);
            $persona->_SET('apellido',$row['pers_apellido']);
            $persona->_SET('idTipoDocumento',$row['tido_id']);
            $persona->_SET('abreviaturaTipoDocumento',$row['tido_abreviatura']);
            $persona->_SET('numeroDocumento',$row['pers_numdocumento']);

            $usuario->_SET('persona', $persona);

            $lista[]=$usuario;
        }

        $conexion=null;
        return $lista;
    }

}