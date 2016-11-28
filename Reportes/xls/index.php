<?php
/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 23/11/2016
 * Time: 07:41 PM
 */

/** Incluir la libreria PHPExcel */
require_once 'Classes/PHPExcel.php';
require_once '../../fachade/FachadeReportes.php';

//$criterioBusqueda = array();
if(isset($_POST['semestre'])){ $semestre=$_POST['semestre'];}
if(isset($_POST['ano'])){ $ano=$_POST['ano'];}
//$semestre="I";$ano=2016;

$objPHPExcel = new PHPExcel();// Crea un nuevo objeto PHPExcel
$fachadaRepo = new FachadeReportes();//Crea un nuevo objeto fachada

$criterioBusqueda=array('semestre'=>$semestre,'anoActividad'=>$ano);//CReo el array para la consulta
$path='../../';
$fachadaRepo->generarInformeExcelMEN($criterioBusqueda,$objPHPExcel,$path);//Creo el cuerpo del documento de excel
// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

$filename = "indicadores $semestre semestre $ano";

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>