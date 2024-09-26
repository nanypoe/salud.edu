<?php

class pruebaModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    //Obtener ESTUDIANTES
    public function obtenerDatosDocente($usuario)
    {
        return $this->_db->query("SELECT  * FROM docentes WHERE usuario = '$usuario'")->fetchAll();
    }
    public function sesionPrueba()
    {
        return $this->_db->query("SELECT  * FROM estudiantes")->fetchAll();
    }


    //Obtener GRUPOS
    public function obtenerGrupos($id)
    {
        return $this->_db->query("SELECT * FROM grupos INNER JOIN docentes ON grupos.docente_id=docentes.id_docente WHERE docente_id='$id';")->fetchAll();
    }

    public function getEstudiante($id)
    {
        $estudiante_id_query = "SELECT id_estudiante FROM matricula WHERE id_grupo='$id'";
        $estudiante_ids = $this->_db->query($estudiante_id_query)->fetchAll();

        $has_salud_estudiante_records = false;
        foreach ($estudiante_ids as $estudiante_id) {
            $salud_estudiante_query = "SELECT COUNT(*) as count FROM salud_estudiante WHERE id_estudiante={$estudiante_id['id_estudiante']}";
            $salud_estudiante_count = $this->_db->query($salud_estudiante_query)->fetch();
            if ($salud_estudiante_count['count'] > 0) {
                $has_salud_estudiante_records = true;
                break;
            }
        }

        if (!$has_salud_estudiante_records) {
            // Execute the first query if no records are found in salud_estudiante
            return $this->_db->query("SELECT * FROM grupos INNER JOIN matricula ON grupos.id_grupo=matricula.id_grupo INNER JOIN  estudiantes ON matricula.id_estudiante=estudiantes.id_estudiante WHERE grupos.id_grupo='$id'")->fetchAll();
        } else {
            // Execute the second query if records are found in salud_estudiante
            return $this->_db->query("SELECT * FROM grupos INNER JOIN matricula ON grupos.id_grupo=matricula.id_grupo INNER JOIN  estudiantes ON matricula.id_estudiante=estudiantes.id_estudiante INNER JOIN salud_estudiante ON salud_estudiante.id_estudiante=estudiantes.id_estudiante WHERE grupos.id_grupo='$id'")->fetchAll();
        }
    }

    public function agregarPrueba($idEstudiante, $idGrupo, $fecha, $prueba, $resultado, $medida, $observacion)
    {
        $this->_db->prepare("INSERT INTO pruebas_fisicas (id_estudiante, fecha_prueba, tipo_prueba, resultado, unidad_medida, observaciones) VALUES (:idEstudiante, :fecha, :prueba, :resultado, :medida, :observacion)")->execute(
            array(
                "idEstudiante" => $idEstudiante,
                "fecha" => $fecha,
                "prueba" => $prueba,
                "resultado" => $resultado,
                "medida" => $medida,
                "observacion" => $observacion
            )
        );
        echo $idGrupo;
    }
}


