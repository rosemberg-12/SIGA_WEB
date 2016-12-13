<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../bussines/DTO/ProgramaAcademico.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_POST['nombre_carre']) && isset($_POST['codigo']))
{
	$facade = new FachadeOne();
    $prac = new ProgramaAcademico();
    $prac->_SET('descripcion',$_POST['nombre_carre']);
    $prac->_SET('codigo',$_POST['codigo']);

    $cadena=$facade->crearCarrera($prac);

   header('Location: ../gestionar-carrera.php?estado='.$cadena);

}


