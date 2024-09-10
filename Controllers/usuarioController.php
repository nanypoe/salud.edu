<?php
class usuarioController extends Controller
{
    private $_user;

    function __construct()
    {
        parent::__construct();
        $this->_user = $this->loadModel('usuario');
    }

    /*Función para RENDERIZAR la Vista REGISTRO Y LISTADO DE DEPARTAMENTOS*/
    public function index()
    {
        $this->_view->tabla = $this->verUsuario();
        $this->_view->renderizar('usuario');
    }

    /*Función para VISUALIZAR los DEPARTAMENTOS en la DataTable*/
    public function verUsuario()
    {
        $fila = $this->_user->obtenerUsuario();
        $tabla = '';
        for ($i = 0; $i < count($fila); $i++) {
            $datos = json_encode($fila[$i]);
            $tabla .= '
                <tr>
                    <td>' . $fila[$i]['id_usuario'] . '</td>
                    <td>' . $fila[$i]['usuario'] . '</td>
                    <td>' . $fila[$i]['clave'] . '</td>
                    <td>' . $fila[$i]['rol'] . '</td>
                    <td>
                    <button data-usuarios=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarUsuario" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarUsuario"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
                    <button data-id=' . $fila[$i]['id_usuario'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarDepartamento"><i class="fa-solid fa-trash"></i> Borrar</button>
                    </td>
                </tr>
                ';
        }
        return $tabla;
    }

/*Función para AGREGAR nuevos USUARIOS*/
public function agregarUsuario()
{
    $this->_user->agregarUsuario($this->getTexto('user'), $this->getTexto('clave'), $this->getTexto('rol'));
    echo $this->verUsuario();
}

    // /*Función para EDITAR los DEPARTAMENTOS previamente agredos*/
    // public function editarDepartamento()
    // {
    //     $this->_user->editarDepartamento($this->getTexto('nombreDptoUp'), $this->getTexto('idDpto'));
    //     echo $this->verDepartamento();
    // }

    // // Función para BORRAR los DEPARTAMENTOS
    // public function borrarDepartamento()
    // {
    //     $this->_user->borrarDepartamento($this->getTexto('idDptoDel'));
    //     echo $this->verDepartamento();
    // }
}
?>