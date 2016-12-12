<?php
/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 23/11/2016
 * Time: 09:36 PM
 */

//    private $usuario = "ufps_69" ;//usuario para la conexion a  la BB sandbox
//    private $clave = "ufps_po";//clave del usuario para la conexion a la BD sandbox
    /*===========================*/
    $user = "siga" ;//usuario para la conexion a  la BD
    $clave = "sigaUFPS2016";//clave del usuario para la conexion a la BD
    $conexion;//Variable para realizar los llamados fuera de la clase

//gidis.ufps.edu.co
//22
//mastercode
//ufpsbienestar

        try
        {
            $conexion = new PDO('mysql:host=localhost;dbname=siga', $user, $clave);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch (Exception $e)
        {
            die("Unable to connect: " . $e->getMessage());
        }

?>