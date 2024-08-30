<?php

class departamentoModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function agregarDep($nombre)
    {
        $this->_db->prepare("INSERT INTO departamentos (nombre_departamento) VALUES (:nombre);")->execute(array('nombre' => $nombre));
    }

    public function editarDep($nombre,$id_departamento)
    {
        $this->_db->prepare("UPDATE departamento set nombre=:nombre where id_departamento=:idDepartamento")->execute(array('nombre_departamento' => $nombre));
    }

    public function obtenerDepartamento()
    {
        return $this->_db->query("SELECT * FROM departamentos")->fetchAll();
    }

    public function borrarEscuela($id_escuela)
    {
        $this->_db->prepare('DELETE FROM Escuelas WHERE id_escuela=:id_escuela')->execute(array('id_escuela' => $id_escuela));
    }
}
?>