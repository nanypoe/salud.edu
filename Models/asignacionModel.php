<?php
class ejercicioModel extends Model
{
    // Método para obtener estudiantes por grupo
    public function obtenerEstudiantes($idGrupo)
    {
        $sql = "SELECT id_estudiante, CONCAT(primer_nombre, ' ', segundo_nombre, ' ', primer_apellido, ' ', segundo_apellido) AS nombreCompleto, foto
                FROM estudiantes
                WHERE id_grupo = :idGrupo";
        
        $params = [':idGrupo' => $idGrupo];
        return $this->db->query($sql, $params);
    }

    // Método para obtener información de un estudiante por ID
    public function obtenerEstudiantePorId($idEstudiante)
    {
        $sql = "SELECT id_estudiante, CONCAT(primer_nombre, ' ', segundo_nombre, ' ', primer_apellido, ' ', segundo_apellido) AS nombreCompleto, foto
                FROM estudiantes
                WHERE id_estudiante = :idEstudiante";
        
        $params = [':idEstudiante' => $idEstudiante];
        return $this->db->query($sql, $params);
    }

    // Método para asignar un ejercicio a un estudiante
    public function asignarEjercicio($idEstudiante, $idGrupo, $ejercicio, $planEjercicio, $duracion, $frecuencia, $descripcion)
    {
        $sql = "INSERT INTO asignaciones_ejercicios (id_estudiante, id_grupo, ejercicio, plan_ejercicio, duracion, frecuencia, descripcion)
                VALUES (:idEstudiante, :idGrupo, :ejercicio, :planEjercicio, :duracion, :frecuencia, :descripcion)";
        
        $params = [
            ':idEstudiante' => $idEstudiante,
            ':idGrupo' => $idGrupo,
            ':ejercicio' => $ejercicio,
            ':planEjercicio' => $planEjercicio,
            ':duracion' => $duracion,
            ':frecuencia' => $frecuencia,
            ':descripcion' => $descripcion
        ];
        
        return $this->db->execute($sql, $params);
    }
}