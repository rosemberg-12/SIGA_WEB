<?php
/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 23/11/2016
 * Time: 07:41 PM
 */

/** Incluir la libreria PHPExcel */
require_once 'Classes/PHPExcel.php';

// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
    ->setCreator("SiGA")
    ->setLastModifiedBy("SiGA")
    ->setTitle("Reporte Semestral de Actividades")
    ->setSubject("Reporte Semestral de Actividades")
    ->setDescription("Reporte Semestral de Actividades para el MEN hecho desde la aplicacion SiGA.")
    ->setKeywords("Excel Office 2007 openxml php")
    ->setCategory("Reporte de Excel");

//Crear Hoja ACTIVIDAD_BIENESTAR
$objPHPExcel->setActiveSheetIndex(0);


// Agregar Informacion
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Valor 1')
    ->setCellValue('B1', 'Valor 2')
    ->setCellValue('C1', 'Total')
    ->setCellValue('A2', '10')
    ->setCellValue('B2','55')
    ->setCellValue('C2', '=sum(A2:B2)');

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Tecnologia Simple');

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pruebaReal.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>