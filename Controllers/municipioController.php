<?php
class municipioController extends Controller
{
    private $_munic;

    function __construct()
    {
        parent::__construct();
        $this->_munic = $this->loadModel('municipio');
    }


    /*Función para RENDERIZAR la Vista REGISTRO Y LISTADO DE MUNICIPIOS*/
    public function index()
    {
        $this->_view->tabla = $this->verMunicipio();
        $this->_view->renderizar('municipio');
    }

    /*Función para VISUALIZAR los MUNICIPIOS en la DataTable*/
    public function verMunicipio()
    {
        $fila = $this->_munic->obtenerDatosMunicipio();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
                <tr>
                <td>' . $fila[$i]['nombre_departamento'] . '</td>
                <td>' . $fila[$i]['id_municipio'] . '</td>
                <td>' . $fila[$i]['nombre_municipio'] . '</td>

                    <td>
                    <button data-departamentos=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarDepartamento" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarDepartamento"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
                    <button data-id=' . $fila[$i]['id_municipio'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarDepartamento"><i class="fa-solid fa-trash"></i> Borrar</button>
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
        $this->_munic->agregarDepartamento($nombreDpto);
        echo $this->verMunicipio();
    }

    /*Función para EDITAR los DEPARTAMENTOS previamente agredos*/
    public function editarDepartamento()
    {
        $this->_munic->editarDepartamento($this->getTexto('nombreDptoUp'), $this->getTexto('idDpto'));
        echo $this->verMunicipio();
    }

    // Función para BORRAR los DEPARTAMENTOS
    public function borrarDepartamento()
    {
        $this->_munic->borrarDepartamento($this->getTexto('idDptoDel'));
        echo $this->verMunicipio();
    }
}
?>