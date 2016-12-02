<?php

/**
 * Created by PhpStorm.
 * User: W7HOME
 * Date: 30/11/2016
 * Time: 10:18 PM
 */
class ControllerActividad
{

    public function getActInformation($id, $path){
        include_once ($path.'bussines/DAO/ActividadDAO.php');

        $actdDao =new ActividadDAO();
        $act = $actdDao->getActividadByID($id, $path);

        return $act;
    }
    public function  actualizarActividad($nombre, $tipoAct, $tipoProg, $anio, $sem, $f_ini, $f_fin, $dedic, $acti , $status){
        include_once ('../../bussines/DAO/ActividadDAO.php');
        $actividadDAO = new ActividadDAO();
        $datos=array($nombre, $tipoAct, $sem, $anio, $f_ini, $f_fin, $dedic, $tipoProg, $status);
        return $actividadDAO->actualizarActividad($datos,$acti, "../../");
    }

    public function  crearActividad($nombre, $tipoAct, $tipoProg, $anio, $sem, $f_ini, $f_fin, $dedic, $uni ){

        include_once ('../../bussines/DAO/ActividadDAO.php');
        $actividadDAO = new ActividadDAO();
        $datos=array($uni, $nombre, $tipoAct, $sem, $anio, $f_ini, $f_fin, $dedic, $tipoProg);
        return $actividadDAO->registrarActividad($datos, "../../");
    }

    public function getComboTipoActividad(){
        include_once ('../bussines/DAO/ActividadDAO.php');
        $actividadDAO = new ActividadDAO();

        $listadoActividades=$actividadDAO->getTipoActividades();
        $concat="";

        foreach ($listadoActividades as $ta) {

                $concat.='<option value="'.$ta->_GET('id').'">'.$ta->_GET('descripcion').'</option>';
        }

        if(empty($concat)){
            return "<option value>No hay Tipos de actividad a cargar para cargar</option>";
        }

        return "<option value>Selecciona uno</option>".$concat;

    }

    public function getComboTipoActividadSelected($id){
        include_once ('../bussines/DAO/ActividadDAO.php');
        $actividadDAO = new ActividadDAO();

        $listadoActividades=$actividadDAO->getTipoActividades();
        $concat="";

        foreach ($listadoActividades as $ta) {
            if($ta->_GET('id')==$id)
                $concat.='<option value="'.$ta->_GET('id').'" selected>'.$ta->_GET('descripcion').'</option>';
            else
            $concat.='<option value="'.$ta->_GET('id').'">'.$ta->_GET('descripcion').'</option>';
        }

        if(empty($concat)){
            return "<option value>No hay Tipos de actividad a cargar para cargar</option>";
        }

        return "<option value>Selecciona uno</option>".$concat;

    }


    public function getComboPrograma(){
        include_once ('../bussines/DAO/ActividadDAO.php');
        $actividadDAO = new ActividadDAO();

        $listadoActividades=$actividadDAO->getProg();
        $concat="";

        foreach ($listadoActividades as $ta) {

            $concat.='<option value="'.$ta->_GET('id').'">'.$ta->_GET('descripcion').'</option>';
        }

        if(empty($concat)){
            return "<option value>No hay Tipos de actividad a cargar para cargar</option>";
        }

        return "<option value>Selecciona uno</option>".$concat;

    }

    public function getComboProgramaSelected($id){
        include_once ('../bussines/DAO/ActividadDAO.php');
        $actividadDAO = new ActividadDAO();

        $listadoActividades=$actividadDAO->getProg();
        $concat="";

        foreach ($listadoActividades as $ta) {
            if($ta->_GET('id')==$id)
                $concat.='<option value="'.$ta->_GET('id').'" selected>'.$ta->_GET('descripcion').'</option>';
            else
                $concat.='<option value="'.$ta->_GET('id').'">'.$ta->_GET('descripcion').'</option>';
        }

        if(empty($concat)){
            return "<option value>No hay Tipos de actividad a cargar para cargar</option>";
        }

        return "<option value>Selecciona uno</option>".$concat;

    }

    /**
     * Metodo para listar las actividades de una unidad del sistema
     * @param $idUnidad identificador de la unidad
     * @return string codigoHTML con la informacion
     */
    public function listarActividadPorUnidad($idUnidad, $path){
        include_once ($path.'bussines/DAO/ActividadDAO.php');
        include_once ($path.'model/General.php');

        $actividadDAO = new ActividadDAO();

        $listaActividad = $actividadDAO->listarActividadesPorUnidad($idUnidad, $path);

        $table = " <table id='tabla-actividades' name='tabla-actividades' class='table table-bordered table-hover'> ";
        $table.= " <thead> ";
        $table.= " <tr> ";
        $table.= " <th>ACTIVIDAD</th> ";
        $table.= " <th>RESPONSABLE</th> ";
        $table.= " <th>SEMESTRE</th> ";
        $table.= " <th>AÑO</th> ";
        $table.= " <th >FECHA INICIO</th> ";
        $table.= " <th >FECHA FIN</th> ";
        $table.= " <th >ESTADO</th> ";
        $table.= " <th >ACCIONES</th> ";
        $table.= " </tr> ";
        $table.= " </thead> ";

        if(count($listaActividad)>0){
            $table.= " <tbody> ";
            foreach ($listaActividad as $actividad){

                $responsable = $actividad->_GET('responsable');
                $encrypt = encriptar($actividad->_GET('id'));

                $table.= " <tr> ";
                $table.= " <td style='text-align: center'>".$actividad->_GET('descripcion')."</td> ";
                $table.= " <td style='text-align: center'>".$responsable->_GET('nombre')." ".$responsable->_GET('apellido')."</td> ";
                $table.= " <td style='text-align: center'>".$actividad->_GET('semestre')."</td> ";
                $table.= " <td style='text-align: center'>".$actividad->_GET('anoActividad')."</td> ";
                $table.= " <td style='text-align: center'>".$actividad->_GET('fechaInicio')."</td> ";
                $table.= " <td style='text-align: center'>".$actividad->_GET('fechaFin')."</td> ";
                $table.= " <td style='text-align: center'>".$actividad->_GET('estado')."</td> ";
                $table.= " <td style='text-align: center'><a href='editarActividad.php?acti=$encrypt'>Editar</a> | <a href='asignarResponsable.php?acti=$encrypt&jefe=".$responsable->_GET('idUsuario')."'>Cambiar Responsable</a></td> ";
                $table.= " </tr> ";
            }
            $table.= " </tbody> ";
            $table.= " <tfoot> ";
            $table.= " <tr> ";
            $table.= " <th>ACTIVIDAD</th> ";
            $table.= " <th>RESPONSABLE</th> ";
            $table.= " <th >SEMESTRE</th> ";
            $table.= " <th>AÑO</th> ";
            $table.= " <th >FECHA INICIO</th> ";
            $table.= " <th >FECHA FIN</th> ";
            $table.= " <th >ESTADO</th> ";
            $table.= " <th >ACCIONES</th> ";
            $table.= " </tr> ";
            $table.= " </tfoot> ";
        }else{

            $table.= " <tbody> ";
            $table.= " <tr> ";
            $table.= " <td colspan='8'>No hay registros en el sistema</td>";
            $table.= " </tr> ";
            $table.= " </tbody> ";
        }
        $table.= " </table> ";

        return $table;
    }
}