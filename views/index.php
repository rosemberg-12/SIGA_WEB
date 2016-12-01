<?php
require_once '../bussines/DTO/Usuario.php';

session_start();
$muestra="";


if( ( isset($_POST['tipodoc'])  && isset($_POST['documento']) && isset($_POST['password']) && isset($_POST['rol']) ) )
{
    require_once '../fachade/FachadeOne.php';

    $facade = new FachadeOne();

    $var=$facade->iniciarSesion($_POST['tipodoc'], $_POST['documento'],$_POST['password'], $_POST['rol']);

    if($var===true){
       header("Location: principal.php");
    }
    else{
        $muestra= '<script type="text/javascript">alertify.error("'.$var.'");</script>';
    }


}

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
              include('html/barraLateralIndex.php');
            ?>

            <!-- Columna derecha. contiene navbar y la ruta de la pagina -->
            <div class="content-wrapper inicio">
                <!-- Encabezado -->
                                <!-- Contenido Principal de la pagina -->
                <section class="content">
                    <!-- Incluir aqui el contenido-->
                        <div class="login-box">
                              <div class="login-logo" style="background-color: #dd4b39; color: #ffffff; border-style: solid; border-width: 1px; border-color: black">
                                  SIGA UFPS
                              </div><!-- /.login-logo -->
                                      <div class="login-box-body" style="border-style: solid; border-width: 1px; border-color: black">
                                        <p class="login-box-msg">Logueate para iniciar sesión</p>
                                                <form action="index.php" method="post" id="login">
                                                    <div class="form-group has-feedback">
                                                        <select class="form-control" id="tipodoc"name="tipodoc" required="">
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
                                                  <div class="form-group has-feedback">
                                                    <input type="text" class="form-control" placeholder="Documento" name="documento" id="documento" required="" title="Número de Documento">
                                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                                  </div>

                                                  <div class="form-group has-feedback">
                                                    <input type="password" class="form-control" placeholder="Contraseña" name="password" id="password" required="" title="Contraseña">
                                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                  </div>
                                                  <div class="form-group has-feedback">
                                                    <select class="form-control" id=rol name="rol" required="">
                                                        <option value>Seleccione el rol</option>
                                                        <option value="1">Administrador</option>
                                                        <option value="2">Encargado de división</option>
                                                        <option value="3">Encargado de unidad</option>
                                                        <option value="4">Encargado de actividad</option>   .
                                                    </select>
                                                  </div>

                                                  <div class="row">

                                                    <div class="col-xs-8">
                                                      <div class="checkbox icheck">

                                                      </div>
                                                    </div><!-- /.col -->

                                                    <div class="col-xs-4">
                                                      <button type="submit" class="btn btn-danger btn-block btn-flat">Entrar</button>
                                                    </div><!-- /.col -->
                                                  </div>

                                                </form>
                                      </div><!-- /.login-box-body -->
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
        <?php echo $muestra;?>
    </body>

</html>
