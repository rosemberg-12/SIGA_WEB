<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 26/11/2016
 * Time: 10:51 PM
 */
class ControllerSession
{
    /** Metodo que consulta si dado un documento, una contraseña y un tipo de usuario, estos datos concuerdan con algun tipo de usuario en
     * sistema, de ser así inicia la sesión y devuelve un estado positivo de la transacción
     * @param $documento documento del usuario
     * @param $contrasena contraseña del usuario
     * @param $tipo tipo de usuario con el que va a entrar
     */
public function iniciarSesion($tipo, $documento, $contrasena, $tipoDoc){

    require_once '../bussines/DTO/Usuario.php';
    require_once '../bussines/DTO/Persona.php';
    require_once '../bussines/DAO/UsuarioDAO.php';
    $usuario= new Usuario();
    $usuario->_SET("nick",$documento);
    $usuario->_SET("contrasena", $contrasena);
    $usuarioDao= new UsuarioDAO();
    $resultado=false;
    switch($tipo){
        case 1:
            if(strcmp($usuario->_GET("nick"), "administrador" )==0 && strcmp($usuario->_GET("contrasena"), "ufpsBienestar" )==0)
                $resultado=true;
            else
                $resultado="Datos de administrador invalidos";
            break;
        case 2:
            $resultado= $usuarioDao->iniciarSesionEncargadoDiv($usuario, $tipoDoc);
            break;
        case 3:
            $resultado=$usuarioDao->iniciarSesionEncargadoUni($usuario, $tipoDoc);
            break;
        case 4:
            $resultado=$usuarioDao->iniciarSesionEncargadoAct($usuario, $tipoDoc);
            break;
    }
    if ($resultado==true){
        $_SESSION['usuario']=$usuario;
        $_SESSION['tipo_usuario']=$tipo;
    }

    return $resultado;
}
}