<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_POST['actividad']) )
{
	$facade = new FachadeOne();

    $tabla_actividades=$facade->listarAsistencia($_POST['actividad'], "../../");

    echo $tabla_actividades;

}


