<?php
require_once '../bussines/DTO/Usuario.php';
require_once '../bussines/DTO/Persona.php';
require_once '../fachade/FachadeOne.php';


$ps="";
$ti="";
$cc="";
$de="";
$ce="";
$ca="";
$ci="";
$activo="";
$inactivo="";

session_start();

if(isset($_GET['user'])){
    include_once ('../model/General.php');

    $id_user= ($_GET['user']);
    $facade = new FachadeOne();

    $usuario=$facade->getUserInformation($id_user, "../");

    if($usuario==null){
        header("Location: gestion-usuarios.php");
    }
    $value= $usuario->_GET('persona')->_GET('idTipoDocumento')+"";
    $estado=$usuario->_GET('estado');
    if(strcmp($value,"1")==0){
        $ps="selected";
    }
    elseif(strcmp($value,"2")==0){
        $ti="selected";
    }
    elseif(strcmp($value,"3")==0){
        $cc="selected";
    }
    elseif(strcmp($value,"4")==0){
        $de="selected";
    }
    elseif(strcmp($value,"5")==0){
        $ce="selected";
    }
    elseif(strcmp($value,"6")==0){
        $ca="selected";
    }
    elseif(strcmp($value,"7")==0){
        $ci="selected";
    }

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


                <!-- Contenido Principal de la pagina -->
                <section class="content">
                    <!-- Incluir aqui el contenido-->
                    <br>

                    <div class="login-logo titulo" style="color: #fff;">
                        <b><a href="#" style="color:#dd4b39">Editar Usuario
                            </a></b>
                    </div><!-- /.login-logo -->
                    <br>
                    <div class="box" style="width: 70%; margin: 3% auto;">
                        <div class="box-header">

                        </div><!-- /.box-header -->
                        <div class="login-box-body">
                            <form role="form" action="scripts/scriptEditarUsuario.php" method="post">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nombre del usuario</label>
                                    <input type="text" value='<?php echo $usuario->_GET('persona')->_GET('nombre'); ?>' class="form-control" placeholder="Nombre del usuario" id="id" name="user_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Apellido del usuario</label>
                                    <input type="text" value=' <?php echo $usuario->_GET('persona')->_GET('apellido'); ?>'  class="form-control" placeholder="Apellido del usuario" id="id" name="user_lastname" required>
                                </div>
                                <div class="form-group">
                                    <label>Tipo de documento</label>
                                    <select class="form-control" id=rol name="user_tipodoc" required="">
                                        <option value>Seleccione el tipo de documento</option>
                                        <option value="1" <?php echo $ps;?>>Pasaporte</option>
                                        <option value="2" <?php echo $ti;?>>Tarjeta de Identidad</option>
                                        <option value="3" <?php echo $cc;?>>Cedula de ciudadania</option>
                                        <option value="4" <?php echo $de;?>>Documento de identidad extrajera</option>
                                        <option value="5" <?php echo $ce;?>>Cedula de extrajeria</option>
                                        <option value="6" <?php echo $ca;?>>Certificado cabildo</option>
                                        <option value="7" <?php echo $ci;?>>Visa de extrajeria</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select class="form-control" id=rol name="user_status" required="">
                                        <option value>Seleccione el estado del usuario</option>
                                        <option value="A" <?php echo $activo;?>>Activo</option>
                                        <option value="D" <?php echo $inactivo;?>>Inactivo</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Documento de identidad</label>
                                    <input type="number" class="form-control" value='<?php echo $usuario->_GET('persona')->_GET('numeroDocumento'); ?>'  placeholder="Documento de identificacion del nuevo usuario" id="user_doc" name="user_doc" required>
                                </div>
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input type="text" class="form-control" value='<?php echo $usuario->_GET('contrasena'); ?>'  placeholder="Contraseña de acceso" id="id" name="user_pass" required>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block btn-flat">Editar</button>
                                <input type="hidden" value='<?php echo $_GET['user']; ?>' name="user_id"/>
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
