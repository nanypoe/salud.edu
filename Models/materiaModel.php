<?php

class materiaModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    // Función para obtener GRUPOS para la Vista
    public function obtenerGrupos()
    {
        return $this->_db->query("SELECT * FROM grupos")->fetchAll();
    }

    // Función para obtener MATERIAS para la Vista
    public function obtenerMaterias()
    {
        return $this->_db->query("SELECT m.*, g.nombre_grupo 
                                 FROM materias m 
                                 INNER JOIN grupos g ON m.id_grupo = g.id_grupo")->fetchAll();
    }

    // Función para AGREGAR Materia
    public function agregarMateria($id_grupo, $nombre_materia)
    {
        try {
            $stmt = $this->_db->prepare("INSERT INTO materias (
                id_grupo,
                nombre_materia
            ) VALUES (
                :id_grupo,
                :nombre_materia
            )");
            $stmt->execute(array(
                'id_grupo' => $id_grupo,
                'nombre_materia' => $nombre_materia
            ));
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }

    // Función para EDITAR Materia
    public function editarMateria($id_materia, $id_grupo, $nombre_materia)
    {
        try {
            $stmt = $this->_db->prepare("UPDATE materias SET 
            id_grupo=:id_grupo,
            nombre_materia=:nombre_materia
            WHERE id_materia=:id_materia");
            $stmt->execute(array(
                'id_materia' => $id_materia,
                'id_grupo' => $id_grupo,
                'nombre_materia' => $nombre_materia
            ));
        } catch (PDOException $e) {
            echo "Error al actualizar la materia: " . $e->getMessage();
            return false;
        }
    }

    // Función para BORRAR Materia
    public function borrarMateria($id_materiaDel)
    {
        $this->_db->prepare('DELETE FROM materias WHERE id_materia=:id_materiaDel')->execute(array('id_materiaDel' => $id_materiaDel));
    }
}