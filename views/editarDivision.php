<?php
require_once '../bussines/DTO/Usuario.php';
require_once '../bussines/DTO/Persona.php';
require_once '../fachade/FachadeOne.php';

$activo="";
$inactivo="";

session_start();

if(isset($_GET['divi'])){
    include_once ('../model/General.php');

    $id_divi= ($_GET['divi']);
    $facade = new FachadeOne();

    $division=$facade->getDivInformation($id_divi, "../");

    if($division==null){
        header("Location: gestion-division.php");
    }

    $estado=$division->_GET('estado');

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
                        <b><a href="#" style="color:#dd4b39">Registrar Division</a></b>
                    </div><!-- /.login-logo -->
                    <br>
                    <div class="box" style="width: 70%; margin: 3% auto;">
                        <div class="box-header">

                        </div><!-- /.box-header -->
                        <div class="login-box-body">
                            <form role="form" action="scripts/scriptEditarDivision.php" method="post">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nombre de la división</label>
                                    <input type="text" class="form-control" value='<?php echo $division->_GET('nombre'); ?>' placeholder="Nombre de la división" id="div_name" name="div_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Abreviatura de la división</label>
                                    <input type="text" class="form-control" value='<?php echo $division->_GET('abreviatura'); ?>' placeholder="Abreviatura de la división" id="div_abr" name="div_abr" required>
                                </div>
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select class="form-control" id=rol name="div_status" required="">
                                        <option value>Seleccione el estado del usuario</option>
                                        <option value="A" <?php echo $activo;?>>Activo</option>
                                        <option value="D" <?php echo $inactivo;?>>Inactivo</option>

                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block btn-flat">Actualizar</button>
                                <input type="hidden" value='<?php echo $_GET['divi']; ?>' name="divi"/>
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
