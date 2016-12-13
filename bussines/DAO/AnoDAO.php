<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 12/12/2016
 * Time: 01:40 PM
 */
class AnoDAO
{
    /**
     * Metodo para registarr un nuevo año para actividad
     * @param $ano valor a registrar
     * @return string resultado de la operacion
     */
    public function crearAno($ano){
        include_once ('../../bussines/DAO/Conection.php');
        try{
            $consulta = " INSERT INTO siga.ano (ano_id) VALUES (?) ";
            $result = $conexion->prepare($consulta);
            $result->execute(array($ano));
            $conexion = null;
            return "0";
        }catch (Exception $e){
            $conexion = null;
            return "1";
        }
    }

    /**
     * Metodo para listar años registrados
     * @return string
     */
    public function listarAnios(){
        include_once ('../bussines/DAO/Conection.php');
        $lista = array();
        try{
            $consulta = " SELECT ano_id FROM siga.ano; ";
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
            foreach ($result as $row){
                $lista[] = $row['ano_id'];
            }
            $conexion = null;
            return $lista;
        }catch (Exception $e){
            $conexion = null;
            return $lista;
        }
    }
}