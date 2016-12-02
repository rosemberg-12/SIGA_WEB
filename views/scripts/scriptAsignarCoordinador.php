<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_GET['nuevoJ'])	&& isset($_GET['unid']) )
{
	$facade = new FachadeOne();

    $cadena=$facade->asignarCoordinadorUnidad($_GET['nuevoJ'],$_GET['unid']);

   header('Location: ../gestionar-division.php?estado='.$cadena);

}