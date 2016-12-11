<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 27/11/2016
 * Time: 11:01 PM
 */
class ControllerDivision
{
    /**  Metodo que carga el combo de unidades en base a una division seleccionada
     * @param $divi
     * @param $path
     * @return string
     */
    public function cargarComboUnidad($divi, $path){
        $procesar="";


        $usuario=$_SESSION['usuario'];

        if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==2 ||$_SESSION['tipo_usuario']==3){
            include_once ($path.'bussines/DAO/UnidadDAO.php');
            include_once ($path.'model/General.php');

            $unidadDAO = new UnidadDAO();
            $listaUnidades = $unidadDAO->listarUnidadesPorDivisionServices($divi, $path);

            if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==2 ){
                $procesar=$listaUnidades;
            }
            elseif($_SESSION['tipo_usuario']==3){
                $listaAux=array();

                foreach ($listaUnidades as $unid) {
                    $idCoordinadorU=$unid->_GET('coordinador')->_GET('idUsuario');

                    $idCurrentyUser=$usuario->_GET('id');

                    if(strcmp($idCoordinadorU, $idCurrentyUser)==0){
                        $listaAux[]=$unid;
                    }
                }

                $procesar=$listaAux;
            }
        }
        elseif ($_SESSION['tipo_usuario']==4){
            include_once ($path.'bussines/DAO/UnidadDAO.php');
            include_once ($path.'model/General.php');

            $unidadDAO = new UnidadDAO();
            $listaUnidades = $unidadDAO->listarUnidadesEncargadoActividad($divi, $usuario->_GET('id'), $path);

            $procesar=$listaUnidades;
        }

        $concat="<option value='-1'>Seleccione uno</option>";

        foreach ($procesar as $unid) {
            if(strcmp(($unid->_GET('estado')),'A')==0)
                $concat.='<option value="'.$unid->_GET('id').'">'.$unid->_GET('nombre').'</option>';
        }

        if(empty($concat)){
            return "<option value='-1'>No hay Unidades para cargar</option>";
        }

        return $concat;

    }

    /**  Metodo que carga el combo de actividades en base a una unidad seleccionada
     * @param $uni
     * @param $path
     * @return string
     */

    public function cargarComboActividad($uni, $path){

        $procesar="";
        $usuario=$_SESSION['usuario'];

        include_once ($path.'bussines/DAO/ActividadDAO.php');
        include_once ($path.'model/General.php');

        $actividadDAO = new ActividadDAO();
        $listaActividades = $actividadDAO->listarActividadesPorUnidad($uni, $path);

        if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==2 ||$_SESSION['tipo_usuario']==3){
            $procesar=$listaActividades;

        }
        elseif ($_SESSION['tipo_usuario']==4){
            $listaAux=array();

            foreach ($listaActividades as $actividad) {
                $idCoordinadorU=$actividad->_GET('responsable')->_GET('idUsuario');

                $idCurrentyUser=$usuario->_GET('id');

                if(strcmp($idCoordinadorU, $idCurrentyUser)==0){
                    $listaAux[]=$actividad;
                }
            }

            $procesar=$listaAux;
        }

        $concat="<option value='-1'>Seleccione uno</option>";

        foreach ($procesar as $unid) {
            if(strcmp(($unid->_GET('estado')),'A')==0)
                $concat.='<option value="'.$unid->_GET('id').'">'.$unid->_GET('descripcion').'</option>';
        }

        if(empty($concat)){
            return "<option value='-1'>No hay Unidades para cargar</option>";
        }

        return $concat;

    }

    /** Metodo que carga el combo de divisiones
     * @return string
     */
    public function cargarDivisionesGestionDivision(){
        include_once ("../".'bussines/DAO/DivisionDAO.php');
        include_once ("../".'model/General.php');

        //Si es un Admon o un tipo de usuario, la primera busqueda sirve normalmente
        /////////////////////////////////////////////////////////////////////////////
        if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==2 ){
            $divisionDAO =new DivisionDAO();
            $listaDivisiones = $divisionDAO->listarDivisiones();
            $listaComboDivisiones=Array();

            $usuario=$_SESSION['usuario'];

            if($_SESSION['tipo_usuario']==1){
                $listaComboDivisiones=$listaDivisiones;
            }
            else{
                foreach ($listaDivisiones as $div) {
                    $idJefeDiv=$div->_GET('jefe')->_GET('idUsuario');
                    $idCurrentyUser=$usuario->_GET('id');

                    if(strcmp($idJefeDiv, $idCurrentyUser)==0){
                        $listaComboDivisiones[]=$div;
                    }
                }
            }
            $concat="<option value='-1'>Seleccione uno</option>";

            foreach ($listaComboDivisiones as $div) {
                if(strcmp(($div->_GET('estado')),'A')==0)
                    $concat.='<option value="'.$div->_GET('id').'">'.$div->_GET('nombre').'</option>';
            }

            if(empty($concat)){
                return "<option value='-1'>No hay Divisiones para cargar</option>";
            }

            return $concat;
        }

        //Si es encargado de unidad carga las divisiones a las cuales pertenezcan las unidades que este tenga asignados
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        elseif($_SESSION['tipo_usuario']==3){
            $divisionDAO =new DivisionDAO();
            $idUsuario=$_SESSION['usuario']->_GET('id');
            $listaDivisiones = $divisionDAO->listarDivisionesEncargadoUnidad($idUsuario);
            $concat="<option value='-1'>Seleccione uno</option>";

            foreach ($listaDivisiones as $div) {
                if(strcmp(($div->_GET('estado')),'A')==0)
                    $concat.='<option value="'.$div->_GET('id').'">'.$div->_GET('nombre').'</option>';
            }

            if(empty($concat)){
                return "<option value='-1'>No hay Divisiones para cargar</option>";
            }

            return $concat;
        }
        elseif($_SESSION['tipo_usuario']==4){
            $divisionDAO =new DivisionDAO();
            $idUsuario=$_SESSION['usuario']->_GET('id');
            $listaDivisiones = $divisionDAO->listarDivisionesEncargadoActividad($idUsuario);
            $concat="";
            foreach ($listaDivisiones as $div) {
                if(strcmp(($div->_GET('estado')),'A')==0)
                    $concat.='<option value="'.$div->_GET('id').'">'.$div->_GET('nombre').'</option>';
            }

            if(empty($concat)){
                return "<option value='-1'>No hay Divisiones para cargar</option>";
            }

            return $concat;
        }

    }

    public function asignarJefeDivision($jefe, $division){
        include_once ('../../bussines/DAO/DivisionDAO.php');
        $usuarioDAO =new DivisionDAO();
        return  $usuarioDAO->asignarJefeDivision($jefe, $division);
    }

    public function actualizarDiv($nombre, $abr, $estado , $id){

        include_once ('../../bussines/DAO/DivisionDAO.php');

        $usuarioDAO =new DivisionDAO();
        return  $usuarioDAO->actualizarDiv($nombre, $abr, $estado, $id );

    }

    public function crearDivision($nombre, $abreviatura ){

        include_once ('../../bussines/DAO/DivisionDAO.php');

        $divisionDAO =new DivisionDAO();
        return $divisionDAO->crearDivision($nombre, $abreviatura);
    }

    public function getDivInformation($id, $path){
        include_once ($path.'bussines/DAO/DivisionDAO.php');
        include_once ($path.'model/General.php');

        $divisionDAO =new DivisionDAO();
        $listaDivisiones = $divisionDAO->listarDivisiones();


        $index=0;
        while($index<count($listaDivisiones)){
            if( $listaDivisiones[$index]->_GET('id')==$id ){
                return  $listaDivisiones[$index];
            }
            $index++;
        }

        return null;
    }

    public function getDivInformationService($id, $path){
        include_once ($path.'bussines/DAO/DivisionDAO.php');
        include_once ($path.'model/General.php');

        $divisionDAO =new DivisionDAO();
        $listaDivisiones = $divisionDAO->listarDivisionesService($path);


        $index=0;
        while($index<count($listaDivisiones)){
            if( $listaDivisiones[$index]->_GET('id')==$id ){
                return  $listaDivisiones[$index];
            }
            $index++;
        }

        return null;
    }


    /**
     * Metodo para listar las divisiones registradas en el sistema
     * @param $path rita para acceder archivos
     * @return string codigo HTML para mostrar la informacion
     */
    public function listarDivisiones($path){
        include_once ($path.'bussines/DAO/DivisionDAO.php');
        include_once ($path.'model/General.php');

        $divisionDAO =new DivisionDAO();
        $listaDivisiones = $divisionDAO->listarDivisiones();

        $table = " <table  id='tabla-usuarios' class='table table-bordered table-hover'> ";
        $table.= " <thead> ";
        $table.= " <tr> ";
        $table.= " <td>Abreviatura</td> ";
        $table.= " <td>Descripción</td> ";
        $table.= " <td>Jefe de division</td> ";
        $table.= " <td>Estado</td> ";
        $table.= " <td>Acciones</td> ";
        $table.= " </tr> ";
        $table.= " </thead> ";

        if(count($listaDivisiones)>0){
            $table.= " <tbody> ";
            foreach ($listaDivisiones as $division){
                $estado="";
                if(strcmp(($division->_GET('estado')),'A')==0){
                    $estado="Activo";
                }
                else{
                    $estado="Desactivado";
                }

                $persona= $division->_GET('jefe');
                $encrypt = encriptar($division->_GET('id'));
                $boss = encriptar($persona->_GET('idUsuario'));
                $table.= " <tr> ";
                $table.= " <td>".$division->_GET('abreviatura')."</td> ";
                $table.= " <td>".$division->_GET('nombre')."</td> ";
                $table.= " <td>".$persona->_GET('nombre')." ".$persona->_GET('apellido')."</td> ";
              $table.= " <td>".$estado."</td> ";
                $table.= " <td><a href='editarDivision.php?divi=$encrypt'>Editar</a> | <a href='asignarJefe.php?divi=$encrypt&jefe=$boss'>Cambiar Jefe</a></td> ";
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
        $table.= " <td>Abreviatura</td> ";
        $table.= " <td>Descripción</td> ";
        $table.= " <td>Jefe de division</td> ";
       $table.= " <td>Estado</td> ";
        $table.= " <td>Acciones</td> ";
        $table.= " </tr> ";
        $table.= " </tfoot> ";
        $table.= " </table> ";

        return $table;
    }
}