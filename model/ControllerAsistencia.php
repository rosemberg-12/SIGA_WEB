<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 01/12/2016
 * Time: 04:09 AM
 */
class ControllerAsistencia
{

    public function getAsisInformation($id, $path){
        include_once ($path.'bussines/DAO/AsistenciaDAO.php');

        $actdDao =new AsistenciaDAO();
        $act = $actdDao->getAsistenciaByID($id, $path);

        if($act==null){
            return 1;
        }


        return $act;
    }
    public function actualizarAsistencia($tipoben, $tipodoc, $doc, $nom, $cod, $asis){
        include_once ('../../bussines/DAO/AsistenciaDAO.php');
        include_once ('../../model/General.php');

        $asistencia = array($asis,$tipoben,  $tipodoc, $doc, $nom, $cod );
        $asistenciaDAO = new AsistenciaDAO();

        return $asistenciaDAO->actualizarAsistencia($asistencia);
    }

    public function crearAsistencia($tipoben, $tipodoc, $doc, $nom, $cod, $acti){
        include_once ('../../bussines/DAO/AsistenciaDAO.php');
        include_once ('../../model/General.php');

        $asistencia = array($acti,$tipoben,  $tipodoc, $doc, $nom, $cod );
        $asistenciaDAO = new AsistenciaDAO();

        return $asistenciaDAO->registrarAsistencia($asistencia);
    }

    /**
     * Metodo para lsitar Asistencias por una actividad especifica
     * @param $idActividad identificador de la actividad
     * @return string codigoHTML con la informacion
     */
    public function listarAsistenciaPorActividad($idActividad){
        include_once ('../bussines/DAO/AsistenciaDAO.php');
        include_once ('../model/General.php');

        $asistenciaDAO = new AsistenciaDAO();
        $listaAsistencias = $asistenciaDAO->listarAsistenciaPorActividad($idActividad);

        $table = " <table id='tabla-asistencias' class='table table-bordered table-hover'> ";
        $table.= " <thead> ";
        $table.= " <tr> ";
        $table.= " <th style='text-align: center'>NOMBRE BENEFICIARIO</th> ";
        $table.= " <th style='text-align: center'>TIPO DOCUMENTO</th> ";
        $table.= " <th style='text-align: center'>NUMERO DE DOCUMENTO</th> ";
        $table.= " <th style='text-align: center'>TIPO BENEFICIARIO</th> ";
        $table.= " <th style='text-align: center'>CARRERA</th> ";
        $table.= " <th style='text-align: center'>ACCIONES</th> ";
        $table.= " </tr> ";
        $table.= " </thead> ";

        if(count($listaAsistencias)>0){
            $table.= " <tbody> ";
            foreach ($listaAsistencias as $asistencia){
                $carrera = getNombreCarrera($asistencia->_GET('codigoBeneficiario'));
                $encrypt = encriptar($asistencia->_GET('id'));

                $table.= " <tr> ";
                $table.= " <td style='text-align: center'>".$asistencia->_GET('nombreBeneficiario')."</td> ";
                $table.= " <td style='text-align: center'>".$asistencia->_GET('abreviaturaTipoDocumento')."</td> ";
                $table.= " <td style='text-align: center'>".$asistencia->_GET('documentoBeneficiario')."</td> ";
                $table.= " <td style='text-align: center'>".$asistencia->_GET('descripcionTipoBeneficiario')."</td> ";
                $table.= " <td style='text-align: center'>".$carrera."</td> ";
                $table.= " <td style='text-align: center'><a href='editarAsistencia.php?asis=$encrypt'>Editar</a></td> ";
                $table.= " </tr> ";
            }
            $table.= " </tbody> ";
        }else{
            $table.= " <tbody> ";
            $table.= " <tr> ";
            $table.= " <td colspan='6'>No hay registros en el sistema</td>";
            $table.= " </tr> ";
            $table.= " </tbody> ";
        }
        $table.= " </table> ";

        return $table;
    }


