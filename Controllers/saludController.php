<?php
class saludController extends Controller
{
    private $_sal;

    function __construct()
    {
        parent::__construct();
        $this->_sal = $this->loadModel('salud');
    }

    public function index()
    {
        $this->_view->tabla = $this->verDatosSalud();
        $this->_view->renderizar('salud');
    }

    public function verDatosSalud()
    {
        $fila = $this->_sal->obtenerDatosSalud();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
                <tr>
                    <td>' . $fila[$i]['id_salud'] . '</td>
                    <td>' . $fila[$i]['primer_nombre'] . ' ' . $fila[$i]['segundo_nombre'] . ' ' . $fila[$i]['primer_apellido'] . ' ' . $fila[$i]['segundo_apellido'] . '</td> 
                    <td>' . $fila[$i]['peso'] . '</td>
                    <td>' . $fila[$i]['altura'] . '</td>
                    <td>' . $fila[$i]['imc'] . '</td>
                    <td>' . $fila[$i]['categoria_peso'] . '</td>
                    <td>' . $fila[$i]['somatotipo'] . '</td>
                    <td>' . $fila[$i]['condicion_medica'] . '</td>
                    <td>' . $fila[$i]['descripcion'] . '</td>
                    <td>' . $fila[$i]['medicacion'] . '</td>

                    <td>
                    <button data-salud=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalActualizarDatosSalud" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarDatosSalud"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
                    
                    <button data-id=' . $fila[$i]['id_salud'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarDatosSalud"><i class="fa-solid fa-trash"></i> Borrar</button> 
                    </td>
                </tr>
                ';
        }
        return $tabla;

    }

    public function agregar()
    {
        /*Función para enviar a la Vista los datos del Estudiante*/
        $fila = $this->_sal->obtenerEstudiante();
        $datos = '<option value="0"> Seleccione un Alumno</option>';
        for ($i = 0; $i < count($fila); $i++) {
            $datos .= '<option value="' . $fila[$i]['id_estudiante'] . '">' . $fila[$i]['primer_nombre'] . ' ' . $fila[$i]['segundo_nombre'] . ' ' . $fila[$i]['primer_apellido'] . ' ' . $fila[$i]['segundo_apellido'] . '</option>';
        }
        $this->_view->estudiantes = $datos;
        $this->_view->renderizar('agregar');
    }

    public function agregarDatosSalud()
    {
        $this->_sal->agregarDatosSalud($this->getTexto('idEstudiante'),
            $this->getTexto('pesoEstudiante'),
            $this->getTexto('alturaEstudiante'),
            $this->getTexto('imc'),
            $this->getTexto('categoriaPeso'),
            $this->getTexto('condicionMedica'),
            $this->getTexto('descripcionMedica'),
            $this->getTexto('medicacion'),
            $this->getTexto('somatotipo')
        );

        echo $this->verDatosSalud();
    }

    /*
        public function editarAlumno()
        {
            $this->_maes->editarAlum($this->getTexto('id'), $this->getTexto('nombre'), $this->getTexto('sexo'), $this->getTexto('telefono'), $this->getTexto('ciudad'));

            echo $this->verAlumnos();

        }

        public function borrarAlumno()
        {
            $this->_maes->borrarAlum($this->getTexto('id'));
            echo $this->verAlumnos();
        }
    */
}
?>