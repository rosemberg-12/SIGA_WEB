<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 26/11/2016
 * Time: 10:51 PM
 */
class ControllerReportes
{
    /* ==========================  EXCEL  ========================== */
    private $listaCarrerras = array('121'=>'ADMINISTRACION DE EMPRESAS DIURNO',
        '125'=>'ADMINISTRACION DE EMPRESAS NOCTURNO',
        '079'=>'ADMINISTRACION DE LOS SERVICIOS DE LA SALUD',
        '3'=>'ADMINISTRATIVO',
        '150'=>'ARQUITECTURA',
        '126'=>'COMERCIO INTERNACIONAL',
        '133'=>'COMUNICACION SOCIAL',
        '122'=>'CONTADURIA PUBLICA DIURNA',
        '123'=>'CONTADURIA PUBLICA DIURNA',
        '135'=>'DERECHO',
        '2'=>'DOCENTE',
        '180'=>'ENFERMERIA',
        '164'=>'INGENIERIA AGROINDUSTRIAL',
        '162'=>'INGENIERIA AGRONOMICA',
        '165'=>'INGENIERIA AMBIENTAL',
        '161'=>'INGENIERIA BIOTECNOLOGICA',
        '111'=>'INGENIERIA CIVIL',
        '118'=>'INGENIERIA DE MINAS',
        '015'=>'INGENIERIA DE SISTEMAS',
        '115'=>'INGENIERIA DE SISTEMAS',
        '109'=>'INGENIERIA ELECTROMECANICA',
        '116'=>'INGENIERIA ELECTRONICA',
        '119'=>'INGENIERIA INDUSTRIAL',
        '112'=>'INGENIERIA MECANICA',
        '146'=>'TECNOLOGIA COMERCIAL Y FINANCIERA',
        '046'=>'TECNOLOGIA COMERCIAL Y FINANCIERA',
        '163'=>'INGENIERIA PECUARIA',
        '070'=>'LICENCIATURA EN INFORMATICA',
        '136'=>'LICENCIATURA EN MATEMATICAS',
        '148'=>'TECNOLOGIA EN REGENCIA EN FARMACIA',
        '192'=>'TECNOLOGIA EN OBRAS CIVILES',
        '134'=>'TRABAJO SOCIAL',
        '198'=>'TECNOLOGIA EN PROCESOS INDUSTRIALES');

    /**
     * Metodo para crear el contenido del informe de Excel para el MEN
     * @param $criterioBusqueda criterio para realizar la consulta
     * @param $objPHPExcel document excel
     */
    public function crearInformeExcelMEN($criterioBusqueda, & $objPHPExcel,$path){
        $listaActividades= $this->listarActividadesReporte($criterioBusqueda, $path);
        $listaBeneficiarios = $this->listarBeneficiariosReporte($criterioBusqueda, $path);
        $listaAsistencias= $this->listarAsistenciasReporte($criterioBusqueda, $path);

        $this->getPropiedades($objPHPExcel);//agregamos las propiedades del documento
        $this->encabezadoActividadBienestar($objPHPExcel);//Encabezado Primera Hoja
        $this->encabezadoActBienestarBeneficiarios($objPHPExcel);//Encabezado Segunda Hoja
        $this->encabezadoActBienestarRecHumano($objPHPExcel);//Encabezado Tercera Hoja
        $this->encabezadoDetalle($objPHPExcel);//Encabezado Cuarta Hoja

        //Pocedemos a agregar la informacion en cada hoja
        $this->agregarInfoActividadBienestar($objPHPExcel,$listaActividades);
        $this->agregarInfoActBienestarBeneficiarios($objPHPExcel,$listaBeneficiarios);
        $this->agregarInfoActBienestarRecHumano($objPHPExcel, $listaActividades);
        $this->agregarInfoDetalle($objPHPExcel,$listaAsistencias);
    }

