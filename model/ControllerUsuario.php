<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 27/11/2016
 * Time: 09:51 PM
 */
class ControllerUsuario
{

    public function cargarAllUsers($selected, $division){
        include_once ('../bussines/DAO/UsuarioDAO.php');
        include_once ('../model/General.php');

        $usuarioDAO =new UsuarioDAO();
        $listaUsuarios = $usuarioDAO->listarUsuarios();
        $table="";
        foreach ($listaUsuarios as $usuario){

            if(strcmp($usuario->_GET('id'),"1")!=0 && strcmp(($usuario->_GET('estado')),'A')==0 && strcmp($usuario->_GET('id'),$selected)!=0){

                $persona= $usuario->_GET('persona');
                $encrypt = encriptar($usuario->_GET('id'));

                $table.= " <tr> ";
                $table.= " <td>".$persona->_GET('nombre')."</td> ";
                $table.= " <td>".$persona->_GET('apellido')."</td> ";
                $table.= " <td >".$persona->_GET('abreviaturaTipoDocumento')." ".$persona->_GET('numeroDocumento')."</td> ";
                $table.= " <td ><a href='scripts/scriptAsignarJefe.php?nuevoJ=$encrypt&divi=".$division."'>Seleccionar</a> </td> ";
                $table.= " </tr> ";
            }
        }

        return $table;
    }


    public function cargarAllUsersForUnidad($selected, $unid){
        include_once ('../bussines/DAO/UsuarioDAO.php');
        include_once ('../model/General.php');

        $usuarioDAO =new UsuarioDAO();
        $listaUsuarios = $usuarioDAO->listarUsuarios();
        $table="";
        foreach ($listaUsuarios as $usuario){

            if(strcmp($usuario->_GET('id'),"1")!=0 && strcmp(($usuario->_GET('estado')),'A')==0 && strcmp($usuario->_GET('id'),$selected)!=0){

                $persona= $usuario->_GET('persona');
                $encrypt = encriptar($usuario->_GET('id'));

                $table.= " <tr> ";
                $table.= " <td>".$persona->_GET('nombre')."</td> ";
                $table.= " <td>".$persona->_GET('apellido')."</td> ";
                $table.= " <td >".$persona->_GET('abreviaturaTipoDocumento')." ".$persona->_GET('numeroDocumento')."</td> ";
                $table.= " <td ><a href='scripts/scriptAsignarResponsable.php?nuevoJ=$encrypt&act=".$unid."'>Seleccionar</a> </td> ";
                $table.= " </tr> ";
            }
        }

        return $table;
    }


    public function actualizarUser($nombre, $apellido, $tipoDoc, $doc, $pass,$id, $estado ){

        include_once ('../../bussines/DAO/UsuarioDAO.php');

        $usuarioDAO =new UsuarioDAO();
       return  $usuarioDAO->actualizarUsuario($nombre, $apellido, $tipoDoc, $doc, $pass,$id, $estado);

    }

    public function crearUser($nombre, $apellido, $tipoDoc, $doc, $pass){

        include_once ('../../bussines/DAO/UsuarioDAO.php');

        $usuarioDAO =new UsuarioDAO();
        return  $usuarioDAO->crearUsuario($nombre, $apellido, $tipoDoc, $doc, $pass);

    }

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
        $table.= " <td>Nombre</td> ";
        $table.= " <td>Apellido</td> ";
        $table.= " <td>Documento</td> ";
        $table.= " <td>Estado</td> ";
        $table.= " <td>Acciones</td> ";
        $table.= " </tr> ";
        $table.= " </thead> ";

        if(count($listaUsuarios)>0){
            $table.= " <tbody> ";
            foreach ($listaUsuarios as $usuario){

                if(strcmp($usuario->_GET('id'),"1")!=0){
                $estado="";
                if(strcmp(($usuario->_GET('estado')),'A')==0){
                    $estado="Activo";
                }
                else{
                    $estado="Desactivado";
                }

                $persona= $usuario->_GET('persona');
                $encrypt = encriptar($usuario->_GET('id'));

                $table.= " <tr> ";
                $table.= " <td>".$persona->_GET('nombre')."</td> ";
                $table.= " <td>".$persona->_GET('apellido')."</td> ";
                $table.= " <td >".$persona->_GET('abreviaturaTipoDocumento')." ".$persona->_GET('numeroDocumento')."</td> ";
                $table.= " <td>".($estado) ."</td> ";
                $table.= " <td ><a href='editarUsuario.php?user=$encrypt'>Editar</a> </td> ";
                $table.= " </tr> ";
                }
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
        $table.= " <td>Nombre</td> ";
        $table.= " <td>Apellido</td> ";
        $table.= " <td>Documento</td> ";
        $table.= " <td>Estado</td> ";
        $table.= " <td>Acciones</td> ";
        $table.= " </tr> ";
        $table.= " </tfoot> ";
        $table.= " </table> ";

        return $table;
    }

    public function getUserInformation($id, $path){
        include_once ('../bussines/DAO/UsuarioDAO.php');
        include_once ('../bussines/DTO/Usuario.php');

        $usuarioDAO =new UsuarioDAO();
        $listaUsuarios = $usuarioDAO->listarUsuarios();

        $index=0;
        while($index<count($listaUsuarios)){
            if( $listaUsuarios[$index]->_GET('id')==$id ){
                return  $listaUsuarios[$index];
            }
            $index++;
        }

        return null;


    }

    public function cargarSelectorUsuario($id_usuario){

        $puestoTrabajoDao=new puesto_trabajo_dao();

        $puestos=$puestoTrabajoDao->cargarPuestosTrabajoMina($id_manto);

        $concat='';

        foreach($puestos as $row){

            $concat.='<tr>
                        <td>'.$row->_GET('tipo_puesto_trabajo1')->_GET('nombre').' '.$row->_GET('nombre1').'</td>
                        <td>'.$row->_GET('tipo_puesto_trabajo2')->_GET('nombre').' '.$row->_GET('nombre2').'</td>
                        <td>'.$row->_GET('tipo_puesto_trabajo3')->_GET('nombre').' '.$row->_GET('nombre3').'</td>
                      <td><input type="radio" name="identificador" value="'.$row->_GET('id').'" required>
                      </tr>';
        }

        if(empty($concat)){
            return "No hay puestos de trabajo registrados";
        }
        return '<table id="empleados" class="table table-bordered table-hover">
                                      <thead>
                                      <tr>
                                          <th>Nombre del lugar 1</th>
                                          <th>Nombre del lugar2</th>
                                          <th>Nombre del lugar 3</th>
                                          <th>accion</th>
                                      </tr>
                                      </thead>
                                      <tbody id="tablita">'.$concat.'                                          </tbody>
                                      <tfoot>
                                      <tr>
                                          <th>Nombre del lugar 1</th>
                                          <th>Nombre del lugar2</th>
                                          <th>Nombre del lugar 3</th>
                                          <th>accion</th>
                                      </tr>
                                      </tfoot>
                                  </table>';


    }





}