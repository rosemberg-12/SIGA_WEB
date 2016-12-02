<?php
/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 24/11/2016
 * Time: 07:11 PM
 */
class ActividadDAO
{


    public function getTipoActividades(){

        /*===========================*/
        $user = "root" ;//usuario para la conexion a  la BD
        $clave = "";//clave del usuario para la conexion a la BD
        $conexion="";//Variable para realizar los llamados fuera de la clase

        try
        {
            $conexion = new PDO('mysql:host=localhost;dbname=siga', $user, $clave);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch (Exception $e)
        {
            die("Unable to connect: " . $e->getMessage());
        }
        //include_once ('../bussines/DAO/Conection.php');
        include_once ('../bussines/DTO/TipoActividad.php');

        $consulta= "Select * from tipoactividad";
        $result = $conexion->prepare($consulta);
        $result->execute(array());
        $tactividades=array();

        foreach ($result as $row){

            $tactividad= new TipoActividad();
            $tactividad->_SET("id",$row[0]);
            $tactividad->_SET("descripcion",$row[1]);
            $tactividades[]=$tactividad;
        }
        $conexion=null;
        return $tactividades;
    }

    public function getProg(){
        include_once ('../bussines/DAO/Conection.php');
        include_once ('../bussines/DTO/TipoPrograma.php');

        $consulta= "Select * from tipoprograma";
        $result = $conexion->prepare($consulta);
        $result->execute(array());
        $tactividades=array();

        foreach ($result as $row){

            $tactividad= new TipoPrograma();
            $tactividad->_SET("id",$row[0]);
            $tactividad->_SET("descripcion",$row[1]);
            $tactividades[]=$tactividad;
        }
        $conexion=null;
        return $tactividades;
    }

    /**
     * Metodo para registrar una nueva actividad
     * @param $actividad datos a registrar
     * @return string mensaje de registro
     */
    public function registrarActividad($actividad,$path){
        include_once ($path.'bussines/DAO/Conection.php');

        $consulta =" INSERT INTO siga.actividad (unid_id,acti_descripcion,tiac_id,acti_semestre,acti_ano,acti_fechainicio,acti_fechafin,acti_dedicacion,tipr_id,acti_estado,acti_responsable,acti_registradopor) ";
        $consulta .=" VALUES (?,?,?,?,?,?,?,?,?,?,?,?); ";
        $result = $conexion->prepare($consulta);
        $result->execute(array(
            $actividad->_GET('idUnidad'),
            $actividad->_GET('descripcion'),
            $actividad->_GET('idTipoActividad'),
            $actividad->_GET('semestre'),
            $actividad->_GET('anoActividad'),
            $actividad->_GET('fechaInicio'),
            $actividad->_GET('fechaFin'),
            $actividad->_GET('dedicacion'),
            $actividad->_GET('idTipoPrograma'),
            'A',
            $actividad->_GET('idResponsable'),
            $_SESSION['idUsuario']
        ));
        $conexion = null;
        return "Registro de Actividad exitoso";
    }

    /**
     * Metodo para consultar una actividad por su id
     * @param $idActividad identificador de la actividad
     * @return mixed Resultado de la consulta
     */
    public function consultarActividad($idActividad,$path){
        include_once ($path.'bussines/DAO/Conection.php');
        require_once ($path.'bussines/DTO/Actividad.php');

        $consulta = " SELECT * FROM siga.actividad WHERE acti_id = ? ";
        $result = $conexion->prepare($consulta);
        $result->execute(array($idActividad));

        foreach ($result as $row){
         $actividad= $row[0];
        }
        $conexion = null;
        return $actividad;
    }

    /**
     * Metodo para listar las actividades con la informacion necesaria para los reportes PDF y EXCEL
     * @param $criterioBusqueda array que contiene los valores de busqueda
     * @param $path ruta de acceso desde donde se ejecuta la operacion
     * @return array lista de actividades con la informacion para el reporte
     */
    public function listarActividadesReportePorSemestreAno($criterioBusqueda,$path){
        include ($path.'bussines/DAO/Conection.php');
        require_once ($path.'bussines/DTO/Actividad.php');
        require_once ($path.'bussines/DTO/Persona.php');

        $consulta = " SELECT acti.acti_id, acti.unid_id, acti.acti_descripcion, acti.tiac_id, acti.acti_semestre, ";
        $consulta.= " acti.acti_ano, SUBSTRING_INDEX(SUBSTRING_INDEX(acti.acti_fechainicio, ' ', 1), ' ', -1) AS acti_fechainicio, ";
        $consulta.= " SUBSTRING_INDEX(SUBSTRING_INDEX(acti.acti_fechafin, ' ', 1), ' ', -1) AS acti_fechafin, acti.acti_dedicacion, ";
        $consulta.= " acti.tipr_id, acti.acti_estado, acti.acti_responsable, divi.divi_abreviatura, ";
        $consulta.= " tipr.tipr_descripcion, tiac.tiac_descripcion, tido.tido_abreviatura, pers.* ";
        $consulta.= " FROM siga.actividad acti ";
        $consulta.= " INNER JOIN siga.persona pers ON (pers.usu_id = acti.acti_responsable) ";
        $consulta.= " INNER JOIN siga.tipodocumento tido ON (tido.tido_id = pers.tido_id) ";
        $consulta.= " INNER JOIN siga.unidad unid ON (unid.unid_id = acti.unid_id) ";
        $consulta.= " INNER JOIN siga.division divi ON (divi.divi_id = unid.divi_id) ";
        $consulta.= " INNER JOIN siga.tipoprograma tipr ON (tipr.tipr_id = acti.tipr_id) ";
        $consulta.= " INNER JOIN siga.tipoactividad tiac ON (tiac.tiac_id = acti.tiac_id) ";
        $consulta.= " WHERE acti.acti_semestre = ? AND acti.acti_ano = ? ";
        $consulta.= " ORDER BY acti.acti_id ; ";

        $result = $conexion->prepare($consulta);
        $result->execute(array($criterioBusqueda['semestre'],$criterioBusqueda['anoActividad']));

        $lista = array();
        foreach ($result as $row){
            $actividad = new Actividad();
            $actividad->_SET('id',$row['acti_id']);
            $actividad->_SET('idUnidad',$row['unid_id']);
            $actividad->_SET('descripcion',utf8_encode($row['acti_descripcion']));
            $actividad->_SET('idTipoActividad',$row['tiac_id']);
            $actividad->_SET('semestre',$row['acti_semestre']);
            $actividad->_SET('anoActividad',$row['acti_ano']);
            $actividad->_SET('fechaInicio',$row['acti_fechainicio']);
            $actividad->_SET('fechaFin',$row['acti_fechafin']);
            $actividad->_SET('dedicacion',$row['acti_dedicacion']);
            $actividad->_SET('idTipoPrograma',$row['tipr_id']);
            $actividad->_SET('estado',$row['acti_estado']);
            $actividad->_SET('idResponsable',$row['acti_responsable']);
            $actividad->_SET('abreviaturaDivision',$row['divi_abreviatura']);
            $actividad->_SET('descripcionTipoPrograma',$row['tipr_descripcion']);
            $actividad->_SET('descripcionTipoActividad',$row['tiac_descripcion']);

            $responsable = new Persona();

            $responsable->_SET('idUsuario',$row['usu_id']);
            $responsable->_SET('idTipoDocumento',$row['tido_id']);
            $responsable->_SET('abreviaturaTipoDocumento',$row['tido_abreviatura']);
            $responsable->_SET('nombre',$row['pers_nombre']);
            $responsable->_SET('apellido',$row['pers_apellido']);

            $actividad->_SET('responsable',$responsable);

            $lista[] = $actividad;
        }
        $conexion = null;
        return $lista;
    }

    /**
     * Metodo para listar actividades de una unidad especifica
     * @param $idUnidad identificador de la unidad
     * @return array lista con la informacion solicitada
     */
    public function listarActividadesPorUnidad($idUnidad,$path){
        include ($path.'bussines/DAO/Conection.php');
        require_once ($path.'bussines/DTO/Actividad.php');
        require_once ($path.'bussines/DTO/Persona.php');

        $consulta = " SELECT acti.acti_id, acti.unid_id, acti.acti_descripcion, acti.tiac_id, acti.acti_semestre, ";
        $consulta.= " acti.acti_ano, SUBSTRING_INDEX(SUBSTRING_INDEX(acti.acti_fechainicio, ' ', 1), ' ', -1) AS acti_fechainicio, ";
        $consulta.= " SUBSTRING_INDEX(SUBSTRING_INDEX(acti.acti_fechafin, ' ', 1), ' ', -1) AS acti_fechafin, acti.acti_dedicacion, ";
        $consulta.= " acti.tipr_id, acti.acti_estado, acti.acti_responsable, divi.divi_abreviatura, ";
        $consulta.= " tipr.tipr_descripcion, tiac.tiac_descripcion, tido.tido_abreviatura, pers.* ";
        $consulta.= " FROM siga.actividad acti ";
        $consulta.= " INNER JOIN siga.persona pers ON (pers.usu_id = acti.acti_responsable) ";
        $consulta.= " INNER JOIN siga.tipodocumento tido ON (tido.tido_id = pers.tido_id) ";
        $consulta.= " INNER JOIN siga.unidad unid ON (unid.unid_id = acti.unid_id) ";
        $consulta.= " INNER JOIN siga.division divi ON (divi.divi_id = unid.divi_id) ";
        $consulta.= " INNER JOIN siga.tipoprograma tipr ON (tipr.tipr_id = acti.tipr_id) ";
        $consulta.= " INNER JOIN siga.tipoactividad tiac ON (tiac.tiac_id = acti.tiac_id) ";
        $consulta.= " WHERE acti.unid_id = ? ";
        $consulta.= " ORDER BY acti.acti_fechainicio, acti.acti_id ; ";

        $result = $conexion->prepare($consulta);
        $result->execute(array($idUnidad));

        $lista = array();

        foreach ($result as $row){
            $actividad = new Actividad();

            $actividad->_SET('id',$row['acti_id']);
            $actividad->_SET('idUnidad',$row['unid_id']);
            $actividad->_SET('descripcion',$row['acti_descripcion']);
            $actividad->_SET('idTipoActividad',$row['tiac_id']);
            $actividad->_SET('semestre',$row['acti_semestre']);
            $actividad->_SET('anoActividad',$row['acti_ano']);
            $actividad->_SET('fechaInicio',$row['acti_fechainicio']);
            $actividad->_SET('fechaFin',$row['acti_fechafin']);
            $actividad->_SET('dedicacion',$row['acti_dedicacion']);
            $actividad->_SET('idTipoPrograma',$row['tipr_id']);
            $actividad->_SET('estado',$row['acti_estado']);
            $actividad->_SET('idResponsable',$row['acti_responsable']);
            $actividad->_SET('abreviaturaDivision',$row['divi_abreviatura']);
            $actividad->_SET('descripcionTipoPrograma',$row['tipr_descripcion']);
            $actividad->_SET('descripcionTipoActividad',$row['tiac_descripcion']);

            $responsable = new Persona();

            $responsable->_SET('idUsuario',$row['usu_id']);
            $responsable->_SET('idTipoDocumento',$row['tido_id']);
            $responsable->_SET('abreviaturaTipoDocumento',$row['tido_abreviatura']);
            $responsable->_SET('nombre',$row['pers_nombre']);
            $responsable->_SET('apellido',$row['pers_apellido']);

            $actividad->_SET('responsable',$responsable);

            $lista[] = $actividad;
        }
        $conexion = null;
        return $lista;
    }
}