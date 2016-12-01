<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_POST['div_name']) && isset($_POST['div_abr']) && isset($_POST['div_status']) && isset($_POST['div_status']))
{
    $facade = new FachadeOne();

    $cadena=$facade->actualizarDiv($_POST['div_name'],$_POST['div_abr'], $_POST['div_status'], $_POST['divi']);

    header('Location: ../gestion-division.php?estado='.$cadena);

}


