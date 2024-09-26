<?php
class perfilController extends Controller
{
    private $_perfil;

    function __construct()
    {
        parent::__construct();
        $this->_perfil = $this->loadModel('perfil');
    }

    public function getEstudiantes()
    {
        

        $datos = $this->_perfil->obtenerDatosDocente(Sessiones::getClave('usuario'));
        $id = $datos[0]["id_docente"];
        $fila = $this->_perfil->obtenerGrupos($id);
        $grupos = '<option>Seleccione un grupo de estudiantado</option>';
        foreach ($fila as $grupo) {
            $grupos .= '<option value="' . $grupo['id_grupo'] . '">' . $grupo['axo_grupo']. ' ' . $grupo['nombre_grupo'] . '</option>';
        }
        return $grupos;
    }

    /*Función para RENDERIZAR la Vista PERFIL DEL ESTUDIANTE*/
    public function index()
    {

        $this->_view->grupos = $this->getEstudiantes();
        $this->_view->renderizar('perfil');
    }

    // Función para CARGAR la DataTable
    public function getEstudiante()
    {
        $fila= $this->_perfil->obtenerEstudiantes($this->getTexto("idGrupo"));
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
                <tr>
                <td>' . $fila[$i]['id_estudiante'] . '</td>
                <td>' . $fila[$i]['primer_nombre'] . ' ' . $fila[$i]['segundo_nombre'] .' '. $fila[$i]['primer_apellido'] .' '.$fila[$i]['segundo_apellido'] . '</td>
                    <td>
                    <button data-perfil=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalPerfilEstudiante" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarPerfil"><i class="fa-solid fa-person-circle-plus"></i>Perfil Estudiantil</button>
                </tr>
                ';
        }
        echo $tabla;
    }

    //AGREGAR Datos de PERFIL
    public function agregarPerfil(){
        $this->_perfil ->agregarPerfil(
            $this->getTexto('idEstudiante'),
            $this->getTexto('peso'),
            $this->getTexto('altura'),
            $this->getTexto('imc'),
            $this->getTexto('categoriaPeso'),
            $this->getTexto('somatotipo'),
            $this->getTexto('condicion'),
            $this->getTexto('descripcion'),
            $this->getTexto('medicacion'),
            $this->getTexto('idGrupo')
        );
        
        echo $this->getEstudiante();
        
    }
}