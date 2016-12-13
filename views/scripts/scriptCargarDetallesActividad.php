<?php
require_once '../../bussines/DTO/Usuario.php';
require_once '../../bussines/DTO/Persona.php';
require_once '../../fachade/FachadeOne.php';

if( isset($_POST['unidad']) )
{
	$facade = new FachadeOne();

    $unidad=$facade->getActInformation($_POST['unidad'],"../../");
    $retorna='                              <p><b>Nombre de la actividad:  </b> <span id="nombre_unidad">'.$unidad->_GET("descripcion").'</span></p>
                                            <p><b>Nombre del responsable :</b><span id="nombre_encargado">'.$unidad->_GET("responsable")->_GET("nombre").'</span></p>
                                            <p><b>Fecha inicio :</b><span id="nombre_encargado">'.$unidad->_GET("fechaInicio").'</span></p>
                                            <p><b>Fecha Fin :</b><span id="nombre_encargado">'.$unidad->_GET("fechaFin").'</span></p>
                                            <p><b>Año :</b><span id="nombre_encargado">'.$unidad->_GET("anoActividad").'</span></p>
                                            <p><b>Semestre :</b><span id="nombre_encargado">'.$unidad->_GET("semestre").'</span></p>';

    echo $retorna;

}


