<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 27/11/2016
 * Time: 11:01 PM
 */
class DivisionDAO
{

    public function listarDivisionesEncargadoActividad($idUsuario){
        include ('../bussines/DAO/Conection.php');
        require_once ('../bussines/DTO/Division.php');
        require_once ('../bussines/DTO/Persona.php');

        $consulta = 'SELECT distinct division.*, persona.* FROM division, unidad, actividad, persona where unidad.divi_id= division.divi_id AND unidad.unid_id=actividad.unid_id AND persona.usu_id='.$idUsuario.' AND  actividad.acti_responsable='.$idUsuario;

        $result = $conexion->query($consulta);

        $lista = array();

        foreach ($result as $row){
            $division = new Division();

            $division->_SET('id',$row['divi_id']);
            $division->_SET('nombre',$row['divi_nombre']);
            $division->_SET('abreviatura',$row['divi_abreviatura']);

            $division->_SET('estado',$row['divi_estado']);

            $jefe = new Persona();
            $jefe->_SET('idUsuario',$row['usu_id']);
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

    public function listarDivisionesEncargadoUnidad($idUsuario){
        include ('../bussines/DAO/Conection.php');
        require_once ('../bussines/DTO/Division.php');
        require_once ('../bussines/DTO/Persona.php');

        $consulta = "SELECT  distinct division.*, persona.* from division, unidad, persona where unidad.divi_id= division.divi_id and persona.usu_id=".$idUsuario." and unidad.unid_coordinador=".$idUsuario;

        $result = $conexion->query($consulta);

        $lista = array();

        foreach ($result as $row){
            $division = new Division();

            $division->_SET('id',$row['divi_id']);
            $division->_SET('nombre',$row['divi_nombre']);
            $division->_SET('abreviatura',$row['divi_abreviatura']);

            $division->_SET('estado',$row['divi_estado']);

            $jefe = new Persona();
            $jefe->_SET('idUsuario',$row['usu_id']);
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

    public function asignarJefeDivision($jefe, $division){
        try {
            include_once ('../../bussines/DAO/Conection.php');
            $consulta ='UPDATE division SET divi_jefe="'.$jefe.'" WHERE divi_id="'.$division.'"';
            echo $consulta."<br>";
            $result=$conexion->prepare($consulta);
            $result->execute();

            return "0";
        } catch (Exception $e) {
            echo "1";
        }
    }

    public function actualizarDiv($nombre,$abr, $estado, $id){

        try {

            include_once ('../../bussines/DAO/Conection.php');
            $consulta ='UPDATE division SET divi_nombre="'.$nombre.'", divi_abreviatura="'.$abr.'", divi_estado="'.$estado.'" WHERE divi_id="'.$id.'"';
            echo $consulta."<br>";
            $result=$conexion->prepare($consulta);
            $result->execute();

            return "0";
        } catch (Exception $e) {
            echo "1";
        }


    }

    public function crearDivision($nombre, $abreviatura ){
        try {

            include_once ('../../bussines/DAO/Conection.php');
            $consulta='INSERT INTO division(divi_nombre, divi_abreviatura, divi_jefe, divi_registradopor, divi_estado) VALUES(?,?,?,?,?)';
            $result=$conexion->prepare($consulta);

            $result->execute(array($nombre,$abreviatura,1,1, "A"));


            return "0";
        } catch (Exception $e) {
            return "1";
        }
    }


    /**
     * Metodo para listar las divisiones registradas en el sistema
     * @param $path rita para acceder archivo
     * @return array lista con la informacion solicitada
     */
    public function listarDivisiones(){
        include ('../bussines/DAO/Conection.php');
        require_once ('../bussines/DTO/Division.php');
        require_once ('../bussines/DTO/Persona.php');

        $consulta = " SELECT divi.*, pers.* ";
        $consulta.= " FROM division divi ";
        $consulta.= " INNER JOIN persona pers ON (pers.usu_id = divi.divi_jefe) ";

        $result = $conexion->query($consulta);

        $lista = array();

        foreach ($result as $row){
            $division = new Division();

            $division->_SET('id',$row['divi_id']);
            $division->_SET('nombre',$row['divi_nombre']);
            $division->_SET('abreviatura',$row['divi_abreviatura']);

            $division->_SET('estado',$row['divi_estado']);

            $jefe = new Persona();
            $jefe->_SET('idUsuario',$row['usu_id']);
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

    /**
     * Metodo para listar las divisiones registradas en el sistema
     * @param $path rita para acceder archivo
     * @return array lista con la informacion solicitada
     */
    public function listarDivisionesService($path){
        include ($path.'bussines/DAO/Conection.php');
        require_once ($path.'bussines/DTO/Division.php');
        require_once ($path.'bussines/DTO/Persona.php');

        $consulta = " SELECT divi.*, pers.* ";
        $consulta.= " FROM division divi ";
        $consulta.= " INNER JOIN persona pers ON (pers.usu_id = divi.divi_jefe) ";

        $result = $conexion->query($consulta);

        $lista = array();

        foreach ($result as $row){
            $division = new Division();

            $division->_SET('id',$row['divi_id']);
            $division->_SET('nombre',$row['divi_nombre']);
            $division->_SET('abreviatura',$row['divi_abreviatura']);

            $division->_SET('estado',$row['divi_estado']);

            $jefe = new Persona();
            $jefe->_SET('idUsuario',$row['usu_id']);
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