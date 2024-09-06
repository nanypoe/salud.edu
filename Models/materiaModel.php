<?php

class materiaModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    /*Función para OBTENER datos de MATERIAS para la Vista*/
    public function obtenerDatosMateria()
    {
        return $this->_db->query("SELECT materia.id_materia, nombre_grupo, maestros.nombre, maestros.apellido FROM materia INNER JOIN grupos ON materia.id_grupo=grupos.id_grupo INNER JOIN maestros ON materia.id_maestro=maestros.id_maestro")->fetchAll();
    }

    /*Función para AGREGAR Materias*/
    public function agregarDepartamento($nombreDpto)
    {
        $this->_db->prepare("INSERT INTO departamentos (nombre_departamento) VALUES (:nombreDpto);")->execute(array('nombreDpto' => $nombreDpto));
    }

    /*Función para EDITAR Materias */
    public function editarDepartamento ($nombreDptoUp, $idDpto)
    {
        $this->_db->prepare("UPDATE departamentos set nombre_departamento=:nombreDptoUp where id_departamento=:idDpto")->execute(array('nombreDptoUp'=>$nombreDptoUp, 'idDpto'=>$idDpto));
    }

    //Función para BORRAR Materias
    public function borrarDepartamento($idDptoDel)
    {
        $this->_db->prepare('DELETE FROM departamentos WHERE id_departamento=:idDptoDel')->execute(array('idDptoDel' => $idDptoDel));
    }
}
?>