<?php
/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 24/11/2016
 * Time: 07:11 PM
 */
class UsuarioDAO
{

    public function actualizarUsuario($nombre, $apellido, $tipoDoc, $doc, $pass,$id, $estado){

        try {

            include_once ('../../bussines/DAO/Conection.php');
            $consulta ='UPDATE siga.usuario SET usu_pass="'.$pass.'", usu_nick="'.$doc.'", usu_estado="'.$estado.'" WHERE usu_id="'.$id.'"';
            echo $consulta."<br>";
            $result=$conexion->prepare($consulta);
            $result->execute();

            $consulta ='UPDATE siga.persona SET pers_nombre="'.$nombre.'", pers_apellido="'.$apellido.'", pers_numdocumento="'.$doc.'", tido_id="'.$tipoDoc.'" WHERE usu_id="'.$id.'"';
            $result=$conexion->prepare($consulta);
            $result->execute();

            return "0";
        } catch (Exception $e) {
            echo "1";
        }


    }

    public function crearUsuario($nombre, $apellido, $tipoDoc, $doc, $pass){

       try {

            include_once ('../../bussines/DAO/Conection.php');
            $consulta='INSERT INTO siga.usuario(usu_pass, usu_nick, usu_estado, usu_registradopor) VALUES(?,?,?,?)';
            $result=$conexion->prepare($consulta);

            $result->execute(array($pass,$doc,"A",1));

            $consulta="Select MAX(Usuario.usu_id) from Usuario";
            $result=$conexion->prepare($consulta);
            $result->execute(array());
            $id=$result->fetchColumn();


            $consulta='INSERT INTO siga.persona(usu_id,pers_nombre, pers_apellido, pers_numdocumento, tido_id, pers_registradopor) VALUES(?,?,?,?,?,?)';
            $result=$conexion->prepare($consulta);

            $result->execute(array($id,$nombre,$apellido, $doc,$tipoDoc, 1));

            return "0";
       } catch (Exception $e) {
           return "1";
       }


    }

    /**
     * Metodo para registrar una nueva actividad
     * @param $actividad datos a registrar
     * @return string mensaje de registro
     */
    public function registrarActividad($actividad,$path){
        include_once ($path.'bussines/DAO/Conection.php');

        Conection::getInstance();
        $consulta =" INSERT INTO actividad (unid_id,acti_descripcion,tiac_id,acti_semestre,acti_ano,acti_fechainicio,acti_fechafin,acti_dedicacion,tipr_id,acti_estado,acti_responsable,acti_registradopor) ";
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


 public function iniciarSesionEncargadoDiv($usuario, $tipo){
     include_once ('Conection.php');
     $consulta="SELECT persona.usu_id, persona.pers_nombre, persona.pers_apellido, persona.pers_numdocumento
     from persona, usuario
     where usuario.usu_nick=? AND usuario.usu_pass=? AND usuario.usu_estado='A' AND usuario.usu_id=persona.usu_id AND persona.tido_id=?";

     $result = $conexion->prepare($consulta);
     $result->execute(array($usuario->_GET('nick'), $usuario->_GET('contrasena'), $tipo));
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

    public function iniciarSesionEncargadoUni($usuario, $tipo){
        include_once ('Conection.php');
        $consulta="SELECT persona.usu_id, persona.pers_nombre, persona.pers_apellido, persona.pers_numdocumento
     from persona, usuario
     where usuario.usu_nick=? AND usuario.usu_pass=? AND usuario.usu_estado='A' AND usuario.usu_id=persona.usu_id AND persona.tido_id=?";

        $result = $conexion->prepare($consulta);
        $result->execute(array($usuario->_GET('nick'), $usuario->_GET('contrasena'), $tipo));
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
            $result = $conexion->prepare($consulta);
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

    public function iniciarSesionEncargadoAct($usuario, $tipo){
        include_once ('Conection.php');
        $consulta="SELECT persona.usu_id, persona.pers_nombre, persona.pers_apellido, persona.pers_numdocumento
     from persona, usuario
     where usuario.usu_nick=? AND usuario.usu_pass=? AND usuario.usu_estado='A' AND usuario.usu_id=persona.usu_id AND persona.tido_id=?";

        $result = $conexion->prepare($consulta);
        $result->execute(array($usuario->_GET('nick'), $usuario->_GET('contrasena'), $tipo));
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
    public function listarUsuarios(){
        include ('Conection.php');
        require_once ('../bussines/DTO/Usuario.php');
        require_once ('../bussines/DTO/Persona.php');

        $consulta = " SELECT usu.*, pers.*, tido.tido_abreviatura ";
        $consulta.= " FROM usuario usu ";
        $consulta.= " LEFT JOIN persona pers ON (pers.usu_id = usu.usu_id) ";
        $consulta.= " LEFT JOIN tipodocumento tido ON (tido.tido_id = pers.tido_id) ";

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

            $persona->_SET('idUsuario',$row['usu_id']);
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