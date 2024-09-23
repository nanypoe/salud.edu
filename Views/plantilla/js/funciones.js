///////////////////DOM//////////////////
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
    function alertaError(jqXHR, textStatus, errorThrown) {
        Swal.fire({
            title: "Error",
            text: "Ha ocurrido el siguiente error: " + textStatus + ". Error Thrown: " + errorThrown + ". Reponse Text: " + jqXHR.responseText,
            icon: "error",
        });
    }

    //CARGAR Datos en Modal
    /* Funcion para cargar municipios segun el departamento seleccionado */
    function cargarMunicipioModal(idDpto, idMunic, dirFunction) {
        $(idDpto).on("change", function () {
            let idDepartamento = $(idDpto).val();
            $.ajax({
                url: dirFunction,
                type: 'post',
                data: { 'idDepartamento': idDepartamento },
                success: function (respuesta) {
                    $(idMunic).prop("disabled", false);
                    $(idMunic).html(respuesta);
                }
            });
        });
    }

    //Función para cargar municipios en el MODAL Editar
    function editarMunicipioModal(idDpto, idMunic, dirFunction, idMunicipio = null) {
        let idDepartamento = $(idDpto).val();
        $.ajax({
            url: dirFunction,
            type: 'post',
            data: { 'idDepartamento': idDepartamento },
            success: function (respuesta) {
                $(idMunic).prop("disabled", false);
                $(idMunic).html(respuesta);
                if (idMunicipio) {
                    $(idMunic).val(idMunicipio); // Setear el valor una vez que las opciones se hayan cargado
                }
            }
        });
    }

    /*====================================
                 ==============USUARIOS==============
                 ======================================*/
    /*AGREGAR Usuario*/
    $("#formAgregarUsuario").submit(function (e) {
        e.preventDefault();
        let user = $('#usuario').val();
        let clave = $('#clave').val();
        let rol = $('#rolUsuario').val();
        $.ajax({
            url: "usuario/agregarUsuario",
            type: "post",
            data: { user: user, clave: clave, rol: rol },
            success: function (respuesta) {
                modalFormRespuesta(
                    "#modalAgregarUsuario",
                    "#formAgregarUsuario", respuesta);
                alertaAgregado();
            },
        });
    });

    /*EDITAR Usuario*/
    /*CARGAR los datos de USUARIO al modal EDITAR*/
    $(".tablaUsuario").on("click", ".btnEditarUsuario", function () {
        let datos = JSON.parse($(this).attr("data-usuario"));
        $("#idUsr").val(datos["id_usuario"]);
        $("#usuarioUp").val(datos["usuario"]);
    });

    /*ENVIAR al Backend datos de USUARIOS editados*/
    $('#formEditarUsuario').submit(function (e) {
        $('#idUsr').prop("disabled", false);
        let idUsr = $('#idUsr').val();
        let usuarioUp = $('#usuarioUp').val();
        let passUp = $('#passUp').val();
        let rolUp = $('#rolUp').val();
        e.preventDefault();
        $.ajax({
            url: 'usuario/editarUsuario/',
            type: "POST",
            data: {
                idUsr: idUsr, usuarioUp: usuarioUp, passUp: passUp, rolUp: rolUp
            },
            success: function (respuesta) {
                modalFormRespuesta(
                    "#modalEditarUsuario",
                    "#formEditarUsuario", respuesta
                );
                alertaModificado();
            }
        });
    });

    /*ELIMINAR Usuario*/
    $("#table").on("click", ".BtnBorrarUsuario", function () {
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
                let idUsrDel = $(this).attr('data-id');
                $.ajax({
                    url: 'usuario/borrarUsuario/',
                    type: 'post',
                    data: { idUsrDel: idUsrDel },
                    success: function (respuesta) {
                        postBorrar(respuesta);
                        alertaEliminado();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alertaError(jqXHR, textStatus, errorThrown);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                alertaCancelado();
            }
        });
    });

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
                $.ajax({
                    url: 'departamento/borrarDepartamento/',
                    type: 'post',
                    data: { idDptoDel: idDptoDel },
                    success: function (respuesta) {
                        postBorrar(respuesta);
                        alertaEliminado();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alertaError(jqXHR, textStatus, errorThrown);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                alertaCancelado();
            }
        });
    });

    /*====================================
             ==============AÑO LECTIVO==============
             ======================================*/
    /*AGREGAR Año Lectivo */
    $("#formAgregarLectivo").submit(function (e) {
        e.preventDefault();
        let lectivo = $("#lectivo").val();
        $.ajax({
            url: "lectivo/agregarLectivo/",
            type: "post",
            data: { lectivo: lectivo },
            success: function (respuesta) {
                modalFormRespuesta(
                    "#modalAgregarLectivo",
                    "#formAgregarLectivo", respuesta);
                alertaAgregado();
            },
        });
    });

    /*EDITAR Lectivo*/
    /*CARGAR los datos de LECTIVO al modal EDITAR*/
    $(".tablaLectivo").on("click", ".btnEditarLectivo", function () {
        let datos = JSON.parse($(this).attr("data-lectivo"));
        $("#idLectivo").val(datos["id_lectivo"]);
        $("#axo").val(datos["axo"]);
    });

    /*ENVIAR al Backend datos de AÑO Lectivo editados*/
    $('#formEditarLectivo').submit(function (e) {
        $('#idLectivo').prop("disabled", false);
        let idLectivo = $('#idLectivo').val();
        let axo = $('#axo').val();
        e.preventDefault();
        $.ajax({
            url: 'lectivo/editarLectivo/',
            type: "POST",
            data: {
                idLectivo: idLectivo, axo: axo
            },
            success: function (respuesta) {
                modalFormRespuesta(
                    "#modalEditarLectivo",
                    "#formEditarLectivo", respuesta
                );
                alertaModificado();
            }
        });
    });

    /*ELIMINAR Año Lectivo*/
    $("#table").on("click", ".BtnBorrarLectivo", function () {
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
                let idLectivoDel = $(this).attr('data-id');
                $.ajax({
                    url: 'lectivo/borrarLectivo/',
                    type: 'post',
                    data: { idLectivoDel: idLectivoDel },
                    success: function (respuesta) {
                        postBorrar(respuesta);
                        alertaEliminado();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alertaError(jqXHR, textStatus, errorThrown);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                alertaCancelado();
            }
        });
    });

    /*====================================
      ================MUNICIPIOS==============
      ======================================*/
    /*AGREGAR Departamentos*/
    $("#formAgregarMunicipio").submit(function (e) {
        e.preventDefault();
        let dptoId = $("#dptoId").val();
        let municipio = $("#municipio").val();
        $.ajax({
            url: "municipio/agregarMunicipio/",
            type: "POST",
            data: { dptoId: dptoId, municipio: municipio },
            success: function (respuesta) {
                modalFormRespuesta(
                    "#modalAgregarMunicipio",
                    "#formAgregarMunicipio", respuesta);
                alertaAgregado();
            },
        });
    });

    /*EDITAR Municipios*/
    /*CARGAR los datos de MUNICIPIOS al modal EDITAR*/
    $(".tablaMunicipios").on("click", ".btnEditarMunicipio", function () {
        let datos = JSON.parse($(this).attr("data-municipio"));
        $("#muniIdUp").val(datos["id_municipio"]);
        $("#municipioUp").val(datos["nombre_municipio"]);
    });

    /*ENVIAR al Backend datos de AÑO Municipios editados*/
    $('#formEditarMunicipio').submit(function (e) {
        $('#muniIdUp').prop("disabled", false);
        let muniIdUp = $('#muniIdUp').val();
        let municipioUp = $('#municipioUp').val();
        e.preventDefault();
        $.ajax({
            url: 'municipio/editarMunicipio/',
            type: "POST",
            data: {
                muniIdUp: muniIdUp, municipioUp: municipioUp
            },
            success: function (respuesta) {
                modalFormRespuesta(
                    "#modalEditarMunicipio",
                    "#formEditarMunicipio", respuesta
                );
                alertaModificado();
            }
        });
    });

    /*ELIMINAR Municipio*/
    $("#table").on("click", ".BtnBorrarMunicipio", function () {
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
                let idMunicipioDel = $(this).attr('data-id');
                $.ajax({
                    url: 'municipio/borrarMunicipio/',
                    type: 'post',
                    data: { idMunicipioDel: idMunicipioDel },
                    success: function (respuesta) {
                        postBorrar(respuesta);
                        alertaEliminado();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alertaError(jqXHR, textStatus, errorThrown);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                alertaCancelado();
            }
        });
    });

    /*====================================
      ================ESCUELAS==============
      ======================================*/
    /*AGREGAR Escuelas*/
    cargarMunicipioModal("#dptoEscuela", "#municEscuela", "escuela/obtenerMunicipio/");
    $("#formAgregarEscuela").submit(function (e) {
        e.preventDefault();
        $('#municEscuela').prop("disabled", false);
        $.ajax({
            url: "escuela/agregarEscuela/",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (respuesta) {
                console.log("Respuesta del servidor: ", respuesta);
                if (respuesta.includes("Error en la consulta: ")) {
                    alert(respuesta);
                } else {
                    modalFormRespuesta(
                        "#modalAgregarEscuela",
                        "#formAgregarEscuela", respuesta);
                    alertaAgregado();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alertaError(jqXHR, textStatus, errorThrown);
            }
        });
    });

    //EDITAR Escuelas
    /*CARGAR los datos de ESCUELAS al modal EDITAR*/
    $(".tablaEscuelas").on("click", ".btnEditarEscuela", function () {
        let datos = JSON.parse($(this).attr("data-escuela"));
        $("#idAñoLectivoUp").val(datos["id_lectivo"]);
        $("#idEscuela").val(datos["id_escuela"]);
        $("#dptoEscuelaUp").val(datos["id_departamento"]);
        $("#nombreEscuelaUp").val(datos["nombre"]);
        $("#direccionEscuelaUp").val(datos["direccion"]);
        $("#telefonoEscuelaUp").val(datos["telefono"]);
        $("#longitudEscuelaUp").val(datos["longitud"]);
        $("#latitudEscuelaUp").val(datos["latitud"]);

        // Cargar el municipio basado en el departamento seleccionado
        editarMunicipioModal("#dptoEscuelaUp", "#municEscuelaUp", "escuela/obtenerMunicipio/", datos["id_municipio"]);
        cargarMunicipioModal("#dptoEscuelaUp", "#municEscuelaUp", "escuela/obtenerMunicipio/");
    });

    /*ENVIAR al Backend datos de ESCUELAS editados*/
    $('#formEditarEscuela').submit(function (e) {
        $('#idEscuela').prop("disabled", false);
        e.preventDefault();
        let formData = new FormData(this);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
        $.ajax({
            url: "escuela/editarEscuela/",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (respuesta) {
                console.log("Respuesta del servidor: ", respuesta);
                if (respuesta.includes("Error en la consulta: ")) {
                    alert(respuesta);
                } else {
                    modalFormRespuesta(
                        "#modalEditarEscuela",
                        "#formEditarEscuela", respuesta);
                    alertaModificado();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alertaError(jqXHR, textStatus, errorThrown);
            }
        });
    });

    //ELIMINAR Escuelas
    $("#table").on("click", ".BtnBorrarEscuela", function () {
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
                let idEscuelaDel = $(this).attr('data-id');
                $.ajax({
                    url: 'escuela/borrarEscuela/',
                    type: 'post',
                    data: { idEscuelaDel: idEscuelaDel },
                    success: function (respuesta) {
                        postBorrar(respuesta);
                        alertaEliminado();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alertaError(jqXHR, textStatus, errorThrown);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                alertaCancelado();
            }
        });
    });

    /*====================================
      ================DOCENTES==============
      ======================================*/
// AGREGAR Docente
$("#formAgregarDocente").submit(function (e) {
    e.preventDefault();
    let formData  = new FormData(this);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }
    $.ajax({
        url: "docente/agregarDocente/",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            console.log("Respuesta del servidor: ", respuesta);
            if (respuesta.includes("Error en la consulta: ")) {
                alert(respuesta);
            } else {
                modalFormRespuesta(
                    "#modalAgregarDocente",
                    "#formAgregarDocente", respuesta);
                alertaAgregado();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertaError(jqXHR, textStatus, errorThrown);
        }
    });
});

// EDITAR Docente
$(".tablaDocentes").on("click", ".btnEditarDocente", function () {
    let datos = JSON.parse($(this).attr("data-docente"));
    $("#idDocenteUp").val(datos["id_docente"]);
    $("#escuelaDocenteUp").val(datos["id_escuela"]);
    $("#nombreDocenteUp").val(datos["nombre"]);
    $("#apellidoDocenteUp").val(datos["apellido"]);
    $("#emailDocenteUp").val(datos["email"]);
    $("#telefonoDocenteUp").val(datos["telefono"]);
    $("#perfilDocenteUp").val(datos["perfil"]);
});

// ENVIAR al Backend datos de Docente editados
$('#formEditarDocente').submit(function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }
    $.ajax({
        url: "docente/editarDocente/",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            console.log("Respuesta del servidor: ", respuesta);
            if (respuesta.includes("Error en la consulta: ")) {
                alert(respuesta);
            } else {
                modalFormRespuesta(
                    "#modalEditarDocente",
                    "#formEditarDocente", respuesta);
                alertaModificado();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertaError(jqXHR, textStatus, errorThrown);
        }
    });
});

