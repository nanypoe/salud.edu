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
                    <button data-usuario=\'' . $datos . '\'  data-bs-toggle="modal" data-bs-target="#modalEditarUsuario" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarUsuario"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
                    <button data-id=' . $fila[$i]['id_usuario'] . ' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarUsuario"><i class="fa-solid fa-trash"></i> Borrar</button>
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

    /*Función para EDITAR los USUARIOS previamente agredos*/
    public function editarUsuario()
    {
        $this->_user->editarUsuario($this->getTexto('idUsr'), $this->getTexto('usuarioUp'), $this->getTexto('passUp'), $this->getTexto('rolUp'));
        echo $this->verUsuario();
    }

    // Función para BORRAR los USUARIOS
    public function borrarUsuario()
    {
        $this->_user->borrarUsuario($this->getTexto('idUsrDel'));
        echo $this->verUsuario();
    }
}
?>