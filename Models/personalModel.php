<?php

class personalModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function sesionEstudiante()
    {
        return $this->_db->query("SELECT * FROM estudiantes")->fetchAll();
    }

    public function obtenerMatricula()
    {
        return $this->_db->query("")->fetchAll();
    }
    public function obtenerDatosEstudiante($usuario)
    {
        return $this->_db->query("SELECT  * FROM estudiantes INNER JOIN matricula  ON estudiantes.id_estudiante = matricula.id_estudiante INNER JOIN grupos  ON matricula.id_grupo = grupos.id_grupo WHERE usuario='$usuario'")->fetchAll();
    }
    public function obtenerEstudiante($id)
    {
        return $this->_db->query("SELECT * FROM estudiantes INNER JOIN salud_estudiante ON estudiantes.id_estudiante=salud_estudiante.id_estudiante WHERE estudiantes.id_estudiante='$id'")->fetchAll();
    }
}