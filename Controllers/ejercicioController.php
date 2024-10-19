<?php
class ejercicioController extends Controller
{
    private $_ejerc;

    function __construct()
    {
        parent::__construct();
        $this->_ejerc = $this->loadModel('ejercicio');
    }


    /*Función para RENDERIZAR la Vista REGISTRO Y LISTADO DE MUNICIPIOS y DEPARTAMENTOS*/
    public function index()
    {
        /*Mandar a la vista DATOS de DEPARTAMENTOS*/
        // $fila = $this->_ejerc->obtenerDepartamento();
        // $datos = '<option value="0"> Seleccione un Departamento</option>';
        // for ($i = 0; $i < count($fila); $i++) {
        //     $datos .= '<option value="' . $fila[$i]['id_departamento'] . '">' . $fila[$i]['nombre_departamento'] . '</option>';
        // }
        // $this->_view->departamento = $datos;
        $this->_view->tabla = $this->verEjercicio();
        $this->_view->renderizar('ejercicio');
    }

    /*Función para VISUALIZAR los MUNICIPIOS en la DataTable*/
    public function verEjercicio()
    {
        $fila = $this->_ejerc->obtenerDatosEjercicio();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
                <tr>
                <td>' . $fila[$i]['id_ejercicio'] . '</td>
                <td>' . $fila[$i]['nombre_ejercicio'] . '</td>
                <td>' . $fila[$i]['descripcion'] . '</td>
                <td>' . $fila[$i]['categoria'] . '</td>
                <td>' . $fila[$i]['duracion_estimada'] . '</td>
                

                    <td>
                    <button data-ejercicio=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarEjercicio" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarEjercicio"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
                    <button data-id=' . $fila[$i]['id_ejercicio'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarEjercicio"><i class="fa-solid fa-trash"></i> Borrar</button>
                    </td>
                </tr>
                ';
        }
        return $tabla;
    }

    /*Función para AGREGAR nuevos Ejercicios*/
    public function agregarEjercicio()
    {
        $this->_ejerc->agregarEjercicio(
            $this->getTexto('ejercicio'), 
            $this->getTexto('descripcion'),
            $this->getTexto('categoria'),
            $this->getTexto('duracion')
        );
        echo $this->verEjercicio();
    }

    /*Función para EDITAR los Ejercicios previamente agredos*/
    public function editarEjercicio()
    {
        $this->_ejerc->editarEjercicio(
            $this->getTexto('idEjercicio'),
            $this->getTexto('ejercicio'), 
            $this->getTexto('descripcion'),
            $this->getTexto('categoria'),
            $this->getTexto('duracion')
        );
        echo $this->verEjercicio();
    }

    // Función para BORRAR los EJERCICIOS//
    public function borrarEjercicio()
    {
        $this->_ejerc->borrarEjercicio($this->getTexto('idEjercicioDel'));
        echo $this->verEjercicio();
    }
}
?>