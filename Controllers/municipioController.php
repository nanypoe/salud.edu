<?php
class municipioController extends Controller
{
    private $_munic;

    function __construct()
    {
        parent::__construct();
        $this->_munic = $this->loadModel('municipio');
    }


    /*Función para RENDERIZAR la Vista REGISTRO Y LISTADO DE MUNICIPIOS y DEPARTAMENTOS*/
    public function index()
    {
        /*Mandar a la vista DATOS de DEPARTAMENTOS*/
        $fila = $this->_munic->obtenerDepartamento();
        $datos = '<option value="0"> Seleccione un Departamento</option>';
        for ($i = 0; $i < count($fila); $i++) {
            $datos .= '<option value="' . $fila[$i]['id_departamento'] . '">' . $fila[$i]['nombre_departamento'] . '</option>';
        }
        $this->_view->departamento = $datos;
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
                    <button data-municipio=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarMunicipio" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarMunicipio"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
                    <button data-id=' . $fila[$i]['id_municipio'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarMunicipio"><i class="fa-solid fa-trash"></i> Borrar</button>
                    </td>
                </tr>
                ';
        }
        return $tabla;
    }

    /*Función para AGREGAR nuevos MUNICIPIOS*/
    public function agregarMunicipio()
    {
        $this->_munic->agregarMunicipio($this->getTexto('dptoId'), $this->getTexto('municipio'));
        echo $this->verMunicipio();
    }

    /*Función para EDITAR los DEPARTAMENTOS previamente agredos*/
    public function editarMunicipio()
    {
        $this->_munic->editarMunicipio($this->getTexto('muniIdUp'), $this->getTexto('municipioUp'));
        echo $this->verMunicipio();
    }

    // Función para BORRAR los MUNICIPIOS
    public function borrarMunicipio()
    {
        $this->_munic->borrarMunicipio($this->getTexto('idMunicipioDel'));
        echo $this->verMunicipio();
    }
}
?>