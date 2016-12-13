<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';


if( isset($_POST['tipoben']) && isset($_POST['tipodoc']) && isset($_POST['doc'])  && isset($_POST['nom']) && isset($_POST['cod'])  && isset($_POST['asis']))
{

    $facade = new FachadeOne();

   $cadena=$facade->actualizarAsistencia($_POST['tipoben'] , $_POST['tipodoc']  , $_POST['doc']  , $_POST['nom'], $_POST['cod'] , $_POST['asis'] );

   header('Location: ../gestionar-actividad.php?estado='.$cadena);


}else{
    header('Location: ../gestionar-actividad.php?estado=1');
}



