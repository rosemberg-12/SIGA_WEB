<?php
require_once '../bussines/DTO/Usuario.php';
require_once '../bussines/DTO/Persona.php';
require_once '../fachade/FachadeOne.php';

session_start();

$facade = new FachadeOne();


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
    <div class="content-wrapper inicio" style="min-height: 946px;">
        <!-- Encabezado -->


        <!-- Contenido Principal de la pagina-->
        <section class="content">
            <!-- Incluir aqui el contenido-->
            <br>

            <div class="login-logo titulo" style="color: #fff;">
                <b><a href="#" style="color:#dd4b39">Generar Reporte PDF</a></b>
            </div><!-- /.login-logo -->

            <br/><br/>
            <div class="col-md-12">
                <div class="col-md-4 col-md-offset-4">
                    <div class="box box-danger">
                        <div class="box-header"></div>
                        <form role="form" action="reporte-pdf.php" method="post">
                            <!-- text input -->
                            <div class="box-body">
                                    <div class="form-group">
                                        <label>Seleccione tipo reporte</label>
                                        <select class="form-control" id="tipo-reporte" name="tipo-reporte" required="">
                                            <option value="-1">Seleccione tipo reporte</option>
                                            <option value="1">POR PROGRAMA ACADÉMICO</option>
                                            <option value="2">POR ACTIVIDAD</option>
                                            <option value="3">POR SEMESTRE AÑO</option>
                                        </select>
                                    </div>

                                <div class="box-footer" align="right">
                                    <button type="submit" class="btn btn-primary">Continuar</button>
                                </div>
                            </div>

                        </form>
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