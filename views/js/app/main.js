$(document).ready(function() {
    var infoDivision="<p><b>Nombre de la división:  </b> <span id='nombre_div'></span></p><p><b>Nombre del encargado :</b><span id='nombre_encargado'></span></p><p><b>Abreviatura:</b><span id='abr_div'></span></p>";
       $('#tabla-usuarios').DataTable({

        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel'
        ]
    });

    $('#usuarios').DataTable();

    $body = $("body");

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


    } );
