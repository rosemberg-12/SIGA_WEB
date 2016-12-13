<?php
require_once '../bussines/DTO/Usuario.php';
require_once '../bussines/DTO/Persona.php';
require_once '../fachade/FachadeOne.php';


session_start();
$muestra="";
if(isset($_GET['estado'])){

    if($_GET['estado']==0)
        $muestra= '<script type="text/javascript">alertify.success("Operación completada");</script>';
    else
        $muestra= '<script type="text/javascript">alertify.error("Ha ocurrido un error");</script>';
}

$facade = new FachadeOne();

$comboDivisiones=$facade->cargarDivisionesGestionDivision();

?>


<!DOCTYPE html>
<html lang="es">

     <?php
         include('html/head.html');
      ?>

    <body class="skin-red">
    <div class="modal"><!-- Place at bottom of page --></div>
      
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


                <!-- Contenido Principal de la pagina -->
                <section class="content">
                    <!-- Incluir aqui el contenido-->
                    <br>

                    <div class="login-logo titulo" style="color: #fff;">
                       <b><a href="#" style="color:#dd4b39">Gestionar unidad</a></b>
                    </div><!-- /.login-logo -->
                    <br>

                    <div class="row">


                        <div class="col-md-12">

                            <div class="col-md-5 col-md-offset-1">
                                <div class="box box-danger">
                                    <div class="box-body">
                                        <h3 align="center"><b>Seleccione una división</b></h3>
                                        <div class="form-group">
                                            <select class="form-control" id="division2" name="division2" required="">
                                                <?php echo $comboDivisiones ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="box box-danger">
                                    <div class="box-body">
                                        <h3 align="center"><b>Seleccione la unidad a gestionar</b></h3>
                                        <div class="form-group">
                                            <select class="form-control" id="unidad2" name="unidad2" required="">
                                                <option value='-1'>Seleccione uno</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="box box-danger">
                                    <div class="box-body">
                                        <div id="detalles" name="detalles" style="padding-left: 20px;">
                                            <p><b>Nombre de la unidad:  </b> <span id="nombre_unidad"></span></p>
                                            <p><b>Codigo de la unidad :</b> <span id="codigo_unidad"></span></p>
                                            <p><b>Nombre del coordinador :</b> <span id="nombre_encargado"></span></p>
                                            <p><b>Abreviatura:</b> <span id="abr_unidad"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="botonCrearActividad" name="botonCrearActividad"></div>


                        <div class="col-md-8 col-md-offset-2" id="tabla-act" name="tabla-act"></div>

                                </div><!-- /.row -->

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
        <?php echo $muestra;?>

    </body>

</html>
