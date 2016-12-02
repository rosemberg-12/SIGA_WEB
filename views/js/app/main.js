$(document).ready(function() {
    var infoDivision= "<p><b>Nombre de la unidad:  </b> <span id='nombre_div'></span></p><p><b>Codigo de la unidad :</b><span id='codigo_unidad'></span></p><p><b>Nombre del encargado :</b><span id='nombre_encargado'></span></p><p><b>Abreviatura:</b><span id='abr_div'></span></p>";
    var infoUnidad='<p><b>Nombre de la unidad:  </b> <span id="nombre_unidad"></span></p><p><b>Codigo de la unidad :</b><span id="codigo_unidad"></span></p>        <p><b>Nombre del coordinador :</b><span id="nombre_encargado"></span></p>        <p><b>Abreviatura:</b><span id="abr_unidad"></span></p>';
        $('#tabla-usuarios').DataTable({

        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel'
        ]
    });

    $('#usuarios').DataTable();

    $body = $("body");

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////// Gestionar Division ///////////////////////////////////////////////////////////////////////////////

    $("#division1").change(function () {
        elegido= $(this).val();

        if(elegido=="-1"){
            $("#detalles").html(infoDivision);
            $("#tabla-unidadesD").html("");
            $("#botonCrearUnidad").html("");
            return;
        }
        var botonCrearUnidad='<div class="col-xs-12" style="display: flex;  justify-content: center; padding: 10px" ><div class="col-xs-6" ><a href="registrar-unidad.php?divi='+elegido+'" class="btn btn-info btn-block btn-flat">Crear nueva unidad</a></div> </div>';

        console.log("Hola");
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
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////////// Gestionar Unidad ///////////////////////////////////////////////////////////////////////////////
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







} );
