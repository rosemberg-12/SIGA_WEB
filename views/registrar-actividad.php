<?php
require_once '../bussines/DTO/Usuario.php';
require_once '../bussines/DTO/Persona.php';
require_once '../fachade/FachadeOne.php';

$activo="";
$inactivo="";

session_start();

    $facade = new FachadeOne();
$comboAnios = $facade->getComboAnios();
 if(!isset($_GET['uni'])){
     header("Location: gestionar-unidad.php");
 }


?>


<!DOCTYPE html>
<html lang="es">

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
                        <b><a href="#" style="color:#dd4b39">Registrar Actividad</a></b>
                    </div><!-- /.login-logo -->
                    <br>
                    <div class="box" style="width: 70%; margin: 3% auto;">
                        <div class="box-header">

                        </div><!-- /.box-header -->
                        <div class="login-box-body">
                            <form role="form" action="scripts/scriptCrearActividad.php" method="post">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nombre de la actividad</label>
                                    <input type="text" class="form-control"  placeholder="Nombre de la actividad" id="act_name" name="act_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione el tipo de actividad</label>
                                    <select class="form-control" id="tipo_act" name="tipo_act" required="">
                                        <?php echo $facade->getComboTipoActividad();?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione el programa al que pertenece la actividad</label>
                                    <select class="form-control" id="tipo_prog" name="tipo_prog" required="">
                                        <?php echo $facade->getComboPrograma();?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione el año</label>
                                    <select class="form-control" id="anio" name="anio" required="">
                                        <?php echo $comboAnios; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione el semestre</label>
                                    <select class="form-control" id="sem" name="sem" required="">
                                        <option value >Seleccione el semestre</option>
                                        <option value="I" >I</option>
                                        <option value="II" >II</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione la fecha de inicio</label>
                                    <input type="datetime-local" class="form-control" placeholder="Fecha de inicio" id="fecha_ini" name="fecha_ini" required>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione la fecha de fin</label>
                                    <input type="datetime-local" class="form-control" placeholder="Fecha de fin" id="fecha_fin" name="fecha_fin" required>
                                </div>
                                <div class="form-group">
                                    <label>Ingrese la dedicación</label>
                                    <input type="number" class="form-control"  placeholder="Cantidad de dedicacion a la actividad en horas" id="dedic" name="dedic" required>
                                </div>

                                <input type="hidden" id="uni" name="uni" value=<?php echo "'".$_GET['uni']."'"; ?> />

                                <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>

                            </form>

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