    /**
     * Metodo para lsitar Asistencias por una actividad especifica
     * @param $idActividad identificador de la actividad
     * @return string codigoHTML con la informacion
     */
    public function listarAsistenciaPorActividadServices($idActividad, $path){
        include_once ($path.'bussines/DAO/AsistenciaDAO.php');
        include_once ($path.'bussines/DAO/ProgramaAcademicoDAO.php');

        $asistenciaDAO = new AsistenciaDAO();
        $listaAsistencias = $asistenciaDAO->listarAsistenciaPorActividadServices($idActividad, $path);

        $pracDAO = new ProgramaAcademicoDAO();
        $carreras = $pracDAO->getListaCodigos($path);

        $table = " <div class='box box-success'> ";
        $table.= " <div class='box-body'> ";
        $table.= " <table id='tabla-asistencias' class='table table-bordered table-hover'> ";
        $table.= " <thead> ";
        $table.= " <tr> ";
        $table.= " <th style='text-align: center'>NOMBRE BENEFICIARIO</th> ";
        $table.= " <th style='text-align: center'>TIPO DOCUMENTO</th> ";
        $table.= " <th style='text-align: center'>NUMERO DE DOCUMENTO</th> ";
        $table.= " <th style='text-align: center'>TIPO BENEFICIARIO</th> ";
        $table.= " <th style='text-align: center'>CARRERA</th> ";
        $table.= " <th style='text-align: center'>ACCIONES</th> ";
        $table.= " </tr> ";
        $table.= " </thead> ";

        if(count($listaAsistencias)>0){
            $table.= " <tbody> ";
            foreach ($listaAsistencias as $asistencia){
                $carrera = $this->getNombreCarrera($asistencia->_GET('codigoBeneficiario'),$carreras);
                $encrypt = ($asistencia->_GET('id'));

                $table.= " <tr> ";
                $table.= " <td style='text-align: center'>".$asistencia->_GET('nombreBeneficiario')."</td> ";
                $table.= " <td style='text-align: center'>".$asistencia->_GET('abreviaturaTipoDocumento')."</td> ";
                $table.= " <td style='text-align: center'>".$asistencia->_GET('documentoBeneficiario')."</td> ";
                $table.= " <td style='text-align: center'>".$asistencia->_GET('descripcionTipoBeneficiario')."</td> ";
                $table.= " <td style='text-align: center'>".$carrera."</td> ";
                $table.= " <td style='text-align: center'><a href='editarAsistencia.php?asis=$encrypt'>Editar</a></td> ";
                $table.= " </tr> ";
            }
            $table.= " </tbody> ";
        }else{
            $table.= " <tbody> ";
            $table.= " <tr> ";
            $table.= " <td colspan='6'>No hay registros en el sistema</td>";
            $table.= " </tr> ";
            $table.= " </tbody> ";
        }
        $table.= " <tfoot> ";
        $table.= " <tr> ";
        $table.= " <th style='text-align: center'>NOMBRE BENEFICIARIO</th> ";
        $table.= " <th style='text-align: center'>TIPO DOCUMENTO</th> ";
        $table.= " <th style='text-align: center'>NUMERO DE DOCUMENTO</th> ";
        $table.= " <th style='text-align: center'>TIPO BENEFICIARIO</th> ";
        $table.= " <th style='text-align: center'>CARRERA</th> ";
        $table.= " <th style='text-align: center'>ACCIONES</th> ";
        $table.= " </tfoot> ";
        $table.= " </table> ";
        $table.= " </div> ";
        $table.= " </div> ";

        return $table;
    }

    /**
     * Metodo para registrar asistencia
     * @param $asistencia
     * @return string
     */
    public function registrarAsistencia($asistencia){
        include_once ('../../bussines/DAO/AsistenciaDAO.php');

        $asistenciaDAO =new AsistenciaDAO();
        return $asistenciaDAO->registrarAsistencia($asistencia);
    }


    function getNombreCarrera($codigo,$carreras){
        $cod = "";
        if(strlen($codigo)>3){
            $cod = substr($codigo,0,3);
        }else{
            $cod = $codigo;
        }
        return $carreras[$cod];
    }
}