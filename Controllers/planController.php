<?php
class planController extends Controller
{
    private $_plan;

    function __construct()
    {
        parent::__construct();
        $this->_plan = $this->loadModel('plan');
    }

    /*Función para RENDERIZAR la Vista REGISTRO Y LISTADO DE PLANES DE EJERCICIOS*/
    public function index()
    {
        //Mandar DATOS de ESCUELAS a la Vista DOCENTES
        //$fila = $this->_plan->obtenerDatosEjerci();
        //$datos = '<option value="0"> Seleccione un ejercicio</option>';
        //for ($i = 0; $i < count($fila); $i++) {
        //    $datos .= '<option value="' . $fila[$i]['id_ejercicio'] . '">' . $fila[$i]['nombre_ejercicio'] . '</option>';
        //}
        //$this->_view->ejercicios = $datos;
        $this->_view->tabla = $this->verPlan();
        $this->_view->renderizar('plan');
    }

    //OBTENER Datos de la tabla planes de ejercicio en DataTable
    public function verPlan()
    {
        $fila = $this->_plan->obtenerDatosPlan();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
            <tr>
                <td>' . $fila[$i]['id_plan'] . '</td>
                <td>' . $fila[$i]['repeticiones'] . '</td>
                <td>' . $fila[$i]['series'] . '</td>
                <td>
                <button data-ejercicios_plan=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarPlan" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarPlan"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>
                <button data-id=' . $fila[$i]['id_plan'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarPlan"><i class="fa-solid fa-trash"></i> Borrar</button>
                </td>
            </tr>
            ';
        }
        return $tabla;
    }

    /*Función para AGREGAR nuevos Ejercicios*/
    public function agregarPlan()
    {
        $this->_plan->agregarPlan(
            $this->getTexto('Nrepeticiciones'), 
            $this->getTexto('Nseries')
        );
        echo $this->verPlan();
    }

    /*Función para EDITAR los Ejercicios previamente agredos*/
    public function editarPlan()
    {
        $this->_plan->editarPlan(
            $this->getTexto('idPlan'),
            $this->getTexto('Nrepeticiones'), 
            $this->getTexto('Nseries')
        );
        echo $this->verPlan();
    }

    // Función para BORRAR los EJERCICIOS//
    public function borrarPlan()
    {
        $this->_plan->borrarPlan($this->getTexto('idPlan'));
        echo $this->verPlan();
    }
}
?>