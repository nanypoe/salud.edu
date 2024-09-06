<?php
class lectivoController extends Controller
{
    private $_lecti;

    function __construct()
    {
        parent::__construct();
        $this->_lecti = $this->loadModel('lectivo');
    }


    /*Función para RENDERIZAR la Vista REGISTRO Y LISTADO DE AÑO Lectivo*/
    public function index()
    {
        $this->_view->tabla = $this->verLectivo();
        $this->_view->renderizar('lectivo');
    }

    /*Función para VISUALIZAR los AÑO Lectivo en la DataTable*/
    public function verLectivo()
    {
        $fila = $this->_lecti->obtenerLectivo();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
                <tr>
                    <td>' . $fila[$i]['id_lectivo'] . '</td>
                    <td>' . $fila[$i]['axo'] . '</td>
                    <td>
                    <button data-lectivo=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarLectivo" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarLectivo"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
                    <button data-id=' . $fila[$i]['id_lectivo'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarLectivo"><i class="fa-solid fa-trash"></i> Borrar</button>
                    </td>
                </tr>
                ';
        }
        return $tabla;
    }

    /*Función para AGREGAR nuevos AÑO Lectivo*/
    public function agregarLectivo()
    {
        $lectivo = $this->getTexto('lectivo');
        $this->_lecti->agregarLectivo($lectivo);
        echo $this->verLectivo();
    }

    /*Función para EDITAR los AÑO Lectivo previamente agredos*/
    public function editarLectivo()
    {
        $this->_lecti->editarLectivo($this->getTexto('axo'), $this->getTexto('idLectivo'));
        echo $this->verLectivo();
    }

    // Función para BORRAR los AÑO Lectivo
    public function borrarLectivo()
    {
        $this->_lecti->borrarLectivo($this->getTexto('idLectivoDel'));
        echo $this->verLectivo();
    }
}
?>