    /**
     * Metodo para listar las actividades con la informacion para el reporte
     * @param $criterioBusqueda criterio para realizar la consulta
     * @param $path ruta de acceso
     */
    function listarActividadesReporte($criterioBusqueda, $path){
        include_once ($path.'bussines/DAO/ActividadDAO.php');
        $actividadDAO = new ActividadDAO();
        return $actividadDAO->listarActividadesReportePorSemestreAno($criterioBusqueda,$path);
    }

    /**
     * Metodo para listar las asistencias con la informacion para el reporte
     * @param $criterioBusqueda criterio para realizar la consulta
     * @param $path ruta de acceso
     */

    function listarAsistenciasReporte($criterioBusqueda, $path){
        include_once ($path.'bussines/DAO/AsistenciaDAO.php');
        $asistenciaDAO = new AsistenciaDAO();
        return $asistenciaDAO->listarAsistenciaResportePorSemestreAno($criterioBusqueda,$path);
    }

    /**
     * Metodo para listar la cantidad de beficiarios por cada tipo en cada actividad en un semestre y año especifico
     * @param $criterioBusqueda criterio para realizar la consulta
     * @param $path ruta de acceso
     */
    function listarBeneficiariosReporte($criterioBusqueda, $path){
        include_once ($path.'bussines/DAO/AsistenciaDAO.php');
        $asistenciaDAO = new AsistenciaDAO();
        return $asistenciaDAO->listaAsistenciaPorBeneficiarioSemestreAno($criterioBusqueda,$path);
    }

    /**
     * Metodo para definir propiedades del archivo a generar
     * @param $objPHPExcel document excel
     */
    function getPropiedades(& $objPHPExcel){
        // Establecer propiedades
        $objPHPExcel->getProperties()
            ->setCreator("SiGA")
            ->setLastModifiedBy("SiGA")
            ->setTitle("Reporte Semestral de Actividades")
            ->setSubject("Reporte Semestral de Actividades")
            ->setDescription("Reporte Semestral de Actividades para el MEN hecho desde la aplicacion SiGA.")
            ->setKeywords("Excel Office 2007 openxml php")
            ->setCategory("Reporte de Excel");
    }

    /**
     *  Metodo para agregar la informacion de encabezado para la hoja ACTIVIDAD_BIENESTAR
     * @param $objPHPExcel Document excel
     */
    function encabezadoActividadBienestar(& $objPHPExcel){
        //Crear Hoja ACTIVIDAD_BIENESTAR
        $objPHPExcel->setActiveSheetIndex(0);

        // Agregar Encabezado
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'CODIGO_UNIDAD_ORGANIZACIONAL')
            ->setCellValue('B1', 'CODIGO_ACTIVIDAD')
            ->setCellValue('C1', 'DESCRIPCION_ACTIVIDAD')
            ->setCellValue('D1', 'ID_TIPO_ACTIVIDAD_BIENESTAR')
            ->setCellValue('E1','FECHA_INICIO')
            ->setCellValue('F1', 'FECHA_FINAL')
            ->setCellValue('G1','ID_FUENTE_NACIONAL')
            ->setCellValue('H1','VLR_FINANCIACION_NACIONAL')
            ->setCellValue('I1','ID_PAIS_FINANCIADOR')
            ->setCellValue('J1','NOMBRE_ENTIDAD_FTE_INTERNAC')
            ->setCellValue('K1','ID_FUENTE_NACIONAL')
            ->setCellValue('L1','VLR_FINANCIACION_INTERNACIONAL');

