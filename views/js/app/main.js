$(document).ready(function() {

    $body = $("body");

    $("#tipo_p").change(function () {

             elegido= $(this).val();
             valor=$("#mantoS").val();


             if(elegido=="" || valor==""){
                 $("#identificador").html("<option value>Seleccione uno</option>");
                 return;
             }

        $body.addClass("loading");

        $.post("cargarTiposPuestoT.php", { tipo_lugar: elegido, manto:valor },
            	function(data){
                    
            		if(data!=""){
                 
                    $("#identificador").html(data);
                        $body.removeClass("loading");
                    }

            	});            
    
   });
    $("#mantoS").change(function () {

             elegido= $(this).val();
             valor=$("#tipo_p").val();

             if(elegido=="" || valor==""){
                 $("#identificador").html("<option value>Seleccione uno</option>");
                 return;

             }

        $body.addClass("loading");
            $.post("cargarTiposPuestoT.php", { tipo_lugar:valor , manto:elegido },
                function(data){
                    
                    if(data!=""){
                 
                    $("#identificador").html(data);
                        $body.removeClass("loading");
                    }


                });            
    
   });

    $("#l1").change(function () {

        elegido= $(this).val();
        valor=$("#l2").val();
        mina=$("#mina").val();

        if(elegido=="" || valor==""){
            $("#concepto").html("<option value>Seleccione uno</option>");
            $("#concepto").attr("required", true);
            $("#concepto").attr("disabled", false);
            $("#comentario").attr("required", false);
            $("#precio_u").html("");
            restablecerManto();
            return ;
        }

        if(valor.indexOf("Jornales") > -1){
            $("#concepto").attr("required", false);
            $("#concepto").attr("disabled", true);
            $("#comentario").attr("required", true);
            $("#concepto").html("<option></option>");
            $("#precio_u").html("<label>Precio de la unidad del jornal</label><input type='number' class='form-control' placeholder='Digite el valor de la unidad de este Jornal' id='precio_jornal' name='precio_jornal' required='true'>");
            restablecerManto();
            return;

        }
        else if(valor.indexOf("Otros") > -1){
            $("#concepto").attr("required", false);
            $("#concepto").attr("disabled", true);
            $("#comentario").attr("required", true);
            $("#concepto").html("<option></option>");
            $("#precio_u").html("<label>Precio de la unidad de concepto nuevo</label><input type='number' class='form-control' placeholder='Digite el valor de la unidad de concepto nuevo' id='precio_otro' name='precio_otro' required='true'>");
            restablecerManto();
            return;

        }
        else{
            $("#concepto").attr("required", true);
            $("#concepto").attr("disabled", false);
            $("#comentario").attr("required", false);
            $("#precio_u").html("");
            restablecerManto();
        }


        $.post("cargarConcepto.php", { tipo: elegido, subtipo:valor, mina:mina },
            function(data){

                if(data!=""){

                    $("#concepto").html(data);

                }
            });

        restablecerManto();

    });
    $("#l2").change(function () {

        elegido= $(this).val();
        valor=$("#l1").val();
        mina=$("#mina").val();

        if(elegido=="" || valor==""){
            $("#concepto").html("<option value>Seleccione uno</option>");
            $("#concepto").html("<option value>Seleccione uno</option>");
            $("#concepto").attr("required", true);
            $("#concepto").attr("disabled", false);
            $("#comentario").attr("required", false);
            $("#precio_u").html("");
            restablecerManto();
            return;
        }

        if(elegido.indexOf("Jornales") > -1){
            $("#concepto").attr("required", false);
            $("#concepto").attr("disabled", true);
            $("#comentario").attr("required", true);
            $("#concepto").html("<option></option>");
            $("#precio_u").html("<label>Precio de la unidad del jornal</label><input type='number' class='form-control' placeholder='Digite el valor de la unidad de este Jornal' id='precio_jornal' name='precio_jornal' required='true'>");
            restablecerManto();
            return;

        }

        else if(elegido.indexOf("Otros") > -1){
            $("#concepto").attr("required", false);
            $("#concepto").attr("disabled", true);
            $("#comentario").attr("required", true);
            $("#concepto").html("<option></option>");
            $("#precio_u").html("<label>Precio de la unidad de concepto nuevo</label><input type='number' class='form-control' placeholder='Digite el valor de la unidad de concepto nuevo' id='precio_otro' name='precio_otro' required='true'>");
            restablecerManto();
            return;

        }

        else{
            $("#concepto").attr("required", true);
            $("#concepto").attr("disabled", false);
            $("#comentario").attr("required", false);
            $("#precio_u").html("");
            restablecerManto();
        }




        $.post("cargarConcepto.php", { tipo: valor, subtipo:elegido,mina:mina  },
            function(data){

                if(data!=""){

                    $("#concepto").html(data);

                }

            });

        restablecerManto();
    });


    $("#concepto").change(function () {

        elegido= $(this).val();
        mina=$("#mina").val();
        if(elegido==""){
            restablecerManto();
            return;
        }

        $body.addClass("loading");

        $.post("cargarMantoLabor.php", { labor:elegido, mina:mina },
            function(data){

                if(data.trim()!==""){
                    alert(data);
                    $("#mantoS").html(data);
                    $body.removeClass("loading");
                }
                $body.removeClass("loading");


            });

    });


    

    function restablecerManto(){
        mina=$("#mina").val();

        $body.addClass("loading");
        $.post("restablecerMantos.php", { mina:mina},
            function(data){

                if(data!=""){

                    $("#mantoS").html(data);
                    $("#identificador").html("<option value>Seleccione uno</option>");
                    $body.removeClass("loading");
                }

            });

    }

    $('#registros').DataTable({
        order: [[ 3, "desc" ]],
        dom: 'Bfrtip',
        buttons: [
             'excel'
        ]
    });

    $('#novedades').DataTable({
        "order": [[ 0, "desc" ]]
            });

} );
