<?php
class estudianteController extends Controller
{
    private $_estu;

    function __construct()
    {
        parent::__construct();
        $this->_estu = $this->loadModel('estudiante');
    }

    public function verAlumno()
    {
        $fila = $this->_estu->obtenerAlumno();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
                <tr>
                    <td>' . $fila[$i]['id_maestros'] . '</td>
                    <td>' . $fila[$i]['nombre'] . ' ' . $fila[$i]['apellido'] . '</td> 
                    <td>' . $fila[$i]['fecha_nacimiento'] . '</td>
                    <td>' . $fila[$i]['genero'] . '</td>
                    <td>' . $fila[$i]['direccion'] . '</td>
                    <td>' . $fila[$i]['telefono'] . '</td>
                    <td>' . $fila[$i]['email'] . '</td>
                    <td>' . $fila[$i]['nombre_tutor'] . '</td>
                    <td>' . $fila[$i]['telefono_tutor'] . '</td>
                    <td>' . $fila[$i]['direccion'] . '</td>
                    <td>' . $fila[$i]['nombre_escuela'] . '</td>

                    <td>
                    <button data-Alumno=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalActualizarMaestro" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarAlumno"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
        <button data-id=' . $fila[$i]['id_maestros'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarAlumno"><i class="fa-solid fa-trash"></i> Borrar</button>
                    </td>
                </tr>
                ';
        }
        return $tabla;
    }

    public function index()
    {
        $this->_view->tabla = $this->verAlumno();
        $this->_view->renderizar('estudiante');
    }

    public function agregar()
    {
        /* mandando a la vista los datos de las escuelas */
        $fila = $this->_estu->obtenerEscuela();
        $datos = '<option value="0"> Seleccione una escuela</option>';
        for ($i = 0; $i < count($fila); $i++) {
            $datos .= '<option value="' . $fila[$i]['id_escuela'] . '">' . $fila[$i]['nombre'] . '</option>';
        }

        $this->_view->escuelas = $datos;
        $this->_view->renderizar('agregar');

    }

    public function agregarAlumno()
    {
        function upload_image()
        {
            if (isset($_FILES["imagenEstudiante"])) {
                $extension = explode('.', $_FILES['imagenEstudiante']['name']);
                $new_name = rand() . '.' . $extension[1];
                $destination = './Views/plantilla/images/' . $new_name;
                move_uploaded_file($_FILES['imagenEstudiante']['tmp_name'], $destination);
                return $new_name;
            }
        }
        $imagen = '';
        if ($_FILES["imagenEstudiante"]["name"] != '') {
            $imagen = upload_image();

            $this->_estu->insertarEstudiante(
                $this->getTexto('id'),
                $this->getTexto('pNombre'),
                $this->getTexto('sNombre'),
                $this->getTexto('pApellido'),
                $this->getTexto('sApellido'),
                $this->getTexto('edad'),
                $this->getTexto('fecha'),
                $this->getTexto('sexo'),
                $this->getTexto('telefonoAlumno'),
                $this->getTexto('correo'),
                $this->getTexto('direccion'),
                $this->getTexto('nombreTutor'),
                $this->getTexto('telefonoTutor'),
                $imagen
            );
            echo $this->verAlumno();
        } else {
            $this->_estu->insertarEstSinImagen(
                $this->getTexto('id'),
                $this->getTexto('pNombre'),
                $this->getTexto('sNombre'),
                $this->getTexto('pApellido'),
                $this->getTexto('sApellido'),
                $this->getTexto('edad'),
                $this->getTexto('fecha'),
                $this->getTexto('sexo'),
                $this->getTexto('telefonoAlumno'),
                $this->getTexto('correo'),
                $this->getTexto('direccion'),
                $this->getTexto('nombreTutor'),
                $this->getTexto('telefonoTutor')
            );


            echo $this->verAlumno();
        }


    }

    public function editarAlumno()
    {
        $this->_estu->editarAlum($this->getTexto('id'), $this->getTexto('nombre'), $this->getTexto('sexo'), $this->getTexto('telefono'), $this->getTexto('ciudad'));

        echo $this->verAlumno();

    }

    public function borrarAlumno()
    {
        $this->_estu->borrarAlum($this->getTexto('id'));
        echo $this->verAlumno();
    }





}



?>