$(document).ready(function() {

    $('#tabla-usuarios').DataTable({

        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel'
        ]
    });

    $('#usuarios').DataTable();



} );
