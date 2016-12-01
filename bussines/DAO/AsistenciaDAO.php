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
        //Conection::getInstance();

        $consulta = " SELECT tiac.tiac_descripcion, tibe.tibe_descripcion, tido.tido_abreviatura, ";
        $consulta.= " asis.*, acti.acti_descripcion, tipr.tipr_descripcion ";
        $consulta.= " FROM actividad acti ";
        $consulta.= " LEFT JOIN asistencia asis ON (asis.acti_id = acti.acti_id) ";
        $consulta.= " INNER JOIN tipoactividad tiac ON (tiac.tiac_id = acti.tiac_id) ";
        $consulta.= " INNER JOIN tipobeneficiario tibe ON (tibe.tibe_id = asis.tibe_id) ";
        $consulta.= " INNER JOIN tipodocumento tido ON (tido.tido_id = asis.tido_id) ";
        $consulta.= " INNER JOIN tipoprograma tipr ON (tipr.tipr_id = acti.tipr_id) ";
        $consulta.= " WHERE acti.acti_semestre = ? AND acti.acti_ano = ? ";
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
     *
     * @param $criterioBusqueda criterio de busqueda para la consulta
     * @param $path ruta para acceder a los archivos desde donde se llama
     */
    public function listaAsistenciaPorBeneficiarioSemestreAno($criterioBusqueda,$path){
        include($path.'bussines/DAO/Conection.php');
        require_once ($path.'bussines/DTO/Asistencia.php');

        $consulta = " SELECT tibe.tibe_descripcion, asis.acti_id, divi.divi_abreviatura ,count(asis.acti_id) as cantidad ";
        $consulta.= " FROM asistencia asis ";
        $consulta.= " INNER JOIN .actividad acti ON (acti.acti_id = asis.acti_id) ";
        $consulta.= " INNER JOIN unidad unid ON (unid.unid_id = acti.unid_id) ";
        $consulta.= " INNER JOIN division divi ON (divi.divi_id = unid.divi_id) ";
        $consulta.= " INNER JOIN tipobeneficiario tibe ON (tibe.tibe_id = asis.tibe_id) ";
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

}