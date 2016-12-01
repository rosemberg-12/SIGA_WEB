<?php
/**
 * Created by PhpStorm.
 * User: Brian Alexis Sierra Ferrer y Rosemberg Porras
 * Date: 23/11/2016
 * Time: 09:04 PM
 */
    $usuario = "siga";
    $clave = "sigaUFPS2016";

    try
    {
        $conexion = new PDO('mysql:host=localhost;dbname=siga2', $usuario, $clave);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e)
    {
        die("Unable to connect: " . $e->getMessage());
    }
?>