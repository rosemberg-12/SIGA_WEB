<?php
require_once '../bussines/DTO/Usuario.php';
require_once '../bussines/DTO/Persona.php';
session_start();



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
                

                <!-- Contenido Principal de la pagina -->
                <section class="content">

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
    </body>

</html>
