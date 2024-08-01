/* Inicailizando el doom */

$(function(){

    /* Ininicializacion de dataTable */
    $('#table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ],
        language:{
            "sSearch":"Buscar",
            "info":"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "zeroRecords":"No se encuentraron coincidencias",
            "infoEmpty":"Mostrando 0 a 0 de 0 registros",
            "infoFiltered":"(filtrado de un total de _MAX_ registros)",
        },
        responsive:true,
        columnDefs: [
            {"className": "dt-center", "targets": "_all"}
          ]
    });


});