///////////////////DOM//////////////////
$(function () {
    /*====================================
    ================FUNCIONES GLOBALES====
    ======================================*/
})

    //Pestañas activas en Menú Lateral
    $('a[href*="' + window.location.pathname + '"]').parents('li, ul').addClass('active');
    $(".sidenav-item-link").click(function () {
        var callItem = $(this);
        callItem.addClass('active');
        $(".sidenav-item-link").not(callItem).removeClass('active');
        var activeurl = window.location.pathname;
        $('a[href="' + activeurl + '"]').parent('li').addClass('active');
        $('a[href="' + activeurl + '"]').parent('li').parent('ul').parent('li').addClass('active');
    });

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

    //Inicializar estudiantes según corresponda
    function inicializarEstudiantes(idGrupos, ruta) {
        $(idGrupos).on("change", function () {
            let idGrupo = $(idGrupos).val();
            console.log(idGrupo);
            $.ajax({
                url: ruta,
                type: 'post',
                data: { idGrupo: idGrupo },
                success: function (respuesta) {
                    $("#table").DataTable().destroy();
                    $("#table tbody").html(respuesta);
                    inicializarDataTable();
                }
            });
        });
    }

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

    /*Alerta de de Registro MATRICULADO */
    function alertaMatriculado() {
        Swal.fire({
            title: "¡Matriculado!",
            text: "Se ha realizado la matrícula del Estudiante adecuadamente.",
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
        $("#idPlanUp").val(datos["id_municipio"]);
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
    $(".tablaEscuelas").on("click", ".BtnBorrarEscuela", function () {
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
                let id = $(this).attr('data-id');
                console.log(id);
                $.ajax({
                    url: 'escuela/borrarEscuela/',
                    type: 'post',
                    data: { id: id },
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
        let formData = new FormData(this);
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
    // AGREGAR Grupo
    $("#formAgregarGrupo").submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
        $.ajax({
            url: "grupo/agregarGrupo/",
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
                        "#modalAgregarGrupo",
                        "#formAgregarGrupo", respuesta);
                    alertaAgregado();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alertaError(jqXHR, textStatus, errorThrown);
            }
        });
    });


    // EDITAR Grupo
    $(".tablaGrupos").on("click", ".btnEditarGrupo", function () {
        let datos = JSON.parse($(this).attr("data-grupo"));
        $("#idGrupo").val(datos["id_grupo"]); // corrected id
        $("#idAxo").val(datos["lectivo_id"]); // corrected id
        $("#idDocenteUp").val(datos["docente_id"]); // corrected id
        $("#gradoGrupo").val(datos["axo_grupo"]); // corrected id
        $("#seccionGrado").val(datos["nombre_grupo"]); // corrected id
        $("#modalidadUp").val(datos["modalidad"]); // no change needed
    });

    // ENVIAR al Backend datos de Grupo editados
    $('#formEditarGrupo').submit(function (e) {
        $("#idGrupo").prop("disabled", false);
        e.preventDefault();
        let formData = new FormData(this);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
        $.ajax({
            url: "grupo/editarGrupo/",
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
                        "#modalEditarGrupo",
                        "#formEditarGrupo", respuesta);
                    alertaModificado();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alertaError(jqXHR, textStatus, errorThrown);
            }
        });
    });

    //ELIMINAR Grupo
    $(".tablaGrupos").on("click", ".BtnBorrarGrupo", function () {
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
                let id_grupoDel = $(this).attr('data-id');
                $.ajax({
                    url: 'grupo/borrarGrupo/',
                    type: 'post',
                    data: { id_grupoDel: id_grupoDel },
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
   ================ESTUDIANTES==============
   ======================================*/

    /* Función para enviar los datos de los ESTUDIANTES*/
    $("#formAgregarEstudiante").submit(function (e) {
        e.preventDefault();
        let extension = $("#foto").val().split(".").pop().toLowerCase();
        if (extension != "") {
            if (jQuery.inArray(extension, ["png", "jpg", "jpeg"]) == -1) {
                $("#foto").val("");
                alert("Formato de imagen incorrecto");
                return false;
            }
        }
        $.ajax({
            url: "estudiante/agregarEstudiante/",
            type: "post",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (respuesta) {
                console.log("Respuesta del servidor:  ", respuesta);
                if (respuesta.includes("Error en la consulta: ")) {
                    alert(respuesta);
                } else {
                    modalFormRespuesta(
                        '#modalAgregarEstudiante', '#formAgregarEstudiante', respuesta
                    );
                    alertaAgregado();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alertaError(jqXHR, textStatus, errorThrown);
            },
        });
    });

    /*EDITAR Estudiante*/
    /*CARGAR los datos de ESTUDIANTE al modal EDITAR*/
    $(".tablaEstudiantes").on("click", ".btnEditarEstudiante", function () {
        let datos = JSON.parse($(this).attr("data-estudiante"));
        $("#idEstudiante").val(datos["id_estudiante"]);
        $("#idEscuelaUp").val(datos["id_escuela"]);
        $("#pNombreUp").val(datos["primer_nombre"]);
        $("#sNombreUp").val(datos["segundo_nombre"]);
        $("#pApellidoUp").val(datos["primer_apellido"]);
        $("#sApellidoUp").val(datos["segundo_apellido"]);
        $("#edadUp").val(datos["edad"]);
        $("#nacimientoUp").val(datos["fecha_nacimiento"]);
        $("#sexoUp").val(datos["sexo"]);
        $("#direccionUp").val(datos["direccion"]);
        $("#telefonoUp").val(datos["telefono"]);
        $("#emailUp").val(datos["email"]);
        $("#tutorUp").val(datos["nombre_tutor"]);
        $("#tutorTelUp").val(datos["telefono_tutor"]);
        $("#estadoUp").val(datos["estado"]);
        $("#fotoEstudiante").attr('src', "../salud.edu/Views/plantilla/images/estudianteFotos/" + datos["imagen"]);
    });

    // ENVIAR al Backend datos de ESTUDIANTES editados
    $('#formEditarEstudiante').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
        $.ajax({
            url: "estudiante/editarEstudiante/",
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
                        "#modalEditarEstudiante",
                        "#formEditarEstudiante", respuesta);
                    alertaModificado();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alertaError(jqXHR, textStatus, errorThrown);
            }
        });
    });

    //ELIMINAR MATERIA
    $(".tablaEstudiantes").on("click", ".BtnBorrarEstudiante", function () {
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
                let idEstudianteDel = $(this).attr('data-id');
                $.ajax({
                    url: 'estudiante/borrarEstudiante/',
                    type: 'post',
                    data: { idEstudianteDel: idEstudianteDel },
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

    /*=====================================
    ===============MATRICULAS==============
    ======================================*/
    $("#matriculaGrupos").on("change", function () {
        $("#BtnMatricular").attr("disabled", false);
    });
    /*REALIZAR Matricula*/
    $(".tablaMatricula").on("click", "#BtnMatricular", function () {
        let estudiante = $(this).attr('data-estudiante');
        let grupo = $("#matriculaGrupos").val();
        $.ajax({
            url: 'matricula/matricular/',
            type: 'post',
            data: { estudiante: estudiante, grupo: grupo },
            success: function (respuesta) {
                postBorrar(respuesta);
                alertaMatriculado();
            }
        });
    });

    /*BORRAR Matricula */
    $(".tablaMatriculados").on("click", "#BtnBorrarMatricula", function () {
        let estudiante = $(this).attr('data-estudiante');
        $.ajax({
            url: 'matriculado/borrarMatricula/',
            type: 'post',
            data: { estudiante: estudiante },
            success: function (respuesta) {
                postBorrar(respuesta);
                alertaEliminado();
            }
        });
    });

    /*====================================
      ================EJERCICIOS==============
      ======================================*/
    /*AGREGAR Ejercicios*/
    $("#formAgregarEjercicio").submit(function (e) {
        e.preventDefault();
        let ejercicio = $("#ejercicio").val();
        let descripcion = $("#descripcion").val();
        let categoria = $("#categoria").val();
        let duracion = $("#duracion").val();
        $.ajax({
            url: "ejercicio/agregarEjercicio/",
            type: "POST",
            data: { ejercicio: ejercicio, descripcion: descripcion,categoria:categoria, duracion: duracion },
            success: function (respuesta) {
                modalFormRespuesta(
                    "#modalAgregarEjercicio",
                    "#formAgregarEjercicio", respuesta);
                alertaAgregado();
            },
        });
    });

    /*EDITAR Ejercicios*/
    /*CARGAR los datos de Ejercicios al modal EDITAR*/
    $(".tablaEjercicios").on("click", ".btnEditarEjercicio", function () {
        let datos = JSON.parse($(this).attr("data-ejercicio"));
        $("#ejercicioUp").val(datos["nombre_ejercicio"]);
        $("#descripcionUp").val(datos["descripcion"]);
        $("#categoriaUp").val(datos["categoria"]);
        $("#duracionUp").val(datos["duracion_estimada"]);
        $("#idEjercicio").val(datos["id_ejercicio"]);
    });

    /*ENVIAR al Backend datos de Ejercicios editados*/
    $('#formEditarEjercicio').submit(function (e) {
        $('#idEjercicio').prop("disabled", false);
        let idEjercicio  = $("#idEjercicio").val();
        let ejercicio = $('#ejercicioUp').val();
        let descripcion = $('#descripcionUp').val();
        let categoria = $('#categoriaUp').val();
        let duracion = $('#duracionUp').val();
        e.preventDefault();
        console.log(idEjercicio,ejercicio,descripcion,categoria,duracion);
        $.ajax({
            url: 'ejercicio/editarEjercicio/',
            type: "POST",
            data: {
                idEjercicio:idEjercicio, ejercicio: ejercicio, descripcion: descripcion, categoria: categoria, duracion: duracion
            },
            success: function (respuesta) {
                modalFormRespuesta(
                    "#modalEditarEjercicio",
                    "#formEditarEjercicio", respuesta
                );
                alertaModificado();
            }
        });
    });

    /*ELIMINAR EJERCICIO*/
    $("#table").on("click", ".BtnBorrarEjercicio", function () {
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
                let idEjercicioDel = $(this).attr('data-id');
                $.ajax({
                    url: 'ejercicio/borrarEjercicio/',
                    type: 'post',
                    data: { idEjercicioDel: idEjercicioDel },
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


    /*=========================================
              ==========DATOS DE SALUD ESTUDIANTIL===
              ======================================*/
    inicializarEstudiantes("#perfilGrupos", 'perfil/getEstudiante/');


    //Cargar datos al Modal
    $(".tablaPerfiles").on("click", ".btnEditarPerfil", function () {
        //Cargar Datos del Estudiante
        let datos = JSON.parse($(this).attr("data-perfil"));
        $("#fotoEstudiante").attr('src', "../salud.edu/Views/plantilla/images/estudianteFotos/" + datos["imagen"]);
        $("#nombreCompleto").html(datos["primer_nombre"] + " " + datos["segundo_nombre"] + " " + datos["primer_apellido"] + " " + datos["segundo_apellido"]);
        $("#idEstudiante").val(datos["id_estudiante"]);
        $("#idGrupo").val(datos["id_grupo"]);
        $("#peso").val(datos["peso"]);
        $("#altura").val(datos["altura"]);
        $("#imc").val(datos["imc"]);
        $("#categoriaPeso").val(datos["categoria_peso"]);
        $("#condicion").val(datos["condicion_medica"]);
        $("#descripcion").val(datos["descripcion"]);
        $("#medicacion").val(datos["medicacion"]);
        $("#somatotipo").val(datos["somatotipo"]);
    });



    //Calcular IMC y Categoría de peso
    $("#altura, #peso").on("keyup", function () {
        if (
            $("#alturaEstudiante").val() != "" &&
            $("#pesoEstudiante").val() != ""
        ) {
            let peso = parseFloat($("#peso").val() / 2.205);
            let altura = parseFloat($("#altura").val() / 100);
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
    $("#formPerfilEstudiante").submit(function (e) {
        e.preventDefault();
        $("#imc").prop("disabled", false);
        $("#categoriaPeso").prop("disabled", false);
        let formData = new FormData(this);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
        $.ajax({
            url: "perfil/agregarPerfil/",
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
                        "#modalPerfilEstudiante",
                        "#formPerfilEstudiante", respuesta);
                    alertaModificado();

                    $("#imc").prop("disabled", true);
                    $("#categoriaPeso").prop("disabled", true);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alertaError(jqXHR, textStatus, errorThrown);
            }
        });
    });



    /*================================================
                  ==========PRUEBAS FÍSICO-MOTRICES===
                  ==================================*/
    //Iniciar Estudiantes
    inicializarEstudiantes("#pruebaGrupos", 'prueba/tablaEstudiante/');
    //Cargar datos al Modal AGREGAR
    $(".tablaPruebas").on("click", ".BtnAgregarPrueba", function () {
        //Cargar Datos del Estudiante
        let datos = JSON.parse($(this).attr("data-prueba"));
        $("#fotoEstudiante").attr('src', "../salud.edu/Views/plantilla/images/estudianteFotos/" + datos["imagen"]);
        $("#nombreCompleto").html(datos["primer_nombre"] + " " + datos["segundo_nombre"] + " " + datos["primer_apellido"] + " " + datos["segundo_apellido"]);
        $("#idEstudiante").val(datos["id_estudiante"]);
        $("#idGrupo").val(datos["id_grupo"]);
    });

    // Unidad de medida
    $("#prueba").on("change", function () {
        const pruebaValue = $("#prueba").val();
        const medidaMap = {
            "Resistencia": "min/500m",
            "Fuerza": "kg/set",
            "Velocidad": "m/s",
            "Salto": "metros",
            "Lanzamiento": "metros"
        };
        $("#medida").val(medidaMap[pruebaValue]);
    });

    /*Envío de DATOS DE SALUD ESTUDIANTIL al BackEnd */
    $("#formAgregarPrueba").submit(function (e) {
        e.preventDefault();
        $("#medida").prop("disabled", false);
        let formData = new FormData(this);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }
        $.ajax({
            url: "prueba/agregarPrueba/",
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
                        "#modalAgregarPrueba",
                        "#formAgregarPrueba", respuesta);
                    alertaAgregado();
                    $("#medida").prop("disable", true)
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alertaError(jqXHR, textStatus, errorThrown);
            }
        });
    });

    /*====================================
    ==============PLAN EJERCICIO==============
  ======================================*/
  /*AGREGAR Ejercicios*/
  $("#formAgregarPlan").submit(function (e) {
    e.preventDefault();
    let Nrepeticiones = $("#nRepeticiones").val();
    let Nseries = $("#nSeries").val();
    $.ajax({
        url: "plan/agregarPlan/",
        type: "POST",
        data: { Nrepeticiones: Nrepeticiones, Nseries: Nseries},
        success: function (respuesta) {
            modalFormRespuesta(
                "#modalAgregarPlan",
                "#formAgregarPlan", respuesta);
            alertaAgregado();
        },
    });
});

/*EDITAR Ejercicios*/
/*CARGAR los datos de Ejercicios al modal EDITAR*/
$(".tablaplan").on("click", ".btnEditarPlan", function () {
    let datos = JSON.parse($(this).attr("data-ejercicios_plan"));
    $("#nRepeticionesUp").val(datos["repeticiones"]);
    $("#nSeriesUp").val(datos["series"]);

/*ENVIAR al Backend datos de Ejercicios editados*/
$('#formEditarPlan').submit(function (e) {
    $('#idPlan').prop("disabled", false);
    let idPlan  = $("#idPlan").val();
    let nRepeticiones = $('#repeticionesUp').val();
    let nSeries = $('#seriesUp').val();
    e.preventDefault();
    console.log(idPlan,nRepeticiones,nSeries);
    $.ajax({
        url: 'plan/editarPlan/',
        type: "POST",
        data: {
            idPlan:idPlan, Nrepeticiones: Nrepeticiones, Nseries: Nseries
        },
        success: function (respuesta) {
            modalFormRespuesta(
                "#modalEditarPlan",
                "#formEditarPlan", respuesta
            );
            alertaModificado();
        }
    });XMLDocument
});

/*ELIMINAR EJERCICIO*/
$("#table").on("click", ".BtnBorrarPlan", function () {
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
            let idPlan = $(this).attr('data-id');
            $.ajax({
                url: 'plan/borrarPlan/',
                type: 'post',
                data: { idPlan: idPlan },
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
});
/*====================================================
==========OTROS EVENTOS FUERA DEL DOM===
======================================*/

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
