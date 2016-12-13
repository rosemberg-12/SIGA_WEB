<?php
require_once '../bussines/DTO/Usuario.php';
require_once '../bussines/DTO/Persona.php';
require_once '../fachade/FachadeOne.php';

$activo="";
$inactivo="";

session_start();

    $facade = new FachadeOne();

 if(isset($_GET['asis'])){
     $tb1="";
     $tb2="";
     $tb3="";
     $tb4="";
     $asis=$facade->getAsisInformation($_GET['asis'], "../");

     if (strcmp ($asis->_GET('idTipoBeneficiario')+"","1")==0){
         $tb1="selected";
     }
     elseif (strcmp ($asis->_GET('idTipoBeneficiario')+"","2")==0){
         $tb2="selected";
     }
     elseif (strcmp ($asis->_GET('idTipoBeneficiario')+"","3")==0){
         $tb3="selected";
     }
     elseif (strcmp ($asis->_GET('idTipoBeneficiario')+"","4")==0){
         $tb4="selected";
     }

     $td1="";
     $td2="";
     $td3="";
     $td4="";
     $td5="";
     $td6="";
     $td7="";

     if (strcmp ($asis->_GET('idTipoDocumento')+"","1")==0){
         $td1="selected";
     }
     elseif (strcmp ($asis->_GET('idTipoDocumento')+"","2")==0){
         $td2="selected";
     }
     elseif (strcmp ($asis->_GET('idTipoDocumento')+"","3")==0){
         $td3="selected";
     }
     elseif (strcmp ($asis->_GET('idTipoDocumento')+"","4")==0){
         $td4="selected";
     }
     elseif (strcmp ($asis->_GET('idTipoDocumento')+"","5")==0){
         $td5="selected";
     }
     elseif (strcmp ($asis->_GET('idTipoDocumento')+"","6")==0){
         $td6="selected";
     }
     elseif (strcmp ($asis->_GET('idTipoDocumento')+"","7")==0){
         $td7="selected";
     }




 }
else{
    header("Location: gestionar-actividad.php?estado=1");
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
                        <b><a href="#" style="color:#dd4b39">Editar Asistencia</a></b>
                    </div><!-- /.login-logo -->
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="box box-success">
                                <div class="box-body">
                                    <form role="form" action="scripts/scriptEditarAsistencia.php" method="post">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Seleccione el tipo de beneficiario</label>
                                            <select class="form-control" id="tipoben"name="tipoben" required="">
                                                <option value>Seleccione el tipo de beneficiario</option>
                                                <option value="1"  <?php echo $tb1 ?> >Estudiante</option>
                                                <option value="2"  <?php echo $tb2 ?> >Docente</option>
                                                <option value="3"  <?php echo $tb3 ?> >Administrativo</option>
                                                <option value="4"  <?php echo $tb4 ?> >Graduado</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Seleccione el tipo de documento</label>
                                            <select class="form-control" id="tipodoc"name="tipodoc" required="">
                                                <option value>Seleccione el tipo de documento</option>
                                                <option value="1" <?php echo $td1 ?> >Pasaporte</option>
                                                <option value="2" <?php echo $td2 ?> >Tarjeta de Identidad</option>
                                                <option value="3" <?php echo $td3 ?> >Cedula de ciudadania</option>
                                                <option value="4" <?php echo $td4 ?> >Documento de identidad extrajera</option>
                                                <option value="5" <?php echo $td5 ?> >Cedula de extrajeria</option>
                                                <option value="6" <?php echo $td6 ?> >Certificado cabildo</option>
                                                <option value="7" <?php echo $td7 ?> >Visa de extrajeria</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Ingrese el numero de documento</label>
                                            <input type="number"  value='<?php echo $asis->_GET('documentoBeneficiario'); ?>' class="form-control"  placeholder="Ingrese el numero de documento nuevo" id="doc" name="doc" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Digite el nombre de la persona a inscribirse</label>
                                            <input type="text" class="form-control" value='<?php echo $asis->_GET('nombreBeneficiario'); ?>'  placeholder="Ingrese el nombre de la persona" id="nom" name="nom" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Digite el código de la persona a inscribirse</label>
                                            <input type="text" class="form-control" value='<?php echo $asis->_GET('codigoBeneficiario'); ?>'  placeholder="Digite el codigo de la persona" id="cod" name="cod" required>
                                        </div>

                                        <input type="hidden" id="asis" name="asis" value=<?php echo "'".$_GET['asis']."'"; ?> />

                                        <div class="box-footer">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-2 col-md-offset-5">
                                                        <button type="submit" class="btn btn-primary">Editar</button>
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
