$(document).ready(function() {
    var infoDivision= "<p><b>Nombre de la division:  </b> <span id='nombre_div'></span></p><p><b>Nombre del encargado :</b><span id='nombre_encargado'></span></p><p><b>Abreviatura:</b><span id='abr_div'></span></p>";
    var infoUnidad='<p><b>Nombre de la unidad:  </b> <span id="nombre_unidad"></span></p><p><b>Codigo de la unidad :</b><span id="codigo_unidad"></span></p>        <p><b>Nombre del coordinador :</b><span id="nombre_encargado"></span></p>        <p><b>Abreviatura:</b><span id="abr_unidad"></span></p>';
    var infoActividad='<p><b>Nombre de la actividad:  </b> <span id="nombre_actividad"></span></p><p><b>Codigo de la actividad :</b><span id="codigo_actividad"></span></p><p><b>Nombre del responsable :</b><span id="nombre_encargado"></span></p><p><b>Abreviatura:</b><span id="abr_actividad"></span></p>'
    $('#tabla-usuarios').DataTable({

        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel'
        ]
    });

    $('#usuarios').DataTable();

    $body = $("body");

    /* ========================= GESTION DIVISION ============================== */

    $("#division1").change(function () {
        elegido= $(this).val();

        if(elegido=="-1"){
            $("#detalles").html(infoDivision);
            $("#tabla-unidadesD").html("");
            $("#botonCrearUnidad").html("");
            return;
        }
        var botonCrearUnidad='<div class="col-xs-12" style="display: flex;  justify-content: center; padding: 10px" ><div class="col-xs-6" ><a href="registrar-unidad.php?divi='+elegido+'" class="btn btn-info btn-block btn-flat">Crear nueva unidad</a></div> </div>';

        $.post("scripts/scriptCargarDetallesDivision.php", { division:elegido },
            function(data){
                if(data!=""){
                    $("#detalles").html(data);
                }
            });
        console.log("Hola2");

        $.post("scripts/scriptCargaUnidadesDivision.php", { division:elegido },
            function(data){
                if(data!=""){
                    $("#tabla-unidadesD").html(data);
                    $("#botonCrearUnidad").html(botonCrearUnidad);
                    $("#tabla-unidades").DataTable();
                }
            });
    });
    /* ========================= Gestion Unidad ============================== */
    $("#division2").change(function () {

        elegido= $(this).val();

        if(elegido=="-1"){
            $("#tabla-act").html("");
            $("#botonCrearActividad").html("");
            $("#detalles").html(infoUnidad);
            $("#unidad2").html("<option value='-1'>Seleccione uno</option>");
            return;
        }
        $.post("scripts/scriptCargarComboUnidades.php", { division:elegido },
            function(data){

                if(data!=""){
                    console.log(data);
                    $("#unidad2").html(data);
                    $("#tabla-act").html("");
                    $("#botonCrearActividad").html("");
                    $("#detalles").html(infoUnidad);
                }

            });

    });

    $("#unidad2").change(function () {
        elegido= $(this).val();
        if(elegido=="-1"){
            $("#tabla-act").html("");
            $("#botonCrearActividad").html("");
            $("#detalles").html(infoUnidad);
            return;
        }
        var botonCrearActividad='<div class="col-xs-12" style="display: flex;  justify-content: center; padding: 10px" ><div class="col-xs-6" ><a href="registrar-actividad.php?uni='+elegido+'" class="btn btn-info btn-block btn-flat">Crear nueva actividad</a></div> </div>';

        $.post("scripts/scriptCargarDetallesUnidad.php", { unidad:elegido },
            function(data){
                if(data!=""){
                    $("#detalles").html(data);
                }
            });

        $.post("scripts/scriptCargaActividadesUnidad.php", { unidad:elegido },
            function(data){
                if(data!=""){
                    $("#tabla-act").html(data);
                    $("#botonCrearActividad").html(botonCrearActividad);
                    $("#tabla-actividades").DataTable();
             }
                else{

                }
            });
    });

    /* ========================= Gestion Actividad ============================== */

    $("#division3").change(function () {

        elegido= $(this).val();

        if(elegido=="-1"){
            $("#tabla-asis").html("");
            $("#botonCrearAsistencia").html("");
            $("#detalles").html(infoActividad);
            $("#actividad3").html("<option value='-1'>Seleccione uno</option>");
            $("#unidad3").html("<option value='-1'>Seleccione uno</option>");
            //$("#actividad3").html("<option value='-1'>Seleccione uno</option>");
            return;
        }

        $body.addClass("loading");

        var cargarUnidades=$.post("scripts/scriptCargarComboUnidades.php", { division:elegido });

        cargarUnidades.done(
            function(data){
                if(data!=""){
                    console.log(data);
                    $("#tabla-asis").html("");
                    $("#botonCrearAsistencia").html("");
                    $("#detalles").html(infoActividad);
                    $("#unidad3").html(data);
                    $("#actividad3").html("<option value='-1'>Seleccione uno</option>");
                }
            });
        cargarUnidades.always(function(){
            $body.removeClass("loading");
        })
    });

    $("#unidad3").change(function () {
        elegido= $(this).val();

        if(elegido=="-1"){
            $("#tabla-asis").html("");
            $("#botonCrearAsistencia").html("");
            $("#detalles").html(infoActividad);
            $("#actividad3").html("<option value='-1'>Seleccione uno</option>");
            return;
        }
        $body.addClass("loading");

        var cargarActividades= $.post("scripts/scriptCargarComboActividades.php", { division:elegido });

        cargarActividades.done(
            function(data){
                if(data!=""){
                    console.log(data);
                    $("#tabla-asis").html("");
                    $("#botonCrearAsistencia").html("");
                    $("#detalles").html(infoActividad);
                    $("#actividad3").html(data);
                }
            });

        cargarActividades.always(function(){$body.removeClass("loading")});

    });

    $("#actividad3").change(function () {
        elegido= $(this).val();

        if(elegido=="-1"){
            $("#tabla-asis").html("");
            $("#botonCrearAsistencia").html("");
            $("#detalles").html(infoActividad);
            return;
        }
        var botonCrearAsistencia='<div class="col-xs-12" style="display: flex;  justify-content: center; padding: 10px" ><div class="col-xs-6" ><a href="registrar-asistencia.php?acti='+elegido+'" class="btn btn-info btn-block btn-flat">Registrar una asistencia</a></div> </div>';

        $body.addClass("loading");
        var cargaDetallesActividad=$.post("scripts/scriptCargarDetallesActividad.php", { unidad:elegido });

        cargaDetallesActividad.done(function(data){
                if(data!=""){
                    $("#detalles").html(data);
                }
            });

        var post= $.post("scripts/scriptCargaAsistenciaActividades.php", { unidad:elegido });

        post.done(function(data){
            if(data!=""){
                console.log(data);
                $("#tabla-asis").html("");
                $("#tabla-asis").html(data);
                $("#botonCrearAsistencia").html(botonCrearAsistencia);
                try{
                $("#tabla-asistencias").DataTable();
                }catch (Error){
                   console.log(Error);
                }
            }

        });
        post.always(function(){
            $body.removeClass("loading");
        });

    });



    /* ========================= REPORTE EXCEL ============================== */

    $("#divisionxls").change(function () {

        elegido= $(this).val();

        if(elegido=="-1"){
            $("#tabla-act").html("");
            $("#botonCrearActividad").html("");
            $("#detalles").html(infoUnidad);
            $("#unidad2").html("<option value='-1'>Seleccione uno</option>");
            return;
        }
        $.post("scripts/scriptCargarComboUnidades.php", { division:elegido },
            function(data){

                if(data!=""){
                    console.log(data);
                    $("#unidadxls").html(data);
                }

            });
    });

    $("#unidadxls").change(function () {
        elegido= $(this).val();

        if(elegido=="-1"){
            $("#tabla-act").html("");
            $("#botonCrearActividad").html("");
            $("#detalles").html(infoUnidad);

            return;
        }
        $.post("scripts/scriptCargarComboActividades.php", { division:elegido },
            function(data){
                if(data!=""){
                    console.log(data);
                    $("#actividadxls").html(data);
                }

            });
    });




} );
