<?php

class pruebaController extends Controller
{

    private $_prueba;

    function __construct()
    {
        parent::__construct();
        $this->_prueba = $this->loadModel('prueba');
    }


    //SESION para PRUEBAS FÍSICO-MOTRICES
    public function sesionPrueba()
    {
        $datos = $this->_prueba->obtenerDatosDocente(Sessiones::getClave('usuario'));
        $id = $datos[0]["id_docente"];
        $fila = $this->_prueba->obtenerGrupos($id);
        $grupos = '<option>Seleccione Grado/Sección</option>';
        foreach ($fila as $grupo) {
            $grupos .= '<option value="' . $grupo["id_grupo"] . '">' . $grupo["axo_grupo"] . ' ' . $grupo["nombre_grupo"] . '</option>';
        }
        return $grupos;
    }


    //RENDERIZAR la vista PRUEBAS FÍSICO-MOTRICES
    public function index()
    {
        $this->_view->grupos = $this->sesionPrueba();
        $this->_view->renderizar("prueba");
    }

    public function tablaEstudiante()
    {
        $fila = $this->_prueba->getEstudiante($this->getTexto("idGrupo"));
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
                <tr>
                <td>' . $fila[$i]['primer_nombre'] . ' ' . $fila[$i]['segundo_nombre'] . ' ' . $fila[$i]['primer_apellido'] . ' ' . $fila[$i]['segundo_apellido'] . '</td>
                    <td>
                    <button data-prueba=\'' . $datos . '\' type="button" class="btn btn-primary BtnAgregarPrueba" data-bs-target="#modalAgregarPrueba" data-bs-toggle="modal"><i class="fa-regular fa-square-plus"></i> Pruebas Físico-Motrices</button>
                </td>
                </tr>
                ';
        }
        echo $tabla;
    }

    public function agregarPrueba()
    {
        $this->_prueba->agregarPrueba(
            $this->getTexto("idEstudiante"),
            $this->getTexto("idGrupo"),
            $this->getTexto("fecha"),
            $this->getTexto("prueba"),
            $this->getTexto("resultado"),
            $this->getTexto("medida"),
            $this->getTexto("observacion")
        );
        echo $this ->tablaEstudiante();
    }

}