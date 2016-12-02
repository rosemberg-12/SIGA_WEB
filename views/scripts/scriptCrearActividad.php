<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';


if( isset($_POST['act_name']) && isset($_POST['tipo_act']) && isset($_POST['anio'])  && isset($_POST['tipo_prog']) && isset($_POST['sem'])  && isset($_POST['fecha_ini'])  && isset($_POST['fecha_fin'])  && isset($_POST['dedic'])  && isset($_POST['uni']))
{
    $facade = new FachadeOne();
    echo $_POST['divi'];
    $cadena=$facade->crear(($_POST['act_name']) && ($_POST['tipo_act'])  && isset($_POST['tipo_prog'])  && ($_POST['anio']) && ($_POST['sem'])  && ($_POST['fecha_ini'])  && ($_POST['fecha_fin'])  && ($_POST['dedic'])  && ($_POST['uni']));

    echo $cadena;
   header('Location: ../gestionar-division.php?estado='.$cadena);

}



