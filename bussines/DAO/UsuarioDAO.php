<?php
/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 24/11/2016
 * Time: 07:11 PM
 */
class UsuarioDAO
{
    /**
     * Metodo para registrar una nueva actividad
     * @param $actividad datos a registrar
     * @return string mensaje de registro
     */
    public function registrarActividad($actividad,$path){
        include_once ($path.'bussines/DAO/Conection.php');

        Conection::getInstance();
        $consulta =" INSERT INTO siga.actividad (unid_id,acti_descripcion,tiac_id,acti_semestre,acti_ano,acti_fechainicio,acti_fechafin,acti_dedicacion,tipr_id,acti_estado,acti_responsable,acti_registradopor) ";
        $consulta .=" VALUES (?,?,?,?,?,?,?,?,?,?,?,?); ";
        $result = Conection::$_conexion->prepare($consulta);
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
        Conection::closeInstance();
        return "Registro de Actividad exitoso";
    }


 public function iniciarSesionEncargadoDiv($usuario){
     include_once ('Conection.php');
     $consulta="SELECT persona.usu_id, persona.pers_nombre, persona.pers_apellido, persona.pers_numdocumento
     from persona, usuario
     where usuario.usu_nick=? AND usuario.usu_pass=? AND usuario.usu_id= persona.usu_id";
     $result = $conexion->prepare($consulta);
     $result->execute(array($usuario->_GET('nick'), $usuario->_GET('contrasena')));
     $usuario->_SET("id",false);
     foreach ($result as $row){
         $persona=new Persona();
         $persona->_SET("nombre",$row[1]);
         $persona->_SET("apellido",$row[2]);
         $persona->_SET("numeroDocumento",$row[3]);
         $usuario->_SET("id",$row[0]);
         $usuario->_SET("persona",$persona);
     }
      if($usuario->_GET("id")!=false){
        $consulta="Select COUNT(*) from division where division.divi_jefe=". $usuario->_GET('id');
        $result = $conexion->prepare($consulta);
        $result->execute(array($usuario->_GET('nick'), $usuario->_GET('contrasena')));
        $cantidadDivisiones=$result->fetchColumn();
        if($cantidadDivisiones>0){
            return true;
        }
        else{
            return "Actualmente no posee este rol asignado a ninguna division del sistema";
        }
     }
     else{
         return "Los datos ingresados son incorrectos";
     }
 }


    public function iniciarSesionEncargadoUni($usuario){
        include_once ('Conection.php');
        $consulta="SELECT persona.usu_id, persona.pers_nombre, persona.pers_apellido, persona.pers_numdocumento
     from persona, usuario
     where usuario.usu_nick=? AND usuario.usu_pass=? AND usuario.usu_id= persona.usu_id";
        $result = $conexion->prepare($consulta);
        $result->execute(array($usuario->_GET('nick'), $usuario->_GET('contrasena')));

        $usuario->_SET("id",false);
        foreach ($result as $row){
            $persona=new Persona();
            $persona->_SET("nombre",$row[1]);
            $persona->_SET("apellido",$row[2]);
            $persona->_SET("numeroDocumento",$row[3]);
            $usuario->_SET("id",$row[0]);
            $usuario->_SET("persona",$persona);
        }

        if($usuario->_GET("id")!=false){
            $consulta="Select COUNT(*) from unidad where unidad.unid_coordinador=". $usuario->_GET('id');
            $result = Conection::$_conexion->prepare($consulta);
            $result->execute(array($usuario->_GET('nick'), $usuario->_GET('contrasena')));
            $cantidadDivisiones=$result->fetchColumn();
            if($cantidadDivisiones>0){
                return true;
            }
            else{
                return "Actualmente no posee este rol asignado a ninguna unidad del sistema";
            }
        }
        else{
            return "Los datos ingresados son incorrectos";
        }
    }

    public function iniciarSesionEncargadoAct($usuario){
        include_once ('Conection.php');
        $consulta="SELECT persona.usu_id, persona.pers_nombre, persona.pers_apellido, persona.pers_numdocumento
     from persona, usuario
     where usuario.usu_nick=? AND usuario.usu_pass=? AND usuario.usu_id= persona.usu_id";
        $result = $conexion->prepare($consulta);
        $result->execute(array($usuario->_GET('nick'), $usuario->_GET('contrasena')));
        $usuario->_SET("id",false);
        foreach ($result as $row){
            $persona=new Persona();
            $persona->_SET("nombre",$row[1]);
            $persona->_SET("apellido",$row[2]);
            $persona->_SET("numeroDocumento",$row[3]);
            $usuario->_SET("id",$row[0]);
            $usuario->_SET("persona",$persona);
        }

        if($usuario->_GET("id")!=false){
            $consulta="Select COUNT(*) from actividad where actividad.acti_responsable=". $usuario->_GET('id');
            $result = $conexion->prepare($consulta);
            $result->execute(array($usuario->_GET('nick'), $usuario->_GET('contrasena')));
            $cantidadDivisiones=$result->fetchColumn();
            if($cantidadDivisiones>0){
                return true;
            }
            else{
                return "Actualmente no posee este rol asignado a ninguna actividad del sistema";
            }
        }
        else{
            return "Los datos ingresados son incorrectos";
        }
    }
    /**
     * Metodo para listar los usuario del sitema
     * @param $path ruta para el acceso de los archivos desde donde se envia la solicitud
     * @return array lista con la informacion de los usuario registrados en el sistema
     */
    public function listarUsuarios($path){
        include ($path.'bussines/DAO/Conection.php');
        require_once ($path.'bussines/DTO/Usuario.php');
        require_once ($path.'bussines/DTO/Persona.php');

        $consulta = " SELECT usu.*, pers.*, tido.tido_abreviatura ";
        $consulta.= " FROM siga.usuario usu ";
        $consulta.= " LEFT JOIN siga.persona pers ON (pers.pers_usu_id = usu.usu_id) ";
        $consulta.= " LEFT JOIN siga.tipodocumento tido ON (tido.tido_id = pers.tido_id) ";

        $result = $conexion->query($consulta);
        //$result->excute();

        $lista = array();

        foreach ($result as $row){
            $usuario = new Usuario();

            $usuario->_SET('id',$row['usu_id']);
            $usuario->_SET('nick',$row['usu_nick']);
            $usuario->_SET('contrasena',$row['usu_pass']);
            $usuario->_SET('estado',$row['usu_estado']);

            $persona = new Persona();

            $persona->_SET('idUsuario',$row['pers_usu_id']);
            $persona->_SET('nombre',$row['pers_nombre']);
            $persona->_SET('apellido',$row['pers_apellido']);
            $persona->_SET('idTipoDocumento',$row['tido_id']);
            $persona->_SET('abreviaturaTipoDocumento',$row['tido_abreviatura']);
            $persona->_SET('numeroDocumento',$row['pers_numdocumento']);

            $usuario->_SET('persona', $persona);

            $lista[]=$usuario;
        }

        $conexion=null;
        return $lista;

    }

}