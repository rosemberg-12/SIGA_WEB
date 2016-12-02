<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_POST['division']) )
{
	$facade = new FachadeOne();
    session_start();
    $retorna=$facade->cargarComboUnidades($_POST['division'],"../../");
    echo $retorna;

}


