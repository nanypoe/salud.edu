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

    

    public function borrarEscuela($id_escuela)
    {
        $this->_db->prepare('DELETE FROM Escuelas WHERE id_escuela=:id_escuela')->execute(array('id_escuela' => $id_escuela));
    }
}
?>