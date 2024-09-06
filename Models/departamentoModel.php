<?php

class departamentoModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    /*Función para OBTENER datos de DEPARTAMENTOS para la Vista*/
    public function obtenerDepartamento()
    {
        return $this->_db->query("SELECT * FROM departamentos")->fetchAll();
    }

    /*Función para AGREGAR Departamento*/
    public function agregarDepartamento($nombreDpto)
    {
        $this->_db->prepare("INSERT INTO departamentos (nombre_departamento) VALUES (:nombreDpto);")->execute(array('nombreDpto' => $nombreDpto));
    }

    /*Función para EDITAR Departamento */
    public function editarDepartamento ($nombreDptoUp, $idDpto)
    {
        $this->_db->prepare("UPDATE departamentos set nombre_departamento=:nombreDptoUp where id_departamento=:idDpto")->execute(array('nombreDptoUp'=>$nombreDptoUp, 'idDpto'=>$idDpto));
    }

    //Función para BORRAR Departamentos
    public function borrarDepartamento($idDptoDel)
    {
        $this->_db->prepare('DELETE FROM departamentos WHERE id_departamento=:idDptoDel')->execute(array('idDptoDel' => $idDptoDel));
    }
}
?>