/*====================================
================DOM===================
======================================*/

$(function () {

    /*===== Inicialización de DATATABLES =====*/
    $('#table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ],
        language: {
            "sSearch": "Buscar",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "zeroRecords": "No se encuentraron coincidencias",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        },
        responsive: true,
        columnDefs: [
            { "className": "dt-center", "targets": "_all" }
        ]
    });



    /*====================================
    ================GERENTES==============
    ======================================*/

    /*===== Funcion para enviar los datos de los GERENTES=====*/
    $('#formAgregarEscuela').submit(function (e) {
        e.preventDefault();
        let nombreEscuela = $('#nombreEscuela').val();
        let direccionEscuela = $('#direccionEscuela').val();
        let telefonoEscuela = $('#telefonoEscuela').val();
        let latitudEscuela = $('#latitudEscuela').val();
        let longitudEscuela = $('#longitudEscuela').val();

        $.ajax({
            url: 'escuela/agregarEscuela/',
            type: 'post',
            data: { 'nombreEscuela': nombreEscuela, 'direccionEscuela': direccionEscuela, 'telefonoEscuela': telefonoEscuela, 'latitudEscuela': latitudEscuela, 'longitudEscuela': longitudEscuela },
            success: function (respuesta) {
                $('#modalAgregarEscuela').modal('hide');
                $('#formAgregarEscuela')[0].reset();
                $('#table').DataTable().destroy();
                $('#table tbody').html(respuesta);
                $('#table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'excel', 'pdf', 'print'
                    ],
                    language: {
                        "sSearch": "Buscar",
                        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "zeroRecords": "No se encuentraron coincidencias",
                        "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    },
                    responsive: true
                });
                Swal.fire({
                    title: "Agregado!",
                    text: "El registro he sido registrado de forma correcta.",
                    icon: "success"
                });
            }
        });
    });


    /*========================================
        ================GIMNASIOS=============
        ======================================*/

    /*===== Funcion para agregar GIMNASIOS =====*/

    $("#formAgregarGym").on("submit", function (e) {
        var extension = $("#imagen").val().split('.').pop().toLowerCase();;
        console.log(extension);
        if (extension != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File");
                $('#imagen').val('');
                return false;
            }
        }
        e.preventDefault();
        $.ajax({
            url: 'gimnasio/agregarGym/',
            type: 'post',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (respuesta) {
                $('#modalAgregarGym').modal('hide');
                $("#table").DataTable().destroy();
                $("#table tbody").html(respuesta);
                $('#table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    responsive: true, rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    "language": {
                        "sSearch": "Buscar",
                        "lengthMenu": "Mostrar MENU registros",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "zeroRecords": "No se encuentran resultados",
                        "info": "Mostrando registros del START al END de un TOTAL de registros",
                        "oPaginate": {
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
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
            , error: function () {
                console.log('Error');
            }
        });
    });


    /*====================================
    ================MAESTROS==============
    ======================================*/

    /* Funcion para enviar los datos de los MAESTROS*/

    $('#formAgregarMaestros').submit(function (e) {
        e.preventDefault();
        let idEscuela = $('#id').val();
        let nombre = $('#nombre').val();
        let apellido = $('#apellido').val();
        let correo = $('#correo').val();
        let telefono = $('#telefono').val();
        let perfil = $('#perfil').val();
        $.ajax({
            url: 'maestros/agregarMaestros/',
            type: 'post',
            data: { 'id': idEscuela, 'nombre': nombre, 'apellido': apellido, 'correo': correo, 'telefono': telefono, 'perfil': perfil },
            success: function (respuesta) {
                $('#modalAgregarMaestro').modal('hide');
                $('#formAgregarMaestros')[0].reset();
                $('#table').DataTable().destroy();
                $('#table tbody').html(respuesta);
                $('#table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'excel', 'pdf', 'print'
                    ],
                    language: {
                        "sSearch": "Buscar",
                        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "zeroRecords": "No se encuentraron coincidencias",
                        "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    },
                    responsive: true
                });
                Swal.fire({
                    title: "Agregado!",
                    text: "El registro a sido Agregado de forma correcta.",
                    icon: "success"
                });
            }
        });
    });


    /*====================================
    ================ESTUDIANTES==============
    ======================================*/

    /* Función para enviar los datos de los ESTUDIANTES*/
    $('#formAgregarAlumno').submit(function (e) {
        e.preventDefault();
        let extension = $('#imagenEstudiante').val().split('.').pop().toLowerCase();
        e.preventDefault();
        if (extension != '') {
            if (jQuery.inArray(extension, ['png', 'jpg', 'jpeg']) == -1) {
                $('#imagenEstudiante').val('');
                alert("Formato de imagen incorrecto");
                return false;
            }
        }
        $.ajax({
            url: 'estudiante/agregarAlumno/',
            type: 'post',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log("success");
                console.log(data);
                $('#formAgregarAlumno')[0].reset();
                Swal.fire({
                    title: "Agregado!",
                    text: "El registro a sido Agregado de forma correcta.",
                    icon: "success"
                });
            },
            error: function (data) {
                console.log("error");
                console.log(data);
            }
        });
    });


    /*=========================================
        ==========DATOS DE SALUD ESTUDIANTIL===
        ======================================*/

    /*Función para Calcular IMC y categoría de peso*/
    $("#alturaEstudiante, #pesoEstudiante").on("keyup", function () {
        if ($('#alturaEstudiante').val() != "" && $('#pesoEstudiante').val() != "") {
            let peso = parseFloat($('#pesoEstudiante').val() / 2.205);
            let altura = parseFloat($('#alturaEstudiante').val() / 100);
            let imc = parseFloat((peso) / (altura * altura)).toFixed(2);
            $('#imc').val(imc);
            if (imc <= 18.5) {
                $('#categoriaPeso').val("Desnutrición");
            } else if (imc > 18.5 && imc <= 24.9) {
                $('#categoriaPeso').val("Peso normal");
            } else if (imc > 25 && imc <= 29.9) {
                $('#categoriaPeso').val("Sobrepeso");
            } else if (imc > 30) {
                $('#categoriaPeso').val("Obesidad");
            }
        } else {
            $("#imc").val("");
            $("#categoriaPeso").val("");
        }
    });


    /*Envío de DATOS DE SALUD ESTUDIANTIL al BackEnd */
    $('#formAgregarDatosSalud').submit(function (e) {
        e.preventDefault();
        let idEstudiante = $('#idEstudiante').val();
        let pesoEstudiante = $('#pesoEstudiante').val();
        let alturaEstudiante = $('#alturaEstudiante').val();
        let imc = $('#imc').val();
        let categoriaPeso = $('#categoriaPeso').val();
        let somatotipo = $('#somatotipo').val();
        let condicionMedica = $('#condicionMedica').val();
        let descripcionMedica = $('#descripcionMedica').val();
        let medicacion = $('#medicacion').val();
        let = $('#').val();
        $.ajax({
            url: '../salud/agregarDatosSalud/',
            type: 'POST',
            data: {
                'idEstudiante': idEstudiante, 'pesoEstudiante': pesoEstudiante, 'alturaEstudiante': alturaEstudiante, 'imc': imc, 'categoriaPeso': categoriaPeso, 'somatotipo': somatotipo, 'condicionMedica': condicionMedica, 'descripcionMedica': descripcionMedica, 'medicacion': medicacion
            },
            success: function () {
                $('#formAgregarAlumno')[0].reset();
                Swal.fire({
                    title: "Agregado!",
                    text: "El registro ha sido Agregado de forma correcta.",
                    icon: "success"
                });
            }
        });
    });


    /*====================================
        ==============DEPARTAMENTOS==============
        ======================================*/

    /*Funciones para apartado DEPARTAMENTOS*/
    $('#formAgregarDepartamento').submit(function (e) {
        e.preventDefault();
        let nombreDepartamento = $('#nombreDepartamento').val();
        $.ajax({
            url: 'departamento/agregarDepartamento/',
            type: 'post',
            data: { 'nombreDepartamento': nombreDepartamento },
            success: function (respuesta) {
                $('#modalAgregarDepartamento').modal('hide');
                $('#formAgregarDepartamento')[0].reset();
                $('#table').DataTable().destroy();
                $('#table tbody').html(respuesta);
                $('#table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'excel', 'pdf', 'print'
                    ],
                    language: {
                        "sSearch": "Buscar",
                        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "zeroRecords": "No se encuentraron coincidencias",
                        "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    },
                    responsive: true
                });
                Swal.fire({
                    title: "Agregado!",
                    text: "El registro he sido registrado de forma correcta.",
                    icon: "success"
                });
            }
        });
    });

});