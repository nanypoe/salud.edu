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
            $matricula = "";
            if ($datos["id_matricula"]!="") {
                $matricula .= '<span class="h4 d-block mb-1" id="grupoPersonal">No matriculado</span>';
            } else{
                $matricula .= '<span class="h3 d-block mb-1" id="grupoPersonal">' . $nombre["axo_grupo"] . ' ' . $nombre["nombre_grupo"] . '</span>';
            }
            $nombres .= '
            <img class="rounded-circle mt-2" src="../salud.edu/Views/plantilla/images/estudianteFotos/' . $nombre["imagen"] . '" id="fotoPersonal" style="width:200px; height:200px">
            <span class="h2 d-block mt-3 mb-2" id="nombrePersonal">' . $nombre["primer_nombre"] . ' ' . $nombre["primer_apellido"] . '</span>
            ' . $matricula . '           
            ';

        }
        return $nombres;
    }

    public function obtenerEstudiante($id)
    {
        $datos=$this->_personal->sesionEstudiante();
        $generales = "";
        foreach ($datos as $general) {
            $generales .= '
                <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nombres y Apellidos</div>
                    <div class="col-lg-9 col-md-8">' . $general["primer_nombre"] . ' ' . $general["segundo_nombre"] . ' ' . $general["primer_apellido"] . ' ' . $general["segundo_apellido"] . '</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Edad</div>
                    <div class="col-lg-9 col-md-8">' . $general["edad"] . ' años' . '</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8">Web Designer</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8">USA</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">k.anderson@example.com</div>
                </div>
            ';
        }
        return $generales;
    }
    
    //RENDERIZAR la vista PERSONAL
    public function index()
    {
        $this->_view->nombres = $this->sesionEstudiante();
        $this->_view->renderizar('personal');
    }





}