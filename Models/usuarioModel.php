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

    // /*Función para EDITAR Departamento */
    // public function editarDepartamento ($nombreDptoUp, $idDpto)
    // {
    //     $this->_db->prepare("UPDATE departamentos set nombre_departamento=:nombreDptoUp where id_departamento=:idDpto")->execute(array('nombreDptoUp'=>$nombreDptoUp, 'idDpto'=>$idDpto));
    // }

    // //Función para BORRAR Departamentos
    // public function borrarDepartamento($idDptoDel)
    // {
    //     $this->_db->prepare('DELETE FROM departamentos WHERE id_departamento=:idDptoDel')->execute(array('idDptoDel' => $idDptoDel));
    // }
}
?>