<?php
class matriculadoController extends Controller
{
    private $_matriculado;

    function __construct()
    {
        parent::__construct();
        $this->_matriculado = $this->loadModel("matriculado");
    }

    // LECTURA
    // Datos de estudiantes matriculados
    public function verMatriculados()
    {
        $fila = $this->_matriculado->obtenerDatosMatriculados();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
            <tr>
            <td>' . $fila[$i]['axo_grupo'] . ' ' . $fila[$i]['nombre_grupo'] . '</td>
            <td>' . $fila[$i]['primer_nombre'] . ' ' . $fila[$i]['segundo_nombre'] . ' ' . $fila[$i]['primer_apellido'] . ' ' . $fila[$i]['segundo_apellido'] . '</td>
            <td>
                <button
                    data-estudiante=' . $fila[$i]['id_estudiante'] . '
                    type="button"
                    style="color:white;font-weight:bold"
                    class="btn btn-danger BtnBorrarMatricula"
                    id="BtnBorrarMatricula">
                    <i class="fa-solid fa-plus-minus"></i>
                </button>
            </td>
            </tr>
        ';
        }
        return $tabla;
    }

    // INDEX
    public function index()
    {
        $this->_view->tabla = $this->verMatriculados();
        $this->_view->renderizar('matriculado');
    }

    //BORRADO
    public function borrarMatricula(){
        $this ->_matriculado -> borrarMatricula(
            $this->getTexto("estudiante"),
        );
        echo $this -> verMatriculados();
    }
}