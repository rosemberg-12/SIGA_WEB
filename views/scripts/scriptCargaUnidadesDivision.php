<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_POST['division']) )
{
	$facade = new FachadeOne();

    $tabla_unidades=$facade->listarUnidadesServices($_POST['division'], "../../");

    echo $tabla_unidades;

}


