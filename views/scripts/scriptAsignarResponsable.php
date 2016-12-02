<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_GET['nuevoJ'])	&& isset($_GET['act']) )
{
	$facade = new FachadeOne();

    $cadena=$facade->asignarResponsableActividad($_GET['nuevoJ'],$_GET['act']);

   header('Location: ../gestionar-unidad.php?estado='.$cadena);

}