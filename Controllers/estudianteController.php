<?php
class estudianteController extends Controller
{
    private $_estudiante;

    function __construct()
    {
        parent::__construct();
        $this->_estudiante = $this->loadModel('estudiante');
    }

    /**
     * Función para renderizar la vista de registro y listado de estudiantes
     */
    public function index()
    {
        /* Mandar datos de escuelas a la vista estudiantes */
        $fila = $this->_estudiante->obtenerEscuelas();
        $escuelas = '<option value="0"> Seleccione una Escuela</option>';
        foreach ($fila as $escuela) {
            $escuelas .= '<option value="' . $escuela['id_escuela'] . '">' . $escuela['nombre'] . '</option>';
        }
        $this->_view->escuelas = $escuelas;

        $this->_view->tabla = $this->verEstudiantes();
        $this->_view->renderizar('estudiante');
    }

    /**
     * Función para obtener la tabla de estudiantes
     */
    public function verEstudiantes()
    {
        $fila = $this->_estudiante->obtenerDatosEstudiantes();
        $tabla = '';
        foreach ($fila as $estudiante) {
            $datos = json_encode($estudiante);
            $tabla .= '
            <tr>
                <td>' . $estudiante['nombre'] . '</td>
                <td>' . $estudiante['id_estudiante'] . '</td>
                <td>' . $estudiante['primer_nombre'] . ' ' . $estudiante['segundo_nombre'] . ' ' . $estudiante['primer_apellido'] . ' ' . $estudiante['segundo_apellido'] . '</td>
                <td>' . $estudiante['edad'] . '</td>
                <td>' . $estudiante['fecha_nacimiento'] . '</td>
                <td>' . $estudiante['sexo'] . '</td>
                <td>' . $estudiante['direccion'] . '</td>
                <td>' . $estudiante['telefono'] . '</td>
                <td>' . $estudiante['email'] . '</td>
                <td>' . $estudiante['nombre_tutor'] . '</td>
                <td>' . $estudiante['telefono_tutor'] . '</td>
                <td>' . $estudiante['estado'] . '</td>
                <td>
                <button data-estudiante=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarEstudiante" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarEstudiante"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>
                <button data-id=' . $estudiante['id_estudiante'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarEstudiante"><i class="fa-solid fa-trash"></i> Borrar</button>
                </td>
            </tr>
            ';
        }
        return $tabla;
    }

    /**
     * Función para agregar un estudiante
     */
    public function agregarEstudiante()
    {
        function upload_image()
        {
            if (isset($_FILES["foto"])) {
                $extension = explode('.', $_FILES["foto"]["name"]);
                $new_name = rand() . '.' . $extension[1];
                $destination = './Views/plantilla/images/estudianteFotos/' . $new_name;
                move_uploaded_file($_FILES["foto"]["tmp_name"], $destination);
                return $new_name;
            }
        }
        $image = '';
        if ($_FILES["foto"]["name"] != '') {
            $image = upload_image();
            $this->_estudiante->agregarEstudianteFoto(
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
                $image
            );
            echo $this->verEstudiantes();
        } else
        {
            $this->_estudiante->agregarEstudianteNoFoto(
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
                $this->getTexto('estado')
            );
            echo  $this->verEstudiantes();
        }
    }

    /**
     * Función para editar un estudiante
     */
    public function editarEstudiante()
    {
        $this->_estudiante->editarEstudiante(
            $this->getTexto('id'),
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
            $this->getTexto('estado')
        );
        echo $this->verEstudiantes();
    }

    /**
     * Función para eliminar un estudiante
     */
    public function eliminarEstudiante()
    {
        $this->_estudiante->eliminarEstudiante($this->getTexto('id'));
        echo $this->verEstudiantes();
    }
}
