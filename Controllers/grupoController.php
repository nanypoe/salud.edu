<?php
class grupoController extends Controller
{
    private $_grupo;

    function __construct()
    {
        parent::__construct();
        $this->_grupo = $this->loadModel('grupo');
    }

    /*Función para RENDERIZAR la Vista REGISTRO Y LISTADO DE GRUPOS*/
    public function index()
    {
        /*Mandar DATOS de LECTIVOS a la Vista GRUPOS*/
        $filaAxo = $this->_grupo->obtenerLectivos();
        $lectivos = '<option value="0"> Seleccione un Año Lectivo</option>';
        for ($i = 0; $i < count($filaAxo); $i++) {
            $lectivos .= '<option value="' . $filaAxo[$i]['id_lectivo'] . '">' . $filaAxo[$i]['axo'] . '</option>';
        }
        $this->_view->lectivos = $lectivos;

        /*Mandar DATOS de DOCENTES a la Vista GRUPOS*/
        $fila = $this->_grupo->obtenerDocentes();
        $docentes = '<option value="0"> Seleccione un Docente</option>';
        for ($i = 0; $i < count($fila); $i++) {
            $docentes .= '<option value="' . $fila[$i]['id_docente'] . '">' . $fila[$i]['nombre'] . ' ' . $fila[$i]['apellido'] . '</option>';
        }
        $this->_view->docentes = $docentes;

        $this->_view->tabla = $this->verGrupos();
        $this->_view->renderizar('grupo');
    }

    //OBTENER Datos de la tabla GRUPOS en DataTable
    public function verGrupos()
    {
        $fila = $this->_grupo->obtenerGrupos();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
            <tr>
                <td>' . $fila[$i]['id_grupo'] . '</td>
                <td>' . $fila[$i]['axo'] . '</td>
                <td>' . $fila[$i]['nombre'].' '.$fila[$i]['apellido'].'</td>
                <td>' . $fila[$i]['axo_grupo'] . '</td>
                <td>' . $fila[$i]['nombre_grupo'] . '</td>
                <td>' . $fila[$i]['modalidad'] . '</td>
                <td>
                <button data-grupo=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarGrupo" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarGrupo"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>
                <button data-id=' . $fila[$i]['id_grupo'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarGrupo"><i class="fa-solid fa-trash"></i> Borrar</button>
                </td>
            </tr>
            ';
        }
        return $tabla;
    }

    //AGREGAR Grupo
    public function agregarGrupo()
    {
        $this->_grupo->agregarGrupo(
            $this->getTexto('lectivo_id'),
            $this->getTexto('docente_id'),
            $this->getTexto('axo_grupo'),
            $this->getTexto('nombre_grupo'),
            $this->getTexto('modalidad')
        );
        echo $this->verGrupos();
    }

    //EDITAR Grupo
    public function editarGrupo()
    {
        $this->_grupo->editarGrupo(
            $this->getTexto('idGrupo'),
            $this->getTexto('idAxo'),
            $this->getTexto('idDocenteUp'),
            $this->getTexto('gradoGrupo'),
            $this->getTexto('seccionGrado'),
            $this->getTexto('modalidadUp')
        );
        echo $this->verGrupos();
    }

    //BORRAR Grupo
    public function borrarGrupo()
    {
        $this->_grupo->borrarGrupo($this->getTexto('id_grupoDel'));
        echo $this->verGrupos();
    }
}