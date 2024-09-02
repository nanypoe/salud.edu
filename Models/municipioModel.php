<?php

class municipioModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function obtenerMunicipio()
    {
        return $this->_db->query("SELECT * FROM municipios")->fetchAll();
    }

    public function obtenerDepartamento()
    {
        return $this->_db->query("SELECT * FROM departamentos")->fetchAll();
    }
    
    public function agregarMunicipio($idDepartamento, $nombre)
    {
        $this->_db->prepare("INSERT INTO municipios (id_departamento, nombre_departamento) VALUES (:idDepartament, :nombre);")->execute(array('idDepartamento' => $idDepartamento, 'nombre' => $nombre));
    }

    /* 
        public function editarDep($nombre,$id_departamento)
        {
            $this->_db->prepare("UPDATE departamento set nombre=:nombre where id_departamento=:idDepartamento")->execute(array('nombre_departamento' => $nombre));
        }

        public function borrarEscuela($id_escuela)
        {
            $this->_db->prepare('DELETE FROM Escuelas WHERE id_escuela=:id_escuela')->execute(array('id_escuela' => $id_escuela));
        } */
}
?>