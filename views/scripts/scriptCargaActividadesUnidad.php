<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_POST['unidad']) )
{
	$facade = new FachadeOne();

    $tabla_actividades=$facade->listarActividadesServices($_POST['unidad'], "../../");

    echo $tabla_actividades;

}


