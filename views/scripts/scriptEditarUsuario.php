<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_POST['user_name'])	&& isset($_POST['user_lastname'])&& isset($_POST['user_tipodoc']) && isset($_POST['user_doc']) &&  isset($_POST['user_pass']) &&  isset($_POST['user_status']))
{
	$facade = new FachadeOne();
    $cadena=$facade->actualizarUser($_POST['user_name'],$_POST['user_lastname'],$_POST['user_tipodoc'], $_POST['user_doc'],$_POST['user_pass'] , $_POST['user_id'],  $_POST['user_status']);
    header('Location: ../gestion-usuarios.php?estado='.$cadena);

}


