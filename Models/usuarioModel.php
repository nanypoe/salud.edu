<?php

class usuarioModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    /*Función para OBTENER datos de USUARIOS para la Vista*/
    public function obtenerUsuario()
    {
        return $this->_db->query("SELECT * FROM usuarios")->fetchAll();
    }

    /*Función para AGREGAR Usuarios*/
    public function agregarUsuario($usuario, $clave, $rol)
    {
        $hash=password_hash($clave, PASSWORD_DEFAULT);
        $this->_db->prepare("INSERT INTO usuarios (usuario, clave, rol) VALUES (:usuario, :clave, :rol);")->execute(array('usuario' => $usuario, 'clave'=> $hash,'rol'=> $rol));
    }

    /*Función para EDITAR Usuarios */
    public function editarUsuario ($idUsr, $usuarioUp, $passUp, $rolUp)
    {
        $hash=password_hash($passUp, PASSWORD_DEFAULT);
        $this->_db->prepare("UPDATE usuarios set usuario=:usuarioUp, clave=:passUp, rol=:rolUp where id_usuario=:idUsr")->execute(array('idUsr'=>$idUsr, 'usuarioUp'=>$usuarioUp, 'passUp'=>$hash, 'rolUp'=>$rolUp));
    }

    //Función para BORRAR Usuarios
    public function borrarUsuario($idUsrDel)
    {
        $this->_db->prepare('DELETE FROM usuarios WHERE id_usuario=:idUsrDel')->execute(array('idUsrDel' => $idUsrDel));
    }
}
?>