<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_POST['division']) )
{
	$facade = new FachadeOne();

    $division=$facade->getDivInformationServices($_POST['division'],"../../");
    $retorna=' <p><b>Nombre de la división:</b> <span id="nombre_div">'.$division->_GET("nombre").'</span></p>
                                            <p><b>Nombre del encargado :</b> <span id="nombre_encargado">'.$division->_GET("jefe")->_GET('nombre').' '.$division->_GET("jefe")->_GET('apellido').'</span></p>
                                            <p><b>Abreviatura:</b> <span id="abr_div">'.$division->_GET("abreviatura").'</span></p>';

    echo $retorna;

}


