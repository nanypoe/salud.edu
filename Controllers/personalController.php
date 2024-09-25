<?php
class personalController extends Controller
{
    private $_personal;
    function __construct()
    {
        parent::__construct();
        $this->_personal = $this->loadModel('personal');
    }

    //OBTENER Datos del Estudiante según la Sesión
    public function sesionEstudiante()
    {
        $datos = $this->_personal->obtenerDatosEstudiante(Sessiones::getClave('usuario'));

        $nombres = '';
        foreach ($datos as $nombre) {
            $nombres .= '<p class="h2" id="personalNombre">' . $nombre["primer_nombre"] . ' ' . $nombre["primer_apellido"] . '</p>';
        }
        return $nombres;
    }

    //RENDERIZAR la vista PERSONAL
    public function index()
    {
        $this->_view->nombres = $this->sesionEstudiante();
        $this->_view->renderizar('personal');
    }





}