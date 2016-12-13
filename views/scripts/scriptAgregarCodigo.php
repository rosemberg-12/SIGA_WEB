<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../bussines/DTO/ProgramaAcademico.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_POST['carrera']) && isset($_POST['codigo']))
{
	$facade = new FachadeOne();
    $prac = new ProgramaAcademico();
    $prac->_SET('id',$_POST['carrera']);
    $prac->_SET('codigo',$_POST['codigo']);

    $cadena=$facade->agregarCodigoCarrera($prac);

   header('Location: ../gestionar-carrera.php?estado='.$cadena);

}


