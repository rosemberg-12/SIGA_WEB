<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_POST['ano']))
{

	$facade = new FachadeOne();

    $cadena=$facade->crearAno($_POST['ano']);

   header('Location: ../registrar-ano.php?estado='.$cadena);

}


