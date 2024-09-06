$(function () {
    /*====================================
    ================FUNCIONES GLOBALES====
    ======================================*/

    /*===== Inicialización de DATATABLES =====*/
    function inicializarDataTable() {
        $("#table").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "excel", "pdf", "print"],
            language: {
                sSearch: "Buscar",
                info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                zeroRecords: "No se encuentraron coincidencias",
                infoEmpty: "Mostrando 0 a 0 de 0 registros",
                infoFiltered: "(filtrado de un total de _MAX_ registros)",
            },
            responsive: true
        });
    }
    inicializarDataTable();

    /*Reinicialización de MODAL: recibe como parámetros el id del Modal y el id del Form*/

    function modalFormRespuesta(modal, form, respuesta) {
        $(modal).modal("hide");
        $(form)[0].reset();
        $("#table").DataTable().destroy();
        $("#table tbody").html(respuesta);
        inicializarDataTable();
    }

    /*Reinicialización del DataTable después de BORRAR*/
    function postBorrar(respuesta) {
        $('#table').DataTable().destroy();
        $('#table tbody').html(respuesta);
        inicializarDataTable();
    }

    /*=============ALERTAS=============*/
    /*Alerta de de Registro AGREGADO */
    function alertaAgregado() {
        Swal.fire({
            title: "¡Agregado!",
            text: "Se ha agregado el registro de forma correcta",
            icon: "success",
        });
    }
    /*Alerta de de Registro MODIFICADO */
    function alertaModificado() {
        Swal.fire({
            title: "¡Modificado!",
            text: "Se ha modificado el registro de forma correcta",
            icon: "success",
        });
    }
    /*Alerta de de Registro ELIMINADO */
    function alertaEliminado() {
        Swal.fire({
            title: "¡Eliminado!",
            text: "Se ha eliminado el registro de forma correcta",
            icon: "success",
        });
    }
    /*Alerta de CANCELADO*/
    function alertaCancelado() {
        Swal.fire({
            title: "Accion Cancelada",
            text: "El registro no sufrió ningun cambio :)",
            icon: "error"
        });
    }
    /*Alerta de ERROR*/
    function alertaError(jqXHR, textStatus, errorThrown){
        Swal.fire({
            title: "Error",
            text: "Ha ocurrido el siguiente error: "+textStatus+ ". Error Thrown: "+errorThrown+ ". Reponse Text: "+jqXHR.responseText,
            icon: "error",
        });
    }

    /*====================================
             ==============DEPARTAMENTOS==============
             ======================================*/

    /*AGREGAR Departamentos*/
    $("#formAgregarDepartamento").submit(function (e) {
        e.preventDefault();
        let nombreDpto = $("#nombreDpto").val();
        $.ajax({
            url: "departamento/agregarDepartamento/",
            type: "post",
            data: { nombreDpto: nombreDpto },
            success: function (respuesta) {
                modalFormRespuesta(
                    "#modalAgregarDepartamento",
                    "#formAgregarDepartamento", respuesta);
                alertaAgregado();
            },
        });
    });

    /*EDITAR Departamentos*/
    /*CARGAR los datos de DEPARTAMENTOS al modal EDITAR*/
    $(".tablaDepartamentos").on("click", ".btnEditarDepartamento", function () {
        let datos = JSON.parse($(this).attr("data-departamentos"));
        $("#nombreDptoUp").val(datos["nombre_departamento"]);
        $("#idDpto").val(datos["id_departamento"]);
    });

    /*ENVIAR al Backend datos de DEPARTAMENTOS editados*/
    $('#formEditarDepartamento').submit(function (e) {
        $('#idDpto').prop("disabled", false);
        let idDpto = $('#idDpto').val();
        let nombreDptoUp = $('#nombreDptoUp').val();
        e.preventDefault();
        $.ajax({
            url: 'departamento/editarDepartamento/',
            type: "POST",
            data: {
                idDpto: idDpto, nombreDptoUp: nombreDptoUp
            },
            success: function (respuesta) {
                modalFormRespuesta(
                    "#modalEditarDepartamento",
                    "#formEditarDepartamento", respuesta
                );
                alertaModificado();
            }
        });
    });

    /*ELIMINAR Departamento*/
    $("#table").on("click", ".BtnBorrarDepartamento", function () {
        Swal.fire({
            title: "¿Estas seguro?",
            text: "Que deseas eliminar el registro!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Eliminar!",
            cancelButtonText: "No, Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                let idDptoDel = $(this).attr('data-id');
                console.log(idDptoDel);
                $.ajax({
                    url: 'departamento/borrarDepartamento/',
                    type: 'post',
                    data: { idDptoDel: idDptoDel },
                    success: function (respuesta) {
                        postBorrar(respuesta);
                        alertaEliminado();
                    },
                    error:function (jqXHR, textStatus, errorThrown){
                        alertaError(jqXHR, textStatus, errorThrown);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                alertaCancelado();
            }
        });

        /*====================================
          ================MUNICIPIOS==============
          ======================================*/

        /*====================================
        ================AÑO LECTIVO==============
        ======================================*/

        /*====================================
          ================ESCUELAS==============
          ======================================*/

        /*===== Funcion para enviar los datos de las ESCUELAS =====*/
        $("#formAgregarEscuela").submit(function (e) {
            e.preventDefault();
            let nombreEscuela = $("#nombreEscuela").val();
            let direccionEscuela = $("#direccionEscuela").val();
            let telefonoEscuela = $("#telefonoEscuela").val();
            let latitudEscuela = $("#latitudEscuela").val();
            let longitudEscuela = $("#longitudEscuela").val();

            $.ajax({
                url: "escuela/agregarEscuela/",
                type: "post",
                data: {
                    nombreEscuela: nombreEscuela,
                    direccionEscuela: direccionEscuela,
                    telefonoEscuela: telefonoEscuela,
                    latitudEscuela: latitudEscuela,
                    longitudEscuela: longitudEscuela,
                },
                success: function (respuesta) {
                    $("#modalAgregarEscuela").modal("hide");
                    $("#formAgregarEscuela")[0].reset();
                    $("#table").DataTable().destroy();
                    $("#table tbody").html(respuesta);
                    $("#table").DataTable({
                        dom: "Bfrtip",
                        buttons: ["copy", "excel", "pdf", "print"],
                        language: {
                            sSearch: "Buscar",
                            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            zeroRecords: "No se encuentraron coincidencias",
                            infoEmpty: "Mostrando 0 a 0 de 0 registros",
                            infoFiltered: "(filtrado de un total de _MAX_ registros)",
                        },
                        responsive: true,
                    });
                    Swal.fire({
                        title: "Agregado!",
                        text: "El registro he sido registrado de forma correcta.",
                        icon: "success",
                    });
                },
            });
        });

        /*====================================
          ================GRADOS==============
          ======================================*/

        /*====================================
        ================GRUPOS==============
        ======================================*/
        /*===== Funcion para enviar los datos de las GRUPOS =====*/
        $("#formAgregarGrupo").submit(function (e) {
            e.preventDefault();
            let gradoGrupo = $("#gradoGrupo").val();
            let seccionGrupo = $("#seccionGrupo").val();
            let turnoGrupo = $("#turnoGrupo").val();
            let modalidadGrupo = $("#modalidadGrupo").val();
            let axoGrupo = $("#axoGrupo").val();

            $.ajax({
                url: "grupo/agregarGrupo/",
                type: "post",
                data: {
                    gradoGrupo: gradoGrupo,
                    seccionGrupo: seccionGrupo,
                    turnoGrupo: turnoGrupo,
                    modalidadGrupo: modalidadGrupo,
                    axoGrupo: axoGrupo,
                },
                success: function (respuesta) {
                    $("#modalAgregarGrupo").modal("hide");
                    $("#formAgregarGrupo")[0].reset();
                    $("#table").DataTable().destroy();
                    $("#table tbody").html(respuesta);
                    $("#table").DataTable({
                        dom: "Bfrtip",
                        buttons: ["copy", "excel", "pdf", "print"],
                        language: {
                            sSearch: "Buscar",
                            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            zeroRecords: "No se encuentraron coincidencias",
                            infoEmpty: "Mostrando 0 a 0 de 0 registros",
                            infoFiltered: "(filtrado de un total de _MAX_ registros)",
                        },
                        responsive: true,
                    });
                    Swal.fire({
                        title: "Agregado!",
                        text: "El registro he sido registrado de forma correcta.",
                        icon: "success",
                    });
                },
            });
        });

        /*====================================
       ================ESTUDIANTES==============
       ======================================*/

        /* Función para enviar los datos de los ESTUDIANTES*/
        $("#formAgregarAlumno").submit(function (e) {
            e.preventDefault();
            let extension = $("#imagen").val().split(".").pop().toLowerCase();
            if (extension != "") {
                if (jQuery.inArray(extension, ["png", "jpg", "jpeg"]) == -1) {
                    $("#imagen").val("");
                    alert("Formato de imagen incorrecto");
                    return false;
                }
            }
            console.log(extension);
            $.ajax({
                url: "../estudiante/agregarAlumno/",
                type: "post",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (respuesta) {
                    console.log("success");
                    console.log(respuesta);
                    $("#formAgregarAlumno")[0].reset();
                    Swal.fire({
                        title: "Agregado!",
                        text: "El registro a sido Agregado de forma correcta.",
                        icon: "success",
                    });
                },
                error: function () {
                    console.log("Error");
                },
            });
        });

        /*=========================================
                  ==========DATOS DE SALUD ESTUDIANTIL===
                  ======================================*/

        /*Función para Calcular IMC y categoría de peso*/
        $("#alturaEstudiante, #pesoEstudiante").on("keyup", function () {
            if (
                $("#alturaEstudiante").val() != "" &&
                $("#pesoEstudiante").val() != ""
            ) {
                let peso = parseFloat($("#pesoEstudiante").val() / 2.205);
                let altura = parseFloat($("#alturaEstudiante").val() / 100);
                let imc = parseFloat(peso / (altura * altura)).toFixed(2);
                $("#imc").val(imc);
                if (imc <= 18.5) {
                    $("#categoriaPeso").val("Desnutrición");
                } else if (imc > 18.5 && imc <= 24.9) {
                    $("#categoriaPeso").val("Peso normal");
                } else if (imc > 25 && imc <= 29.9) {
                    $("#categoriaPeso").val("Sobrepeso");
                } else if (imc > 30) {
                    $("#categoriaPeso").val("Obesidad");
                }
            } else {
                $("#imc").val("");
                $("#categoriaPeso").val("");
            }
        });

        /*Envío de DATOS DE SALUD ESTUDIANTIL al BackEnd */
        $("#formAgregarDatosSalud").submit(function (e) {
            e.preventDefault();
            let idEstudiante = $("#idEstudiante").val();
            let pesoEstudiante = $("#pesoEstudiante").val();
            let alturaEstudiante = $("#alturaEstudiante").val();
            let imc = $("#imc").val();
            let categoriaPeso = $("#categoriaPeso").val();
            let somatotipo = $("#somatotipo").val();
            let condicionMedica = $("#condicionMedica").val();
            let descripcionMedica = $("#descripcionMedica").val();
            let medicacion = $("#medicacion").val();
            $("#imc").prop("disabled", false);
            $("#categoriaPeso").prop("disabled", false);
            $.ajax({
                url: "../salud/agregarDatosSalud/",
                type: "post",
                data: {
                    idEstudiante: idEstudiante,
                    pesoEstudiante: pesoEstudiante,
                    alturaEstudiante: alturaEstudiante,
                    imc: imc,
                    categoriaPeso: categoriaPeso,
                    somatotipo: somatotipo,
                    condicionMedica: condicionMedica,
                    descripcionMedica: descripcionMedica,
                    medicacion: medicacion,
                },
                success: function (respuesta) {
                    console.log(respuesta);
                    $("#formAgregarDatosSalud")[0].reset();
                    $("#imc").prop("disabled", true);
                    $("#categoriaPeso").prop("disabled", true);
                    Swal.fire({
                        title: "Agregado!",
                        text: "El registro ha sido Agregado de forma correcta.",
                        icon: "success",
                    });
                },
            });
        });


        /*====================================
          ================MAESTROS==============
          ======================================*/

        /* Funcion para enviar los datos de los MAESTROS*/

        $("#formAgregarMaestros").submit(function (e) {
            e.preventDefault();
            let idEscuela = $("#id").val();
            let nombre = $("#nombre").val();
            let apellido = $("#apellido").val();
            let correo = $("#correo").val();
            let telefono = $("#telefono").val();
            let perfil = $("#perfil").val();
            $.ajax({
                url: "maestros/agregarMaestros/",
                type: "post",
                data: {
                    id: idEscuela,
                    nombre: nombre,
                    apellido: apellido,
                    correo: correo,
                    telefono: telefono,
                    perfil: perfil,
                },
                success: function (respuesta) {
                    $("#modalAgregarMaestro").modal("hide");
                    $("#formAgregarMaestros")[0].reset();
                    $("#table").DataTable().destroy();
                    $("#table tbody").html(respuesta);
                    $("#table").DataTable({
                        dom: "Bfrtip",
                        buttons: ["copy", "excel", "pdf", "print"],
                        language: {
                            sSearch: "Buscar",
                            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            zeroRecords: "No se encuentraron coincidencias",
                            infoEmpty: "Mostrando 0 a 0 de 0 registros",
                            infoFiltered: "(filtrado de un total de _MAX_ registros)",
                        },
                        responsive: true,
                    });
                    Swal.fire({
                        title: "Agregado!",
                        text: "El registro a sido Agregado de forma correcta.",
                        icon: "success",
                    });
                },
            });
        });



        /*====================================
          ================MATERIA==============
          ======================================*/
        /*AGREGAR Materias*/
       
    $("#formAgregarMateria").submit(function(e){
        e.preventDefault();
        let idGrupo = $("#idGrupo").val();
        let idMaestro = $("#idMaestro").val();
        let nombreMateria = $("#nombreMateria").val();
        $.ajax({
            url: "materia/agregarMateria/",
            type: "post",
            data: { idGrupo:idGrupo, idMaestro:idMaestro, nombreMateria: nombreMateria },
            success: function (respuesta) {
                modalFormRespuesta(
                    "#modalAgregarMateria",
                    "#formAgregarMateria", respuesta);
                alertaAgregado();
            },
        });
    });

        /*====================================
        ==PRUEBAS FÍSICO-MOTRICES==============
        ======================================*/


    });
});