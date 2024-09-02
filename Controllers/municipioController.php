<?php
class municipioController extends Controller
{
    private $_muni;

    function __construct()
    {
        parent::__construct();
        $this->_muni = $this->loadModel('municipio');
    }

    public function index()
    {
        $fila = $this->_muni->obtenerDepartamento();
        $datos = '<option value="0"> Seleccione un Departamento</option>';
        for ($i = 0; $i < count($fila); $i++) {
            $datos .= '<option value="' . $fila[$i]['id_departamento'] . '">' . $fila[$i]['nombre_departamento'] . '</option>';
        }
        $this->_view->departamentos = $datos;
        $this->_view->tabla = $this->verMunicipio();
        $this->_view->renderizar('municipio');

    }

    /*Enviar DEPARTAMENTOS a Vista MUNICIPIOS*/

    public function verMunicipio()
    {
        $fila = $this->_muni->obtenerMunicipio();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
                <tr>
                    <td>' . $fila[$i]['id_municipio'] . '</td>
                    <td>' . $fila[$i]['nombre_departamento'] . '</td>
                    <td>' . $fila[$i]['nombre_municipio'] . '</td>
                    <td>
                    <button data-municipio=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarEscuela" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarEscuela"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
        <button data-id=' . $fila[$i]['id_municipio'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarEscuela"><i class="fa-solid fa-trash"></i> Borrar</button> 

                    </td>
                </tr>
                ';
        }
        return $tabla;

    }

    public function agregarMunicipio()
    {
        $this->_muni->agregarDep($this->getTexto('idDepartamento'), $this->getTexto('nombreMunicipio'));
        echo $this->verMunicipio();
    }

}



?>