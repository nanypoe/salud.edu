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
            if ($nombre["id_matricula"] != "") {
                $matricula .= '<span class="h4 d-block mb-1" id="grupoPersonal">No matriculado</span>';
            } else {
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

    public function obtenerEstudiante()
    {
        $datos = $this->_personal->obtenerDatosEstudiante(Sessiones::getClave('usuario'));
        $generales = "";
        foreach ($datos as $general) {
            $generales .= '
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Nombres y Apellidos</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $general["primer_nombre"] . ' ' . $general["segundo_nombre"] . ' ' . $general["primer_apellido"] . ' ' . $general["segundo_apellido"] . '</div>
                </div>
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Edad</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $general["edad"] . ' años' . '</div>
                </div>
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Fecha de Nacimiento</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $general["fecha_nacimiento"] . '</div>
                </div>
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Sexo</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $general["sexo"] . '</div>
                </div>
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Dirección</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $general["direccion"] . '</div>
                </div>
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Teléfono</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $general["telefono"] . '</div>
                </div>
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Correo electrónico</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $general["email"] . '</div>
                </div>
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Nombre del Tutor</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $general["nombre_tutor"] . '</div>
                </div>
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Teléfono del Tutor</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $general["telefono_tutor"] . '</div>
                </div>
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Estado del estudiante</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $general["estado"] . '</div>
                </div>
            ';
        }
        return $generales;
    }

    public function obtenerDatosSalud()
    {
        $datos = $this->_personal->obtenerEstudiante(Sessiones::getClave('usuario'));
        $datosSalud='';
        foreach ($datos as $salud) {
            $datosSalud .= '
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Peso</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $salud["peso"] . '</div>
                </div>
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Altura</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $salud["altura"] . '</div>
                </div>
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">IMC</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $salud["imc"] . '</div>
                </div>
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Categoría de peso</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $salud["categoria_peso"] . '</div>
                </div>
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Somatotipo</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $salud["somatotipo"] . '</div>
                </div>
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Condición médica</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $salud["condicion_medica"] . '</div>
                </div>
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Descripción de la condición</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $salud["descripcion"] . '</div>
                </div>
                <div class="row mt-1 mb-2">
                    <div class="col-4 fs-5">Medicación</div>
                    <div class="col ml-4 fs-5 fw-bolder border-bottom border-info text-center">' . $salud["medicacion"] . '</div>
                </div>
            ';
        }
        return $datosSalud;

    }

    //RENDERIZAR la vista PERSONAL
    public function index()
    {
        $this->_view ->desalud=$this->obtenerDatosSalud();
        $this->_view->generales = $this->obtenerEstudiante();
        $this->_view->nombres = $this->sesionEstudiante();
        $this->_view->renderizar('personal');
    }





}