//ELIMINAR Docentes
$("#table").on("click", ".BtnBorrarDocente", function () {
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
            let idDocenteDel = $(this).attr('data-id');
            $.ajax({
                url: 'docente/borrarDocente/',
                type: 'post',
                data: { idDocenteDel: idDocenteDel },
                success: function (respuesta) {
                    postBorrar(respuesta);
                    alertaEliminado();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alertaError(jqXHR, textStatus, errorThrown);
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            alertaCancelado();
        }
    });
});

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

    $("#formAgregarMateria").submit(function (e) {
        e.preventDefault();
        let idGrupo = $("#idGrupo").val();
        let idMaestro = $("#idMaestro").val();
        let nombreMateria = $("#nombreMateria").val();
        $.ajax({
            url: "materia/agregarMateria/",
            type: "post",
            data: { idGrupo: idGrupo, idMaestro: idMaestro, nombreMateria: nombreMateria },
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
    $("#formAgregarMateria").submit(function (e) {
        e.preventDefault();
        let idE = $("#idE").val();
        let tipoPrueba = $("#tipoPrueba").val();
        let resultadoPrueba = $("#resultadoPrueba").val();
        let unidadPrueba = $("#unidadPrueba").val();
        let observacionPrueba = $("#observacionPrueba").val();
        let axo = $("#axo").val();
        $.ajax({
            url: "prueba/agregarPrueba/",
            type: "post",
            data: { idE: idE, tipoPrueba: tipoPrueba, resultadoPrueba: resultadoPrueba, unidadPrueba: unidadPrueba, observacionPrueba: observacionPrueba, axo: axo },
            success: function (respuesta) {
                modalFormRespuesta(
                    "#modalAgregarPrueba",
                    "#formAgregarPrueba", respuesta);
                alertaAgregado();
            },
        });
    });

});


//////////EVENTOS FUERA DEL DOM/////////////

/*Función para ocultar pass*/
function ocultarPass(elemento, icono) {
    let input = $(elemento).attr('type');
    if (input == "password") {
        $(elemento).attr('type', 'text');
        $(icono).removeClass('fa-eye');
        $(icono).addClass('fa-eye-slash');
    } else {
        $(elemento).attr('type', 'password');
        $(icono).removeClass('fa-eye-slash');
        $(icono).addClass('fa-eye');
    }
}