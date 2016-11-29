<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 27/11/2016
 * Time: 09:51 PM
 */
class ControllerUsuario
{

    /**
     * Metodo para listar los usuarios registrados en el sistema
     * @param $path rita para acceder archivos
     * @return string codigo HTML para mostrar la informacion
     */
    public function listarUsuarios(){
        include_once ('../bussines/DAO/UsuarioDAO.php');
        include_once ('../model/General.php');

        $usuarioDAO =new UsuarioDAO();
        $listaUsuarios = $usuarioDAO->listarUsuarios();

        $table = " <table id='tabla-usuarios' class='table table-bordered table-hover'> ";
        $table.= " <thead> ";
        $table.= " <tr> ";
        $table.= " <td>NOMBRE</td> ";
        $table.= " <td>APELLIDO</td> ";
        $table.= " <td>DOCUMENTO</td> ";
        $table.= " <td>ESTADO</td> ";
        $table.= " <td>ACCIONES</td> ";
        $table.= " </tr> ";
        $table.= " </thead> ";

        if(count($listaUsuarios)>0){
            $table.= " <tbody> ";
            foreach ($listaUsuarios as $usuario){
                $persona= $usuario->_GET('persona');
                $encrypt = encriptar($usuario->_GET('id'));

                $table.= " <tr> ";
                $table.= " <td style='text-align: center'>".$persona->_GET('nombre')."</td> ";
                $table.= " <td style='text-align: center'>".$persona->_GET('apellido')."</td> ";
                $table.= " <td style='text-align: center'>".$persona->_GET('abreviaturaTipoDocumento')." ".$persona->_GET('numeroDocumento')."</td> ";
                $table.= " <td style='text-align: center'>".$usuario->_GET('estado')."</td> ";
                $table.= " <td style='text-align: center'><a href='editarUsuario.php?user=$encrypt'>Editar</a> </td> ";
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





}