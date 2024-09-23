<?php
class materiaController extends Controller
{
    private $_materia;

    function __construct()
    {
        parent::__construct();
        $this->_materia = $this->loadModel('materia');
    }

    /*Función para RENDERIZAR la Vista REGISTRO Y LISTADO DE MATERIAS*/
    public function index()
    {
        /*Mandar DATOS de GRUPOS a la Vista MATERIAS*/
        $filaGrupos = $this->_materia->obtenerGrupos();
        $grupos = '<option value="0"> Seleccione un Grupo</option>';
        for ($i = 0; $i < count($filaGrupos); $i++) {
            $grupos .= '<option value="' . $filaGrupos[$i]['id_grupo'] . '">' . $filaGrupos[$i]['nombre_grupo'] . '</option>';
        }
        $this->_view->grupos = $grupos;

        $this->_view->tabla = $this->verMaterias();
        $this->_view->renderizar('materia');
    }

    //OBTENER Datos de la tabla MATERIAS en DataTable
    public function verMaterias()
    {
        $fila = $this->_materia->obtenerMaterias();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
            <tr>
                <td>' . $fila[$i]['id_materia'] . '</td>
                <td>' . $fila[$i]['nombre_grupo'] . '</td>
                <td>' . $fila[$i]['nombre_materia'] . '</td>
                <td>
                <button data-materia=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarMateria" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarMateria"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>
                <button data-id=' . $fila[$i]['id_materia'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarMateria"><i class="fa-solid fa-trash"></i> Borrar</button>
                </td>
            </tr>
            ';
        }
        return $tabla;
    }

    //AGREGAR Materia
    public function agregarMateria()
    {
        $this->_materia->agregarMateria(
            $this->getTexto('id_grupo'),
            $this->getTexto('nombre_materia')
        );
        echo $this->verMaterias();
    }

    //EDITAR Materia
    public function editarMateria()
    {
        $this->_materia->editarMateria(
            $this->getTexto('id_materia'),
            $this->getTexto('id_grupo'),
            $this->getTexto('nombre_materia')
        );
        echo $this->verMaterias();
    }

    //BORRAR Materia
    public function borrarMateria()
    {
        $this->_materia->borrarMateria($this->getTexto('id_materiaDel'));
        echo $this->verMaterias();
    }
}