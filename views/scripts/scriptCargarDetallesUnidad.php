<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_POST['unidad']) )
{
	$facade = new FachadeOne();

    $unidad=$facade->getUnidadInformation($_POST['unidad'],"../../");
    $retorna=' <p><b>Nombre de la unidad:  </b> <span id="nombre_unidad">'.$unidad->_GET("nombre").'</span></p>
                <p><b>Codigo de la unidad :</b> <span id="codigo_unidad">'.$unidad->_GET("codigo").'</span></p>
                                            <p><b>Nombre del encargado :</b><span id="nombre_encargado">'.$unidad->_GET("coordinador")->_GET('nombre').' '.$unidad->_GET("coordinador")->_GET('apellido').'</span></p>
                                            <p><b>Abreviatura:</b><span id="abr_unidad">'.$unidad->_GET("abreviatura").'</span></p>';

    echo $retorna;

}


