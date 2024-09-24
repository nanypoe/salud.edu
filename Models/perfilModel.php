<?php
class perfilModel extends Model {
    function  __construct() {
        parent::__construct();
    }

//#### C. R. U. D. ####
//Lectura
public function obtenerDatosEstudiantes($usuario){
    return $this->_db->query("SELECT * FROM docentes where usuario='$usuario';")->fetchAll();
}

public function obtenerEstudiantes($id){
    return  $this ->_db->query("SELECT * FROM grupos INNER JOIN matricula ON grupos.id_grupo=matricula.id_grupo INNER JOIN  estudiantes ON matricula.id_estudiante=estudiantes.id_estudiante WHERE grupos.id_grupo='$id'")->fetchAll();



}

public  function obtenerGrupos($id){
    return $this->_db->query("SELECT * FROM grupos INNER JOIN docentes ON grupos.docente_id=docentes.id_docente")->fetchAll();
}



}