        // Renombrar Hoja
        $objPHPExcel->getActiveSheet()->setTitle('ACTIVIDAD_BIENESTAR');

    }

    /**
     * Metodo para agregar la informacion de la Hoja ACTIVIDAD_BIENESTAR
     * @param $objPHPExcel documento excel
     * @param $listaActividades lista de actividades con la informacion para el reporte
     */
    function agregarInfoActividadBienestar(& $objPHPExcel, $listaActividades){
        $i=2;
        foreach($listaActividades as $actividad){
            if($actividad->_GET('id')<10){
                $codigo='00'.$actividad->_GET('id').$actividad->_GET('abreviaturaDivision');
            }else{
                $codigo='0'.$actividad->_GET('id').$actividad->_GET('abreviaturaDivision');
            }
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, 'VB')
                ->setCellValue('B'.$i, $codigo)
                ->setCellValue('C'.$i, $actividad->_GET('descripcion'))
                ->setCellValue('D'.$i, $actividad->_GET('descripcionTipoActividad'))
                ->setCellValue('E'.$i, $actividad->_GET('fechaInicio'))
                ->setCellValue('F'.$i, $actividad->_GET('fechaFin'))
                ->setCellValue('G'.$i, '')
                ->setCellValue('H'.$i, '')
                ->setCellValue('I'.$i, '')
                ->setCellValue('J'.$i, '')
                ->setCellValue('K'.$i, '')
                ->setCellValue('L'.$i, '');
            $i++;
        }
    }

    /**
     * Metodo para agregar la informacion de encabezado para la hoja ACT_BIENESTAR_BENEFICIARIOS
     * @param $objPHPExcel Document excel
     */
    function encabezadoActBienestarBeneficiarios(& $objPHPExcel){
        //Crea Hoja ACT_BIENESTAR_BENEFICIARIOS
        $objPHPExcel->createSheet(1);

        // Agregar Encabezado
        $objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A1', 'CODIGO_UNIDAD_ORGANIZACIONAL')
            ->setCellValue('B1', 'CODIGO_ACTIVIDAD')
            ->setCellValue('C1', 'ID_TIPO_BENEFICIARIO')
            ->setCellValue('D1', 'CANTIDAD_BENEFICIARIOS');

        // Renombrar Hoja
        $objPHPExcel->getActiveSheet()->setTitle('ACT_BIENESTAR_BENEFICIARIOS');
    }

    /**
     * Metodo para agregar la informacion de la Hoja ACT_BIENESTAR_BENEFICIARIOS
     * @param $objPHPExcel documento excel
     * @param $listaBeneficiarios lista de actividades con la informacion para el reporte
     */
    function agregarInfoActBienestarBeneficiarios(& $objPHPExcel, $listaBeneficiarios){
        $i=2;
        foreach($listaBeneficiarios as $asistencia){
            if($asistencia->_GET('id')<10){
                $codigo='00'.$asistencia->_GET('idActividad').$asistencia->_GET('abreviaturaDivision');
            }else{
                $codigo='0'.$asistencia->_GET('idActividad').$asistencia->_GET('abreviaturaDivision');
            }
            $objPHPExcel->setActiveSheetIndex(1)
                ->setCellValue('A'.$i, 'VB')
                ->setCellValue('B'.$i, $codigo)
                ->setCellValue('C'.$i, $asistencia->_GET('descripcionTipoBeneficiario'))
                ->setCellValue('D'.$i, $asistencia->_GET('cantidadBeneficiario'));
            $i++;
        }
    }

    /**
     * Metodo para agregar la informacion de la hoja ACT_BIENESTAR_REC_HUMANO
     * @param $objPHPExcel document excel
     */
    function encabezadoActBienestarRecHumano(& $objPHPExcel){
        //Crea Hoja ACT_BIENESTAR_BENEFICIARIOS
        $objPHPExcel->createSheet(2);

        // Agregar Encabezado
        $objPHPExcel->setActiveSheetIndex(2)
            ->setCellValue('A1', 'CODIGO_UNIDAD_ORGANIZACIONAL')
            ->setCellValue('B1', 'CODIGO_ACTIVIDAD')
            ->setCellValue('C1', 'ID_TIPO_DOCUMENTO')
            ->setCellValue('D1', 'NUM_DOCMUENTO')
            ->setCellValue('E1','DEDICACION');

        // Renombrar Hoja
        $objPHPExcel->getActiveSheet()->setTitle('ACT_BIENESTAR_REC_HUMANO');
    }

    /**
     * Metodo para agregar la informacion de la Hoja ACT_BIENESTAR_REC_HUMANO
     * @param $objPHPExcel documento excel
     * @param $listaActividades lista de actividades con la informacion para el reporte
     */
    function agregarInfoActBienestarRecHumano(& $objPHPExcel, $listaActividades){

        $i=2;
        foreach($listaActividades as $actividad){
            if($actividad->_GET('id')<10){
                $codigo='00'.$actividad->_GET('id').$actividad->_GET('abreviaturaDivision');
            }else{
                $codigo='0'.$actividad->_GET('id').$actividad->_GET('abreviaturaDivision');
            }
            // Agregar Encabezado
            $objPHPExcel->setActiveSheetIndex(2)
                ->setCellValue('A'.$i, 'VB')
                ->setCellValue('B'.$i, $codigo)
                ->setCellValue('C'.$i, $actividad->_GET('tipoDocumentoResponsable'))
                ->setCellValue('D'.$i, $actividad->_GET('numeroDocumentoResponsable'))
                ->setCellValue('E'.$i, $actividad->_GET('dedicacion'));
            $i++;
        }

    }

    /**
     * Metodo para crear la hoja DETALLE
     * @param $objPHPExcel document excel
     */
    function encabezadoDetalle(& $objPHPExcel){
        //Crea Hoja DETALLE
        $objPHPExcel->createSheet(3);

        // Agregar Encabezado
        $objPHPExcel->setActiveSheetIndex(3)
            ->setCellValue('A1', 'TIPO_DE_ACTIVIDAD')
            ->setCellValue('B1', 'TIPO_BENEFICIARIO')
            ->setCellValue('C1', 'TIPO_DOCUMENTO')
            ->setCellValue('D1', 'DOCMUENTO')
            ->setCellValue('E1','NOMBRES')
            ->setCellValue('F1','NOMCARRERA')
            ->setCellValue('G1','NOMBRE')
            ->setCellValue('H1','TIPO_PROGRAMA');

        // Renombrar Hoja
        $objPHPExcel->getActiveSheet()->setTitle('DETALLE');
    }

    /**
     * Metodo para agregar la informacion de la Hoja DETALLE
     * @param $objPHPExcel documento excel
     * @param $listaAsistencias lista de asistencias con la informacion para el reporte
     */
    function agregarInfoDetalle(& $objPHPExcel, $listaAsistencias){
        $i=2;
        foreach($listaAsistencias as $asistencia){
            $nombreC= $this->getNombreCarrera($asistencia->_GET('codigoBeneficiario'));
            $objPHPExcel->setActiveSheetIndex(3)
                ->setCellValue('A'.$i, $asistencia->_GET('descripcionTipoActividad'))
                ->setCellValue('B'.$i, $asistencia->_GET('descripcionTipoBeneficiario'))
                ->setCellValue('C'.$i, $asistencia->_GET('abreviaturaTipoDocumento'))
                ->setCellValue('D'.$i, $asistencia->_GET('documentoBeneficiario'))
                ->setCellValue('E'.$i, $asistencia->_GET('nombreBeneficiario'))
                ->setCellValue('F'.$i, $nombreC)
                ->setCellValue('G'.$i, $asistencia->_GET('descripcionActividad'))
                ->setCellValue('H'.$i, $asistencia->_GET('descripcionTipoPrograma'));
            $i++;
        }//fin for
    }

    /**
     * Metodo para obtener el nombre de la carrera a apartir del codigo del beneficiario
     * @param $codigo codigo del beneficiario
     * @return mixed nombre de la carrera
     */
    function getNombreCarrera($codigo){
        if(strlen($codigo)>3){
            $codigo = substr($codigo,3);
        }
        foreach($this->listaCarrerras as $carrera=>$valor){
            if($carrera == $codigo){
                return $valor;
            }
        }
    }
}