<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_POST['div_name']) && isset($_POST['div_abr']))
{
	$facade = new FachadeOne();

    $cadena=$facade->crearDivision($_POST['div_name'],$_POST['div_abr']);

   header('Location: ../gestion-division.php?estado='.$cadena);

}


