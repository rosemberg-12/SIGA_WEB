<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_GET['nuevoJ'])	&& isset($_GET['divi']) )
{
	$facade = new FachadeOne();

    $cadena=$facade->asignarJefeDivision($_GET['nuevoJ'],$_GET['divi']);

   header('Location: ../gestion-division.php?estado='.$cadena);

}


