<?php
class perfilController extends Controller
{
    private $_perf;

    function __construct()
    {
        parent::__construct();
        $this->_perf = $this->loadModel('perfil');
    }

    public function getEstudiantes()
    {

        $datos = $this->_perf->obtenerDatosEstudiantes(Sessiones::getClave('usuario'));
        $id = $datos[0]["id_docente"];
        $fila = $this->_perf->obtenerGrupos($id);
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
        // $fila =$this ->_perf->obtenerEstudiantes();
        // $datos = '<option value="0"></option>';
        $this->_view->grupos = $this->getEstudiantes();
        $this->_view->renderizar('perfil');
    }

    // Función para CARGAR la DataTable
    public function getEstudiante()
    {
        $fila= $this->_perf->obtenerEstudiantes($this->getTexto("idGrupo"));
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

}

?>