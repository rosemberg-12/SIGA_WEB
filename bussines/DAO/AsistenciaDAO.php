<?php


/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 24/11/2016
 * Time: 09:59 PM
 */
class AsistenciaDAO
{
    /**
     * Metodo para listar Asistencia con la informacion necesaria para mostrar en los reportes
     * @param $criterioBusqueda criterio de busqueda para la consulta
     * @param $path ruta para acceder a los archivos desde donde se llama
     * @return array lista de objects tipo Asistencia con la información
     */
    public function listarAsistenciaResportePorSemestreAno($criterioBusqueda,$path){
        include($path.'bussines/DAO/Conection.php');
        require_once ($path.'bussines/DTO/Asistencia.php');

        $consulta = " SELECT tiac.tiac_descripcion, tibe.tibe_descripcion, tido.tido_abreviatura, ";
        $consulta.= " asis.*, acti.acti_descripcion, tipr.tipr_descripcion ";
        $consulta.= " FROM siga.actividad acti ";
        $consulta.= " LEFT JOIN siga.asistencia asis ON (asis.acti_id = acti.acti_id) ";
        $consulta.= " INNER JOIN siga.tipoactividad tiac ON (tiac.tiac_id = acti.tiac_id) ";
        $consulta.= " INNER JOIN siga.tipobeneficiario tibe ON (tibe.tibe_id = asis.tibe_id) ";
        $consulta.= " INNER JOIN siga.tipodocumento tido ON (tido.tido_id = asis.tido_id) ";
        $consulta.= " INNER JOIN siga.tipoprograma tipr ON (tipr.tipr_id = acti.tipr_id) ";
        $consulta.= " WHERE acti.acti_ano = ? ";

        $validar = (is_null($criterioBusqueda['semestre']))? 1:0;
        if($validar == 0){
            $consulta.= " AND acti.acti_semestre = ? ";
        }
        $consulta.= " ORDER BY acti.acti_id; ";

        $result = $conexion->prepare($consulta);

        if($validar == 0){
            $result->execute(array($criterioBusqueda['anoActividad']), $criterioBusqueda['semestre']);
        }else{
            $result->execute(array($criterioBusqueda['anoActividad']));
        }

        $lista = array();

        foreach ($result as $row){
            $asistencia = new Asistencia();

            $asistencia->_SET('descripcionTipoActividad',$row['tiac_descripcion']);
            $asistencia->_SET('descripcionTipoBeneficiario',$row['tibe_descripcion']);
            $asistencia->_SET('abreviaturaTipoDocumento',$row['tido_abreviatura']);
            $asistencia->_SET('id',$row['asis_id']);
            $asistencia->_SET('idActividad',$row['acti_id']);
            $asistencia->_SET('idTipoBeneficiario',$row['tibe_id']);
            $asistencia->_SET('idTipoDocumento',$row['tido_id']);
            $asistencia->_SET('documentoBeneficiario',$row['asis_documento']);
            $asistencia->_SET('nombreBeneficiario',$row['asis_nombrebeneficiario']);
            $asistencia->_SET('codigoBeneficiario',$row['asis_codigobeneficiario']);
            $asistencia->_SET('descripcionActividad',$row['acti_descripcion']);
            $asistencia->_SET('descripcionTipoPrograma',$row['tipr_descripcion']);

            $lista[] = $asistencia;
        }
        $conexion = null;
        return $lista;
    }

    /**
     * Metodo para listar asistencias por tipo beneficiario durante un semetre y año especifico
     * @param $criterioBusqueda criterio de busqueda para la consulta
     * @param $path ruta para acceder a los archivos desde donde se llama
     */
    public function listaAsistenciaPorBeneficiarioSemestreAno($criterioBusqueda,$path){
        include($path.'bussines/DAO/Conection.php');
        require_once ($path.'bussines/DTO/Asistencia.php');

        $consulta = " SELECT tibe.tibe_descripcion, asis.acti_id, divi.divi_abreviatura ,count(asis.acti_id) as cantidad ";
        $consulta.= " FROM siga.asistencia asis ";
        $consulta.= " INNER JOIN siga.actividad acti ON (acti.acti_id = asis.acti_id) ";
        $consulta.= " INNER JOIN siga.unidad unid ON (unid.unid_id = acti.unid_id) ";
        $consulta.= " INNER JOIN siga.division divi ON (divi.divi_id = unid.divi_id) ";
        $consulta.= " INNER JOIN siga.tipobeneficiario tibe ON (tibe.tibe_id = asis.tibe_id) ";
        $consulta.= " WHERE acti.acti_semestre = ? AND acti.acti_ano = ? ";
        $consulta.= " GROUP BY tibe.tibe_descripcion, acti.acti_descripcion ";
        $consulta.= " ORDER BY asis.acti_id; ";

        $result = $conexion->prepare($consulta);
        $result->execute(array($criterioBusqueda['semestre'],$criterioBusqueda['anoActividad']));

        $lista = array();

        foreach($result as $row){
            $asistencia = new Asistencia();

            $asistencia->_SET('descripcionTipoBeneficiario',$row['tibe_descripcion']);
            $asistencia->_SET('idActividad',$row['acti_id']);
            $asistencia->_SET('abreviaturaDivision',$row['divi_abreviatura']);
            $asistencia->_SET('cantidadBeneficiario',$row['cantidad']);

            $lista[] = $asistencia;
        }

        $conexion = null;
        return $lista;

    }

