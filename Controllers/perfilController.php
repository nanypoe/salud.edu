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

        $datos = $this->_perfil->obtenerDatosEstudiantes(Sessiones::getClave('usuario'));
        $id = $datos[0]["id_docente"];
        $fila = $this->_perfil->obtenerGrupos($id);
        $grupos = '<option>Seleccione un grupo</option>';
        foreach ($fila as $grupo) {
            $grupos .= '<option value="' . $grupo['id_grupo'] . '">' . $grupo['axo_grupo'] . ' ' . $grupo['nombre_grupo'] . '</option>';
        }
        return $grupos;
    }

    /*Función para RENDERIZAR la Vista PERFIL DEL ESTUDIANTE*/
    public function index()
    {
        // //Mandar a la vista Datos de Estudiantes
        // $fila =$this ->_perfil->obtenerEstudiantes();
        // $datos = '<option value="0"></option>';
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
                <td>' . $fila[$i]['primer_nombre'] . ' ' . $fila[$i]['segundo_nombre'] . '</td>
                    <td>
                    <button data-municipio=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarMunicipio" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarMunicipio"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
                    <button data-id=' . $fila[$i]['id_estudiante'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarMunicipio"><i class="fa-solid fa-trash"></i> Borrar</button>
                    </td>
                </tr>
                ';
        }
        var_dump($tabla);
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