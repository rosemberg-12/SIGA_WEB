<?php
require_once '../bussines/DTO/Usuario.php';
require_once '../bussines/DTO/Persona.php';
require_once '../fachade/FachadeOne.php';


session_start();

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

                    <div class="login-logo titulo">
                       <b><a href="#" style="color:#dd4b39">Registrar Usuario</a></b>
                    </div><!-- /.login-logo -->
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="box box-success">
                                <div class="box-body">
                                    <form role="form" action="scripts/scriptCrearrUsuario.php" method="post">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Nombre del usuario</label>
                                            <input type="text" class="form-control" placeholder="Nombre del usuario" id="id" name="user_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Apellido del usuario</label>
                                            <input type="text" class="form-control" placeholder="Apellido del usuario" id="id" name="user_lastname" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tipo de documento</label>
                                            <select class="form-control" id=rol name="user_tipodoc" required="">
                                                <option value>Seleccione el tipo de documento</option>
                                                <option value="1">Pasaporte</option>
                                                <option value="2">Tarjeta de Identidad</option>
                                                <option value="3">Cedula de ciudadania</option>
                                                <option value="4">Documento de identidad extrajera</option>
                                                <option value="5">Cedula de extrajeria</option>
                                                <option value="6">Certificado cabildo</option>
                                                <option value="7">Visa de extrajeria</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Documento de identidad (Esta será su credencial de acceso al sistema)</label>
                                            <input type="number" class="form-control" placeholder="Documento de identificacion del nuevo usuario" id="id" name="user_doc" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Contraseña</label>
                                            <input type="password" class="form-control" placeholder="Contraseña de acceso" id="id" name="user_pass" required>
                                        </div>

                                        <div class="box-footer">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-2 col-md-offset-5">
                                                        <button type="submit" class="btn btn-success">Registrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
