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

    public function getListaCodigos($path){
        include_once ($path.'bussines/DAO/Conection.php');

        $consulta = " SELECT prac.prac_descripcion, copr.copr_codigo ";
        $consulta.= " FROM siga.programaacademico prac ";
        $consulta.= " INNER JOIN siga.codigoprac copr ON (copr.prac_id = prac.prac_id) ";
        $consulta.= " ORDER BY prac.prac_descripcion; ";
        if(!isset($conexion)){
            try{
                $conexion = new PDO('mysql:host=localhost;dbname=siga', "siga", "sigaUFPS2016");
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (Exception $e){
                die("Unable to connect: " . $e->getMessage());
            }
        }
        $result = $conexion->query($consulta);

        $lista = array();

        foreach ($result as $row) {
            $lista[$row['copr_codigo']]= $row['prac_descripcion'];
        }
        $conexion = null;
        return $lista;
    }

    public function getCarreras($path){
        include_once ($path.'bussines/DAO/Conection.php');
        require_once ($path.'bussines/DTO/ProgramaAcademico.php');

        $consulta = " SELECT prac.*, GROUP_CONCAT(copr.copr_codigo) as codigos ";
        $consulta.= " FROM siga.programaacademico prac ";
        $consulta.= " INNER JOIN siga.codigoprac copr ON (copr.prac_id = prac.prac_id) ";
        $consulta.= " GROUP BY prac.prac_descripcion ";
        $consulta.= " ORDER BY prac.prac_descripcion; ";
        if(!isset($conexion)){
            try{
                $conexion = new PDO('mysql:host=localhost;dbname=siga', "siga", "sigaUFPS2016");
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (Exception $e){
                echo "0";
                die("Unable to connect: " . $e->getMessage());
            }
        }
        $result = $conexion->query($consulta);

        $lista = array();

        foreach ($result as $row) {
            $prac = new ProgramaAcademico();
            $prac->_SET('id',$row['prac_id']);
            $prac->_SET('descripcion',$row['prac_descripcion']);
            $prac->_SET('codigo',$row['codigos']);
            $lista[] = $prac;
        }
        $conexion = null;
        return $lista;
    }

    public function consultarCarrera($idCarrera){
        include_once ('../bussines/DAO/Conection.php');
        require_once ('../bussines/DTO/ProgramaAcademico.php');

        $consulta = " SELECT prac.*, copr.copr_codigo ";
        $consulta.= " FROM siga.programaacademico prac ";
        $consulta.= " INNER JOIN siga.codigoprac copr ON (copr.prac_id = prac.prac_id) ";
        $consulta.= " WHERE prac.prac_id = ? ; ";

        if(!isset($conexion)){
            try{
                $conexion = new PDO('mysql:host=localhost;dbname=siga', "siga", "sigaUFPS2016");
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (Exception $e){
                die("Unable to connect: " . $e->getMessage());
            }
        }
        $result = $conexion->prepare($consulta);
        $result->execute(array($idCarrera));
        $prac = new ProgramaAcademico();

        foreach ($result as $row) {
            $prac->_SET('id',$row['prac_id']);
            $prac->_SET('descripcion',$row['prac_descripcion']);
            $prac->_SET('codigo',$row['copr_codigo']);
        }
        $conexion = null;
        return $prac;
    }

    public function actualizarCarrera($prac){
        include_once ('../../bussines/DAO/Conection.php');
        if(!isset($conexion)){
            try{
                $conexion = new PDO('mysql:host=localhost;dbname=siga', "siga", "sigaUFPS2016");
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (Exception $e){
                echo "0";
                die("Unable to connect: " . $e->getMessage());
            }
        }

        try{
            $consulta = " INSERT INTO siga.codigoprac (prac_id,copr_codigo) VALUES (?,?) ";

            $result = $conexion->prepare($consulta);
            $result->execute(array($prac->_GET('id'),$prac->_GET('codigo')));
            $conexion = null;
            return "0";
        }catch (Exception $e){
            $conexion = null;
            return "1";
        }

    }

    public function registrarCarrera($prac){
        include_once ('../../bussines/DAO/Conection.php');

        if(!isset($conexion)){
            try{
                $conexion = new PDO('mysql:host=localhost;dbname=siga', "siga", "sigaUFPS2016");
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (Exception $e){
                echo "0";
                die("Unable to connect: " . $e->getMessage());
            }
        }

        try{
            $conexion->beginTransaction();

            $consulta = " INSERT INTO siga.programaacademico (prac_descripcion) VALUES (?) ";

            $result = $conexion->prepare($consulta);
            $result->execute(array($prac->_GET('descripcion')));

            $consulta = " SELECT MAX(prac_id) as id FROM siga.programaacademico; ";
            $id = "";
            $result = $conexion->query($consulta);

            foreach ($result as $row){
                $id = $row['id'];
            }

            $consulta = " INSERT INTO siga.codigoprac (prac_id,copr_codigo) VALUES (?,?) ";

            $result = $conexion->prepare($consulta);
            $result->execute(array($id,$prac->_GET('codigo')));

            $conexion->commit();
            $conexion = null;
            return "0";
        }catch (Exception $e){
            $conexion->rollBack();
            $conexion = null;
            return "1";
        }

    }
}