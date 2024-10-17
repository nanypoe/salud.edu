<?php
class matriculaModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function obtenerGrupos()
    {
        return $this->_db->query("SELECT * FROM grupos")->fetchAll();
    }

    public function obtenerDatosMatricula()
    {
        return $this->_db->query("SELECT estudiantes.id_estudiante, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido FROM estudiantes LEFT JOIN matricula ON estudiantes.id_estudiante=matricula.id_estudiante WHERE matricula.id_estudiante IS NULL;")->fetchAll();
    }

    public function matricular($estudiante, $grupo)
    {
        $this->_db->prepare("INSERT INTO matricula (id_estudiante, id_grupo) VALUES (:estudiante, :grupo)")->execute(array(
            'estudiante' => $estudiante,
            'grupo' => $grupo
        ));
    }
}
