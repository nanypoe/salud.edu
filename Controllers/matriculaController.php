<?php
class matriculaController extends Controller
{
    private $_matricula;

    function __construct()
    {
        parent::__construct();
        $this->_matricula = $this->loadModel("matricula");
    }

    // LECTURA
// Datos de grupos
    public function verGrupos()
    {
        $fila = $this->_matricula->obtenerGrupos();
        $grupos = '<option value="0">Seleccione un grupo</option>';
        foreach ($fila as $grupo) {
            $grupos .= '<option value="' . $grupo['id_grupo'] . '">' . $grupo['axo_grupo'] . ' ' . $grupo['nombre_grupo'] . '</option>';
        }
        return $grupos;
    }

    // Datos de estudiantes por matricular
    public function verMatricula()
    {
        $fila = $this->_matricula->obtenerDatosMatricula();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $tabla .= '
            <tr>
            <td>' . $fila[$i]['primer_nombre'] . ' ' . $fila[$i]['segundo_nombre'] . ' ' . $fila[$i]['primer_apellido'] . ' ' . $fila[$i]['segundo_apellido'] . '</td>
            <td>
                <button
                    data-estudiante=' . $fila[$i]['id_estudiante'] . '
                    type="button"
                    style="color:white;font-weight:bold"
                    class="btn btn-primary BtnMatricular"
                    id="BtnMatricular">
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
        $this->_view->grupos = $this->verGrupos();
        $this->_view->tabla = $this->verMatricula();
        $this->_view->renderizar('matricula');
    }

    //ESCRITURA
    //MATRICULA
    public function matricular(){
        $this ->_matricula -> matricular(
            $this->getTexto("estudiante"),
            $this->getTexto("grupo"),
        );
        echo $this-> verMatricula();
    }
}