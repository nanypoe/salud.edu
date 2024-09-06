<?php
class materiaController extends Controller
{
    private $_mater;

    function __construct()
    {
        parent::__construct();
        $this->_mater = $this->loadModel('materia');
    }


    /*Función para RENDERIZAR la Vista REGISTRO Y LISTADO DE MATERIAS*/
    public function index()
    {
        $this->_view->tabla = $this->verMateria();
        $this->_view->renderizar('materia');
    }

    /*Función para VISUALIZAR los MATERIAS en la DataTable*/
    public function verMateria()
    {
        $fila = $this->_mater->obtenerDatosMateria();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
                <tr>
                    <td>' . $fila[$i]['id_materia'] . '</td>
                    <td>' . $fila[$i]['nombre_grupo'] . '</td>
                    <td>' . $fila[$i]['maestros.nombre'] .' '. $fila[$i]['maestros.apellido'] .'</td>
                    <td>' . $fila[$i]['nombre_materia'] .'</td>
+
                    <td>
                    <button data-materias=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarMateria" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarMateria"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
                    <button data-id=' . $fila[$i]['id_materia'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarDepartamento"><i class="fa-solid fa-trash"></i> Borrar</button>
                    </td>
                </tr>
                ';
        }
        return $tabla;
    }

    /*Función para AGREGAR nuevos MATERIAS*/
    public function agregarMateria()
    {
        $this -> _mater -> agregarMateria($this-getTexto('idGrupo'), $this-getTexto('idMaestro'), $this-getTexto('nombreMateria'));
        echo $this->verMateria();
    }

    /*Función para EDITAR los MATERIAS previamente agredos*/
    public function editarDepartamento()
    {
        $this->_mater->editarDepartamento($this->getTexto('nombreDptoUp'), $this->getTexto('idDpto'));
        echo $this->verMateria();
    }

    // Función para BORRAR los MATERIAS
    public function borrarDepartamento()
    {
        $this->_mater->borrarDepartamento($this->getTexto('idDptoDel'));
        echo $this->verMateria();
    }
}
?>