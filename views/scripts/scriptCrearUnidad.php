<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';


if( isset($_POST['unid_name']) && isset($_POST['unid_abr']) && isset($_POST['unid_cod']) && isset($_POST['divi']) )
{
    $facade = new FachadeOne();
    echo $_POST['divi'];
    $cadena=$facade->crearUnidad($_POST['unid_name'],$_POST['unid_abr'], $_POST['unid_cod'],  $_POST['divi'] );
    echo $cadena;
   header('Location: ../gestionar-division.php?estado='.$cadena);

}



