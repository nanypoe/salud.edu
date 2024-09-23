<?php
class docenteController extends Controller
{
    private $_docente;

    function __construct()
    {
        parent::__construct();
        $this->_docente = $this->loadModel('docente');
    }

    /*Función para RENDERIZAR la Vista REGISTRO Y LISTADO DE DOCENTES*/
    public function index()
    {
        /*Mandar DATOS de ESCUELAS a la Vista DOCENTES*/
        $fila = $this->_docente->obtenerEscuela();
        $datos = '<option value="0"> Seleccione una Escuela</option>';
        for ($i = 0; $i < count($fila); $i++) {
            $datos .= '<option value="' . $fila[$i]['id_escuela'] . '">' . $fila[$i]['nombre'] . '</option>';
        }
        $this->_view->escuelas = $datos;
        $this->_view->tabla = $this->verDocente();
        $this->_view->renderizar('docente');
    }

    //OBTENER Datos de la tabla DOCENTES en DataTable
    public function verDocente()
    {
        $fila = $this->_docente->obtenerDocente();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
            <tr>
                <td>' . $fila[$i]['id_docente'] . '</td>
                <td>' . $fila[$i]['nombre'] . '</td>
                <td>' . $fila[$i]['apellido'] . '</td>
                <td>' . $fila[$i]['email'] . '</td>
                <td>' . $fila[$i]['telefono'] . '</td>
                <td>
                <button data-docente=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarDocente" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarDocente"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>
                <button data-id=' . $fila[$i]['id_docente'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarDocente"><i class="fa-solid fa-trash"></i> Borrar</button>
                </td>
            </tr>
            ';
        }
        return $tabla;
    }

    //AGREGAR Docente
    public function agregarDocente()
    {
        $this->_docente->agregarDocente(
            $this->getTexto('id_escuela'),
            $this->getTexto('nombreDocente'),
            $this->getTexto('apellidoDocente'),
            $this->getTexto('emailDocente'),
            $this->getTexto('telefonoDocente'),
            $this->getTexto('usuarioDocente'),
            $this->getTexto('claveDocente')
        );
        echo $this->verDocente();
    }

    //EDITAR Docente
    public function editarDocente()
    {
        $this->_docente->editarDocente(
            $this->getTexto('idDocenteUp'),
            $this->getTexto('escuelaDocenteUp'),
            $this->getTexto('nombreDocenteUp'),
            $this->getTexto('apellidoDocenteUp'),
            $this->getTexto('emailDocenteUp'),
            $this->getTexto('telefonoDocenteUp')
        );
        echo $this->verDocente();
    }

    //BORRAR Docente
    public function borrarDocente()
    {
        $this->_docente->borrarDocente($this->getTexto('idDocenteDel'));
        echo $this->verDocente();
    }
}