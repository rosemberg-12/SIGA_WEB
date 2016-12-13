<?php
require_once '../bussines/DTO/Usuario.php';
require_once '../bussines/DTO/Persona.php';
require_once '../fachade/FachadeOne.php';


session_start();

if(isset($_GET['unid']) && isset($_GET['jefe'])){
    include_once ('../model/General.php');

    $unid= ($_GET['unid']);
    $jefe= ($_GET['jefe']);
    $facade = new FachadeOne();
    $muestra="";
    if(strcmp($jefe+"",1)==0){
        $muestra="<b>Esta unidad no tiene un coordinador Asignado</b>";
    }
    else{
    $usuario=$facade->getUserInformation($jefe, "../");
        $muestra= "El coordinador de esta unidad es <b>".$usuario->_GET('persona')->_GET('nombre')." ".$usuario->_GET('persona')->_GET('apellido').",</b> Con el documento <b>".$usuario->_GET('persona')->_GET('numeroDocumento')."</b>";
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


                <section class="content">
                    <!-- Incluir aqui el contenido-->
                    <br>
                    <div class="login-logo titulo" style="color: #fff;">
                        <b><a href="#" style="color:#dd4b39">Asignar coordinador de unidad</a></b>
                    </div><!-- /.login-logo -->
                    <br>
                    <br>

                    <div class="row">

                        <div class="col-md-6 col-md-offset-3">
                            <div class="box box-warning">
                                <div class="box-body" align="center">
                                    <?php echo $muestra ;?>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="login-logo titulo" style="color: #fff;">
                            <b><a href="#" style="color:#dd4b39">Usuarios a asignar</a></b>
                        </div><!-- /.login-logo -->

                        <div class="col-md-6 col-md-offset-3">
                            <div class="box box-warning">
                                <div class="box-body">
                                    <table id="usuarios" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Documento</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php echo $facade->cargarAllUsersForUnidad($jefe, $unid);?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Documento</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
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

    </body>

</html>
