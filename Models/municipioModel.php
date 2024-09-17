<?php

class municipioModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    /*Función para OBTENER datos de MUNICIPIOS para la Vista*/
    public function obtenerDatosMunicipio()
    {
        return $this->_db->query("SELECT id_municipio, departamentos.nombre_departamento, nombre_municipio FROM municipios INNER JOIN departamentos ON municipios.id_departamento=departamentos.id_departamento")->fetchAll();
    }

    /*Función para Obtener DEPARTAMENTOS en la VISTA de MUNICIPIOS */
    public function obtenerDepartamento()
    {
        return $this->_db->query("SELECT * FROM departamentos")->fetchAll();
    }

    /*Función para AGREGAR Municipio*/
    public function agregarMunicipio($dptoId, $municipio)
    {
        $this->_db->prepare("INSERT INTO municipios (id_departamento, nombre_municipio) VALUES (:dptoId, :municipio);")->execute(array('dptoId' => $dptoId, 'municipio'=>$municipio));
    }

    /*Función para EDITAR Departamento */
    public function editarDepartamento($nombreDptoUp, $idDpto)
    {
        $this->_db->prepare("UPDATE departamentos set nombre_departamento=:nombreDptoUp where id_departamento=:idDpto")->execute(array('nombreDptoUp' => $nombreDptoUp, 'idDpto' => $idDpto));
    }

    //Función para BORRAR Departamentos
    public function borrarDepartamento($idDptoDel)
    {
        $this->_db->prepare('DELETE FROM departamentos WHERE id_departamento=:idDptoDel')->execute(array('idDptoDel' => $idDptoDel));
    }
}
?>