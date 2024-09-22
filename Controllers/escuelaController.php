<?php
class escuelaController extends Controller
{
    private $_escue;

    function __construct()
    {
        parent::__construct();
        $this->_escue = $this->loadModel('escuela');
    }

    /*Función para RENDERIZAR la Vista REGISTRO Y LISTADO DE MUNICIPIOS y DEPARTAMENTOS*/
    public function index()
    {
        /*Mandar DATOS de DEPARTAMENTOS a la Vista ESCUELAS*/
        $fila = $this->_escue->obtenerDepartamento();
        $datos = '<option value="0"> Seleccione un Departamento</option>';
        for ($i = 0; $i < count($fila); $i++) {
            $datos .= '<option value="' . $fila[$i]['id_departamento'] . '">' . $fila[$i]['nombre_departamento'] . '</option>';
        }
        $this->_view->departamento = $datos;
        $this->_view->lectivo = $this-> obtenerLectivo();
        $this->_view->tabla = $this->verEscuela();
        $this->_view->renderizar('escuela');
    }

    //Mandar DATOS de MUNICIPIOS a la Vista ESCUELAS
    public function obtenerMunicipio()
    {
        $fila = $this->_escue->obtenerMunicipio($this->getTexto('idDepartamento'));
        $datos = '<option value="0"> Seleccione un Municipio</option>';
        for ($i = 0; $i < count($fila); $i++) {
            $datos .= '<option value="' . $fila[$i]['id_municipio'] . '">' . $fila[$i]['nombre_municipio'] . '</option>';
        }
        echo $datos;
    }

    //Mandar DATOS de AÑO LECTIVO a la Vista ESCUELAS
    public function obtenerLectivo()
    {
        $fila = $this->_escue->obtenerLectivo();
        $datos = '<option value="0"> Seleccione el Año Lectivo</option>';
        for ($i = 0; $i < count($fila); $i++) {
            $datos .= '<option value="' . $fila[$i]['id_lectivo'] . '">' . $fila[$i]['axo'] . '</option>';
        }
        return $datos;
    }

    //OBTENER Datos de la tabla ESCUELAS en DataTable
    public function verEscuela()
    {
        $fila = $this->_escue->obtenerEscuela();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
            <tr>
                <td>' . $fila[$i]['axo'] . '</td>
                <td>' . $fila[$i]['nombre_municipio'] . '</td>
                <td>' . $fila[$i]['id_escuela'] . '</td>
                <td>' . $fila[$i]['nombre'] . '</td>
                <td>' . $fila[$i]['direccion'] . '</td>
                <td>' . $fila[$i]['telefono'] . '</td>
                <td>' . $fila[$i]['longitud'] . '</td>
                <td>' . $fila[$i]['latitud'] . '</td>
                <td>
                <button data-escuela=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarEscuela" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarEscuela"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>
                <button data-id=' . $fila[$i]['id_escuela'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarEscuela"><i class="fa-solid fa-trash"></i> Borrar</button>
                </td>
            </tr>
            ';
        }
        return $tabla;
    }

    //AGREGAR Escuela
    public function agregarEscuela()
    {
        $this->_escue->agregarEscuela(
            $this->getTexto('idAñoLectivo'),
            $this->getTexto('municEscuela'),
            $this->getTexto('nombreEscuela'),
            $this->getTexto('direccionEscuela'),
            $this->getTexto('telefonoEscuela'),
            $this->getTexto('longitudEscuela'),
            $this->getTexto('latitudEscuela')
        );
        echo $this->verEscuela();
    }

    //EDITAR Escuela
    public function editarEscuela()
    {
        $this->_escue->editarEscuela(
            $this->getTexto('idEscuela'),
            $this->getTexto('municEscuelaUp'),
            $this->getTexto('idAñoLectivoUp'),
            $this->getTexto('nombreEscuelaUp'),
            $this->getTexto('direccionEscuelaUp'),
            $this->getTexto('teleEscuelaUp'),
            $this->getTexto('longEscuelaUp'),
            $this->getTexto('latEscuelaUp')
        );
        echo $this->verEscuela();
    }

    //BORRAR Escuela
    public function borrarEscuela()
    {
        $this->_escue->borrarEscuela($this->getTexto('idEscuelaDel'));
        echo $this->verEscuela();
    }
}



?>