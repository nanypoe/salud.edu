<?php
class metricaController extends Controller
{
    private $_metrica;
    function __construct()
    {
        parent::__construct();
        $this->_metrica = $this->loadModel('metrica');
    }

    //OBTENER Datos del Estudiante según la Sesión
    public function obtenerDatos()
    {
        $datos = $this->_metrica->obtenerDatosEstudiante(Sessiones::getClave('usuario'));
        $nombres = '';
        foreach ($datos as $nombre) {
            $matricula = "";
            if ($nombre["id_matricula"] != 0) {
                
                $matricula .= '<span class="h3 d-block mb-1" id="grupoPersonal">' . $nombre["axo_grupo"] . ' ' . $nombre["nombre_grupo"] . '</span>';
            } else {
                $matricula .= '<span class="h4 d-block mb-1" id="grupoPersonal">No matriculado</span>';
            }
            $nombres .= '
            <img class="rounded-circle mt-2" src="../salud.edu/Views/plantilla/images/estudianteFotos/' . $nombre["imagen"] . '" id="fotoPersonal" style="width:200px; height:200px">
            <span class="h2 d-block mt-3 mb-2" id="nombrePersonal">' . $nombre["primer_nombre"] . ' ' . $nombre["primer_apellido"] . '</span>
            ' . $matricula . '           
            ';

        }
        return $nombres;
    }

    public function graficoVelocidad()
    {
        $datos = $this->_metrica->obtenerDatosEstudiante(Sessiones::getClave('usuario'));
        $id = $datos[0]["id_estudiante"];
        $fila = $this->_metrica->obtenerDatos($id);



        
        
        
       
        return $fila;
    }

    public function graficoIMC()
    {
        $datos = $this->_metrica->obtenerDatosEstudiante(Sessiones::getClave('usuario'));
        $id = $datos[0]["id_estudiante"];
        $fila = $this->_metrica->obtenerIMC($id);



        
        
       
        return $fila;
    }


    public function graficoSalto()
    {
        $datos = $this->_metrica->obtenerDatosEstudiante(Sessiones::getClave('usuario'));
        $id = $datos[0]["id_estudiante"];
        $fila = $this->_metrica->obtenerSalto($id);



        
        
       
        return $fila;
    }

    public function graficoLanzamiento()
    {
        $datos = $this->_metrica->obtenerDatosEstudiante(Sessiones::getClave('usuario'));
        $id = $datos[0]["id_estudiante"];
        $fila = $this->_metrica->obtenerLanzamiento($id);



       
        
       
        return $fila;
    }

    public function graficoFuerza()
    {
        $datos = $this->_metrica->obtenerDatosEstudiante(Sessiones::getClave('usuario'));
        $id = $datos[0]["id_estudiante"];
        $fila = $this->_metrica->obtenerFuerza($id);



        
        
       
        return $fila;
    }

    public function graficoResistencia()
    {
        $datos = $this->_metrica->obtenerDatosEstudiante(Sessiones::getClave('usuario'));
        $id = $datos[0]["id_estudiante"];
        $fila = $this->_metrica->obtenerResistencia($id);



        
        
       
        return $fila;
    }




    

    //RENDERIZAR la vista metrica
    public function index()
    {

        $this->_view->nombres = $this->obtenerDatos();
        $this->_view->resistencia = $this->graficoResistencia();
        $this->_view->fuerza = $this->graficoFuerza();
        $this->_view->lanzamiento = $this->graficoLanzamiento();
        $this->_view->velocidad = $this->graficoVelocidad();
        $this->_view->imc = $this->graficoIMC();
        $this->_view->salto = $this->graficoSalto();
        $this->_view->renderizar('metrica');
    }





}