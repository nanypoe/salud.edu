<?php

class estudianteController extends Controller
{
    private $_estudiante;

    function __construct()
    {
        parent::__construct();
        $this->_estudiante = $this->loadModel('estudiante');
    }

    /*Función para RENDERIZAR la Vista REGISTRO Y LISTADO DE ESTUDIANTES*/
    public function index()
    {
        /*Mandar DATOS de GRUPOS a la Vista ESTUDIANTES*/
        $filaAxo = $this->_estudiante->obtenerGrupos();
        $grupos = '<option value="0"> Seleccione un Grupo</option>';
        for ($i = 0; $i < count($filaAxo); $i++) {
            $grupos .= '<option value="' . $filaAxo[$i]['id_grupo'] . '">' . $filaAxo[$i]['axo_grupo'] . '</option>';
        }
        $this->_view->grupos = $grupos;

        /*Mandar DATOS de ESCUELAS a la Vista ESTUDIANTES*/
        $fila = $this->_estudiante->obtenerEscuelas();
        $escuelas = '<option value="0"> Seleccione una Escuela</option>';
        for ($i = 0; $i < count($fila); $i++) {
            $escuelas .= '<option value="' . $fila[$i]['id_escuela'] . '">' . $fila[$i]['nombre_escuela'] . '</option>';
        }
        $this->_view->escuelas = $escuelas;

        $this->_view->tabla = $this->verEstudiantes();
        $this->_view->renderizar('estudiante');
    }

    //OBTENER Datos de la tabla ESTUDIANTES en DataTable
    public function verEstudiantes()
    {
        $fila = $this->_estudiante->obtenerEstudiantes();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
            <tr>
                <td>' . $fila[$i]['id_estudiante'] . '</td>
                <td>' . $fila[$i]['axo_grupo'] . '</td>
                <td>' . $fila[$i]['nombre_completo'] . '</td>
                <td>' . $fila[$i]['edad'] . '</td>
                <td>' . $fila[$i]['fecha_nacimiento'] . '</td>
                <td>' . $fila[$i]['sexo'] . '</td>
                <td>' . $fila[$i]['direccion'] . '</td>
                <td>' . $fila[$i]['telefono'] . '</td>
                <td>' . $fila[$i]['email'] . '</td>
                <td>' . $fila[$i]['nombre_tutor'] . '</td>
                <td>' . $fila[$i]['telefono_tutor'] . '</td>
                <td>' . $fila[$i]['imagen'] . '</td>
                <td>' . $fila[$i]['estado'] . '</td>
                <td>
                <button data-estudiante=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarEstudiante" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarEstudiante"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>
                <button data-id=' . $fila[$i]['id_estudiante'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarEstudiante"><i class="fa-solid fa-trash"></i> Borrar</button>
                </td>
            </tr>
            ';
        }
        return $tabla;
    }

    //AGREGAR Estudiante
    public function agregarEstudiante()
    {
        $this->_estudiante->agregarEstudiante(
            $this->getTexto('idSeccion'),
            $this->getTexto('idEscuela'),
            $this->getTexto('pNombre'),
            $this->getTexto('sNombre'),
            $this->getTexto('pApellido'),
            $this->getTexto('sApellido'),
            $this->getTexto('edad'),
            $this->getTexto('nacimiento'),
            $this->getTexto('sexo'),
            $this->getTexto('direccion'),
            $this->getTexto('telefono'),
            $this->getTexto('email'),
            $this->getTexto('tutor'),
            $this->getTexto('tutorTel'),
 $this->getTexto('estado'),
            $_FILES['foto']['name']
        );
        $this->redirect('estudiante/index');
    }

    //EDITAR Estudiante
    public function editarEstudiante()
    {
        $this->_estudiante->editarEstudiante(
            $this->getTexto('idEstudiante'),
            $this->getTexto('idGrupoUp'),
            $this->getTexto('idEscuelaUp'),
            $this->getTexto('pNombreUp'),
            $this->getTexto('sNombreUp'),
            $this->getTexto('pApellidoUp'),
            $this->getTexto('sApellidoUp'),
            $this->getTexto('edadUp'),
            $this->getTexto('nacimientoUp'),
            $this->getTexto('sexoUp'),
            $this->getTexto('direccionUp'),
            $this->getTexto('telefonoUp'),
            $this->getTexto('emailUp'),
            $this->getTexto('tutorUp'),
            $this->getTexto('tutorTelUp'),
            $this->getTexto('estadoUp'),
            $_FILES['fotoUp']['name']
        );
        $this->redirect('estudiante/index');
    }

    //BORRAR Estudiante
    public function borrarEstudiante()
    {
        $this->_estudiante->borrarEstudiante($this->getTexto('idEstudiante'));
        $this->redirect('estudiante/index');
    }
}

?>