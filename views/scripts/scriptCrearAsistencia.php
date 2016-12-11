<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';


if( isset($_POST['tipoben']) && isset($_POST['tipodoc']) && isset($_POST['doc'])  && isset($_POST['nom']) && isset($_POST['doc'])  && isset($_POST['acti']))
{

    $facade = new FachadeOne();

    $cadena=$facade->crearAsistencia($_POST['tipoben'] , $_POST['tipodoc']  , $_POST['doc']  , $_POST['nom'], $_POST['doc']  , $_POST['acti'] );

    header('Location: ../gestionar-actividad.php?estado='.$cadena);


}else{
    header('Location: ../gestionar-actividad.php?estado=1)');
}



