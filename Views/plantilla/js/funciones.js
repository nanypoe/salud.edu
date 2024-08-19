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

    $('#formAgregarEscuela').submit(function(e){
        e.preventDefault();
        let nombreEscuela=$('#nombreEscuela').val();
        let direccionEscuela=$('#direccionEscuela').val();
        let telefonoEscuela=$('#telefonoEscuela').val();
        let latitudEscuela=$('#latitudEscuela').val();
        let longitudEscuela=$('#longitudEscuela').val();
        
        $.ajax({
            url:'escuela/agregarEscuela/',
            type:'post',
            data:{'nombreEscuela':nombreEscuela,'direccionEscuela':direccionEscuela,'telefonoEscuela':telefonoEscuela,'latitudEscuela':latitudEscuela,'longitudEscuela':longitudEscuela},
            success:function(respuesta){
                $('#modalAgregarEscuela').modal('hide');
                $('#formAgregarEscuela')[0].reset();
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
                    text: "El registro he sido registrado de forma correcta.",
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


     /*------- Funciones para Maestros------------ */

    /* Funcion para enviar los datos de los Maestros*/

    $('#formAgregarMaestros').submit(function(e){
        e.preventDefault();
        let idEscuela=$('#id').val();
        let nombre=$('#nombre').val();
        let apellido=$('#apellido').val();
        let correo=$('#correo').val();
        let telefono=$('#telefono').val();
        let perfil=$('#perfil').val();
        
        $.ajax({
            url:'maestros/agregarMaestros/',
            type:'post',
            data:{'id':idEscuela,'nombre':nombre,'apellido':apellido,'correo':correo,'telefono':telefono,'perfil':perfil},
            success:function(respuesta){
                $('#modalAgregarMaestro').modal('hide');
                $('#formAgregarMaestros')[0].reset();
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



});