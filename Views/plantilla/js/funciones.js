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

    /*------- Funciones para Gerentes------------ */

    /* Funcion para enviar los datos de los gerentes*/

    $('#formAgregarGerente').submit(function(e){
        e.preventDefault();
        let nombre=$('#nombre').val();
        let sexo=$('#sexo').val();
        let fecha=$('#fechaNacio').val();
        let telefono=$('#telefono').val();
        let cedula=$('#cedula').val();
        let edad=$('#edad').val();
        let usuario=$('#usuario').val();
        let clave=$('#clave').val();
        let direccion=$('#direccion').val();
        let correo=$('#correo').val();
        
        $.ajax({
            url:'gerente/agregarGerente/',
            type:'post',
            data:{'nombre':nombre,'sexo':sexo,'fecha':fecha,'telefono':telefono,'cedula':cedula,'edad':edad,'usuario':usuario,'clave':clave,'direccion':direccion,'correo':correo},
            success:function(respuesta){
                $('#modalAgregarGerente').modal('hide');
                $('#formAgregarGerente')[0].reset();
                $('#table').DataTable().destroy();
                $('#table tbody').html(respuesta);
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
                    responsive:true 
                });
                Swal.fire({
                    title: "Agregado!",
                    text: "El registro a sido Agregado de forma correcta.",
                    icon: "success"
                });
            }
        });
    });



    /* Funcion para agregar gym */

    $("#formAgregarGym").on("submit",function(e){
    var extension=$("#imagen").val().split('.').pop().toLowerCase();;
    console.log(extension);
    if(extension != '')
      {
       if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
       {
        alert("Invalid Image File");
        $('#imagen').val('');
        return false;
       }
      } 
        e.preventDefault();
        $.ajax({
            url:'gimnasio/agregarGym/',
            type:'post',
            data:new FormData(this),
            contentType:false,
            processData:false,
        success:function(respuesta){
      
            $('#modalAgregarGym').modal('hide');
            $("#table").DataTable().destroy();
            $("#table tbody").html(respuesta);
            $('#table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                responsive: true,rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                "language":{
                    "sSearch":"Buscar",
                    "lengthMenu":"Mostrar MENU registros",
                    "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
                    "zeroRecords":"No se encuentran resultados",
                    "info":"Mostrando registros del START al END de un TOTAL de registros",
                    "oPaginate":{
                        "sNext":"Siguiente",
                        "sPrevious":"Anterior"
                    }        
                }
            
            });  
    
            $('#formAgregarGym')[0].reset();
    
            Swal.fire(
                'Se registro el evento con exito',
                'en el sistema',
                'success'
            )
    
    
        }
        ,error:function(){
            console.log('Error');
        }
    
    
    
    }); 
    
    
    
    });


});