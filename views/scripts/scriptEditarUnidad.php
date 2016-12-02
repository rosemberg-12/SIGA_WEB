<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_POST['unid_name']) && isset($_POST['unid_abr']) && isset($_POST['unid_cod']) && isset($_POST['unid_status']) && isset($_POST['unid']) )
{
    $facade = new FachadeOne();

    $cadena=$facade->actualizarUnid($_POST['unid_name'],$_POST['unid_abr'], $_POST['unid_cod'], $_POST['unid_status'], ($_POST['unid']) );

    header('Location: ../gestionar-division.php?estado='.$cadena);

}