    /**
     * Metodo para listar asistencias por carrera especifica
     * @param $criterioBusqueda criterio de busqueda para la consulta
     * @param $path ruta para acceder a los archivos desde donde se llama
     */
    public function listarAsistenciaResportePorCarrera($criterioBusqueda,$path){
        include($path.'bussines/DAO/Conection.php');
        require_once ($path.'bussines/DTO/Asistencia.php');

        $consulta = " SELECT tiac.tiac_descripcion, tibe.tibe_descripcion, tido.tido_abreviatura, ";
        $consulta.= " asis.*, acti.acti_descripcion, tipr.tipr_descripcion ";
        $consulta.= " FROM siga.actividad acti ";
        $consulta.= " LEFT JOIN siga.asistencia asis ON (asis.acti_id = acti.acti_id) ";
        $consulta.= " INNER JOIN siga.tipoactividad tiac ON (tiac.tiac_id = acti.tiac_id) ";
        $consulta.= " INNER JOIN siga.tipobeneficiario tibe ON (tibe.tibe_id = asis.tibe_id) ";
        $consulta.= " INNER JOIN siga.tipodocumento tido ON (tido.tido_id = asis.tido_id) ";
        $consulta.= " INNER JOIN siga.tipoprograma tipr ON (tipr.tipr_id = acti.tipr_id) ";
        $consulta.= " WHERE acti.acti_semestre = ? AND acti.acti_ano = ? ";

        $consulta.= " AND asis.asis_codigobeneficiario like '".$criterioBusqueda['codigoCarrera1']."' ";

        $validar = (is_null($criterioBusqueda['codigoCarrera2']))? 1:0;

        if($validar == 0){
            $consulta.= " OR asis.asis_codigobeneficiario like '".$criterioBusqueda['codigoCarrera2']."' ";
        }

        $consulta.= " ORDER BY acti.acti_id; ";

        $result = $conexion->prepare($consulta);
        $result->execute(array($criterioBusqueda['semestre'],$criterioBusqueda['anoActividad']));

        $lista = array();

        foreach ($result as $row){
            $asistencia = new Asistencia();

            $asistencia->_SET('descripcionTipoActividad',$row['tiac_descripcion']);
            $asistencia->_SET('descripcionTipoBeneficiario',$row['tibe_descripcion']);
            $asistencia->_SET('abreviaturaTipoDocumento',$row['tido_abreviatura']);
            $asistencia->_SET('id',$row['asis_id']);
            $asistencia->_SET('idActividad',$row['acti_id']);
            $asistencia->_SET('idTipoBeneficiario',$row['tibe_id']);
            $asistencia->_SET('idTipoDocumento',$row['tido_id']);
            $asistencia->_SET('documentoBeneficiario',$row['asis_documento']);
            $asistencia->_SET('nombreBeneficiario',$row['asis_nombrebeneficiario']);
            $asistencia->_SET('codigoBeneficiario',$row['asis_codigobeneficiario']);
            $asistencia->_SET('descripcionActividad',$row['acti_descripcion']);
            $asistencia->_SET('descripcionTipoPrograma',$row['tipr_descripcion']);

            $lista[] = $asistencia;
        }
        $conexion = null;
        return $lista;
    }

    /**
     * Metodo para listar asistencias por una actividad especifica
     * @param $criterioBusqueda criterio de busqueda para la consulta
     * @param $path ruta para acceder a los archivos desde donde se llama
     */
    public function listarAsistenciaReportePorActividad($criterioBusqueda,$path){
        include($path.'bussines/DAO/Conection.php');
        require_once ($path.'bussines/DTO/Asistencia.php');

        $consulta = " SELECT tiac.tiac_descripcion, tibe.tibe_descripcion, tido.tido_abreviatura, ";
        $consulta.= " asis.*, acti.acti_descripcion, tipr.tipr_descripcion ";
        $consulta.= " FROM siga.actividad acti ";
        $consulta.= " LEFT JOIN siga.asistencia asis ON (asis.acti_id = acti.acti_id) ";
        $consulta.= " INNER JOIN siga.tipoactividad tiac ON (tiac.tiac_id = acti.tiac_id) ";
        $consulta.= " INNER JOIN siga.tipobeneficiario tibe ON (tibe.tibe_id = asis.tibe_id) ";
        $consulta.= " INNER JOIN siga.tipodocumento tido ON (tido.tido_id = asis.tido_id) ";
        $consulta.= " INNER JOIN siga.tipoprograma tipr ON (tipr.tipr_id = acti.tipr_id) ";
        $consulta.= " WHERE asis.acti_id = ? ";
        $consulta.= " ORDER BY acti.acti_id, asis.asis_codigobeneficiario; ";

        $result = $conexion->prepare($consulta);
        $result->execute(array($criterioBusqueda['actividad']));


        $lista = array();

        foreach ($result as $row){
            $asistencia = new Asistencia();

            $asistencia->_SET('descripcionTipoActividad',$row['tiac_descripcion']);
            $asistencia->_SET('descripcionTipoBeneficiario',$row['tibe_descripcion']);
            $asistencia->_SET('abreviaturaTipoDocumento',$row['tido_abreviatura']);
            $asistencia->_SET('id',$row['asis_id']);
            $asistencia->_SET('idActividad',$row['acti_id']);
            $asistencia->_SET('idTipoBeneficiario',$row['tibe_id']);
            $asistencia->_SET('idTipoDocumento',$row['tido_id']);
            $asistencia->_SET('documentoBeneficiario',$row['asis_documento']);
            $asistencia->_SET('nombreBeneficiario',$row['asis_nombrebeneficiario']);
            $asistencia->_SET('codigoBeneficiario',$row['asis_codigobeneficiario']);
            $asistencia->_SET('descripcionActividad',$row['acti_descripcion']);
            $asistencia->_SET('descripcionTipoPrograma',$row['tipr_descripcion']);

            $lista[] = $asistencia;
        }
        $conexion = null;
        return $lista;
    }


}