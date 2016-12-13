<?php
require_once '../bussines/DTO/Usuario.php';
require_once '../bussines/DTO/Persona.php';
require_once '../fachade/FachadeOne.php';

$activo="";
$inactivo="";

session_start();

if(isset($_GET['unid'])){
    include_once ('../model/General.php');

    $id_unid= ($_GET['unid']);
    $facade = new FachadeOne();

    $unidad=$facade->getUnidadInformation($id_unid, "../");

    if($unidad==null){
        header("Location: gestionar-division.php");
    }

    $estado=$unidad->_GET('estado');

    if(strcmp($estado,"A")==0){
        $activo="selected";

    }
    else{
        $inactivo="selected";
    }



}

$facade = new FachadeOne();

?>


<!DOCTYPE html>
<html>

     <?php
         include('html/head.html');
      ?>

    <body class="skin-red">
      
        <div class="wrapper">
            <!-- Encabezado -->
            
            <?php
              include('html/headerIndex.php');
            ?>

            <!-- aca va la barra lateral -->
            <?php
              include('html/barraLateralUser.php');
            ?>

            <!-- Columna derecha. contiene navbar y la ruta de la pagina -->
            <div class="content-wrapper inicio">
                <!-- Encabezado -->


                <!-- Contenido Principal de la pagina-->
                <section class="content">
                    <!-- Incluir aqui el contenido-->
                    <br>

                    <div class="login-logo titulo" style="color: #fff;">
                        <b><a href="#" style="color:#dd4b39">Editar Unidad</a></b>
                    </div><!-- /.login-logo -->
                    <br>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="box box-warning">
                                <div class="box-body">
                                    <form role="form" action="scripts/scriptEditarUnidad.php" method="post">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Nombre de la Unidad</label>
                                            <input type="text" class="form-control" value='<?php echo $unidad->_GET('nombre'); ?>' placeholder="Nombre de la unidad" id="unid_name" name="unid_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Abreviatura de la Unidad</label>
                                            <input type="text" class="form-control" value='<?php echo $unidad->_GET('abreviatura'); ?>' placeholder="Abreviatura de la Unidad" id="unid_abr" name="unid_abr" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Codigo de la Unidad</label>
                                            <input type="text" class="form-control" value='<?php echo $unidad->_GET('codigo'); ?>' placeholder="Codigo de la Unidad" id="unid_cod" name="unid_cod" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <select class="form-control" id=rol name="unid_status" required="">
                                                <option value>Seleccione el estado de la unidad</option>
                                                <option value="A" <?php echo $activo;?>>Activo</option>
                                                <option value="D" <?php echo $inactivo;?>>Inactivo</option>

                                            </select>
                                        </div>

                                        <div class="box-footer">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-2 col-md-offset-5">
                                                        <input type="submit" class="btn btn-primary" value="Editar"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" value='<?php echo $_GET['unid']; ?>' name="unid"/>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </section><!-- /.contenido principal-->

            </div><!-- /.content-wrapper -->
            
            <!-- Pie de pagina -->
            
        <?php
              include('html/footer.php');
            ?>
        </div><!-- wrapper-->


        <!-- Funciones js -->

        <!-- jQuery 2.1.3 -->
        <script src="./js/plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <!-- jQuery UI 1.11.2 -->
        <script src="./js/plugins/jQueryUI/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="./js/bootstrap/bootstrap.min.js" type="text/javascript"></script>   
        <!-- AdminLTE App Oculta el menu-->
        <script src="./js/app/app.min.js" type="text/javascript"></script>
        <script src="./js/app/main.js" type="text/javascript"></script>
        <script src="./js/alertify.min.js"></script>

        <!-- Cosas de la tabla -->
        <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js" type="text/javascript"></script>

        <!-- Cosas de los botones -->
        <script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.colVis.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js" type="text/javascript"></script>

        <script src="js/jszip.js" type="text/javascript"></script>

    </body>

</html>
