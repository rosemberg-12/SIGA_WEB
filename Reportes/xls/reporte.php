<?php
/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 29/11/2016
 * Time: 09:25 PM
 */

require_once '../../fachade/FachadeReportes.php';

$fachadaRepo = new FachadeReportes();//Crea un nuevo objeto fachada
//Por carreras
//$criterioBusqueda=array('semestre'=>'I','anoActividad'=>2016, 'codigoCarrera1'=>'125%', 'codigoCarrera2'=>null, 'tipo'=> 1 );//CReo el array para la consulta

//Por Actividad el criterio de busqueda será así
//$criterioBusqueda=array('actividad'=>15, 'tipo'=> 2 );//CReo el array para la consulta

//Por año donde el semestre es opcional
//en caso que el semestre no se seleccione se envia null, de lo contrario se coloca I o II dependiendo de lo seleccionado
$criterioBusqueda=array('semestre'=>null,'anoActividad'=>2016, 'tipo'=> 3 );//CReo el array para la consulta
?>

<html>
<head>

</head>
<body>
<?php echo $fachadaRepo->generarReportePDF($criterioBusqueda,'../../'); ?>
</body>
</html>
