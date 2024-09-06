<?php
class departamentoController extends Controller
{
    private $_depart;

    function __construct()
    {
        parent::__construct();
        $this->_depart = $this->loadModel('departamento');
    }


    /*Función para RENDERIZAR la Vista REGISTRO Y LISTADO DE DEPARTAMENTOS*/
    public function index()
    {
        $this->_view->tabla = $this->verDepartamento();
        $this->_view->renderizar('departamento');
    }

    /*Función para VISUALIZAR los DEPARTAMENTOS en la DataTable*/
    public function verDepartamento()
    {
        $fila = $this->_depart->obtenerDepartamento();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
                <tr>
                    <td>' . $fila[$i]['id_departamento'] . '</td>
                    <td>' . $fila[$i]['nombre_departamento'] . '</td>
                    <td>
                    <button data-departamentos=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarDepartamento" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarDepartamento"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
                    <button data-id=' . $fila[$i]['id_departamento'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarDepartamento"><i class="fa-solid fa-trash"></i> Borrar</button>
                    </td>
                </tr>
                ';
        }
        return $tabla;
    }

    /*Función para AGREGAR nuevos DEPARTAMENTOS*/
    public function agregarDepartamento()
    {
        $nombreDpto = $this->getTexto('nombreDpto');
        $this->_depart->agregarDepartamento($nombreDpto);
        echo $this->verDepartamento();
    }

    /*Función para EDITAR los DEPARTAMENTOS previamente agredos*/
    public function editarDepartamento()
    {
        $this->_depart->editarDepartamento($this->getTexto('nombreDptoUp'), $this->getTexto('idDpto'));
        echo $this->verDepartamento();
    }

    // Función para BORRAR los DEPARTAMENTOS
    public function borrarDepartamento()
    {
        $this->_depart->borrarDepartamento($this->getTexto('idDptoDel'));
        echo $this->verDepartamento();
    }
}
?>