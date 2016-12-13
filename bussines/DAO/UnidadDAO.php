<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 30/11/2016
 * Time: 11:01 PM
 */
class UnidadDAO
{

    public function asignarCoordinadorUnidad($jefe, $uni){
        include_once ('../../bussines/DAO/Conection.php');
        try {
            $consulta ='UPDATE unidad SET unid_coordinador = ? WHERE unid_id= ?';
            $result=$conexion->prepare($consulta);
            $result->execute(array($jefe,$uni));
            $conexion = null;
            return "0";
        } catch (Exception $e) {
            $conexion = null;
            return "1";
        }
    }

    public function  crearUnidad($nombre, $abreviatura, $cod, $divi){
        try {

            session_start();
            if($_SESSION['tipo_usuario']==1){
                $registradopor=1;
            }
            else{
                $registradopor=$_SESSION['usuario']->_GET('id');
            }
            include_once ('../../bussines/DAO/Conection.php');
            $consulta='INSERT INTO siga.unidad(divi_id, unid_nombre, unid_abreviatura, unid_codigo, unid_estado, unid_coordinador, unid_registradopor) VALUES(?,?,?,?,?,?,?)';
            $result=$conexion->prepare($consulta);

            $result->execute(array($divi,$nombre, $abreviatura,$cod,"A",1,$registradopor));


            return "0";
        } catch (Exception $e) {
            return "1";
        }
    }

    public function actualizarUnid($nombre, $abr, $codigo, $estado, $id){
        try {

            include_once ('../../bussines/DAO/Conection.php');
            $consulta ='UPDATE unidad SET unid_nombre="'.$nombre.'", unid_abreviatura="'.$abr.'", unid_estado="'.$estado.'", unid_codigo="'.$codigo.'" WHERE unid_id="'.$id.'"';
            $result=$conexion->prepare($consulta);
            $result->execute();
            return "0";
        } catch (Exception $e) {
            echo "1";
        }
    }

    public function getUnidadById($id, $path){
        include ( $path.'bussines/DAO/Conection.php');
        require_once ( $path.'bussines/DTO/Unidad.php');
        require_once ( $path.'bussines/DTO/Persona.php');

        $consulta = " SELECT unid.*, pers.*, tido.tido_abreviatura  ";
        $consulta.= " FROM siga.unidad unid ";
        $consulta.= " INNER JOIN siga.persona pers ON (pers.usu_id = unid.unid_coordinador) ";
        $consulta.= " INNER JOIN siga.tipodocumento tido ON (tido.tido_id = pers.tido_id) ";
        $consulta.= " WHERE unid.unid_id = ? ; ";

        $result = $conexion->prepare($consulta);
        $result->execute(array($id));

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
            return $unidad;
        }

    }

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

            $coordinador->_SET('idUsuario',$row['usu_id']);
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



    /**
     * Metodo para listar las unidades de una division especifica
     * @param $idDivision identificador de la division
     * @return array lista con la infomracion solicitada
     */
    public function listarUnidadesEncargadoActividad($divi, $idCoordinador, $path){
        include ($path.'bussines/DAO/Conection.php');
        require_once ($path.'bussines/DTO/Unidad.php');
        require_once ($path.'bussines/DTO/Persona.php');

        $consulta = 'SELECT unidad.*, persona.* from unidad, persona, actividad where unidad.divi_id='.$divi.' AND unidad.unid_id=actividad.unid_id AND persona.usu_id='.$idCoordinador.' AND  actividad.acti_responsable='.$idCoordinador;


        $result = $conexion->prepare($consulta);
        $result->execute();


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

            $coordinador->_SET('idUsuario',$row['usu_id']);
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

    /**
     * Metodo para listar las unidades de una division especifica
     * @param $idDivision identificador de la division
     * @return array lista con la infomracion solicitada
     */
    public function listarUnidadesPorDivisionServices($idDivision, $path){
        include ($path.'bussines/DAO/Conection.php');
        require_once ($path.'bussines/DTO/Unidad.php');
        require_once ($path.'bussines/DTO/Persona.php');

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

            $coordinador->_SET('idUsuario',$row['usu_id']);
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