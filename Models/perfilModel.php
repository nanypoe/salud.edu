<?php
class perfilModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    //#### C. R. U. D. ####
//Lectura
    public function obtenerDatosDocente($usuario)
    {
        return $this->_db->query("SELECT * FROM docentes where usuario='$usuario';")->fetchAll();
    }

    public function obtenerEstudiantes($id)
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

    public function obtenerGrupos($id)
    {
        return $this->_db->query("SELECT * FROM grupos INNER JOIN docentes ON grupos.docente_id=docentes.id_docente WHERE docente_id='$id';")->fetchAll();
    }

    public function getEstudiante()
    {
        return $this->_db->query("SELECT * FROM estudiantes")->fetchAll();
    }

    //AGREGAR
    public function agregarPerfil(
        $idEstudiante,
        $peso,
        $altura,
        $imc,
        $categoriaPeso,
        $somatotipo,
        $condicion,
        $descripcion,
        $medicacion,
        $idGrupo
    ) {
        // Check if the user already exists
        $stmt = $this->_db->prepare("SELECT id_estudiante FROM salud_estudiante WHERE id_estudiante = :idEstudiante");
        $stmt->execute(array("idEstudiante" => $idEstudiante));
        $userExists = $stmt->fetchColumn();
        $idGrupo;

        if ($userExists) {
            // Update the existing user's information
            $stmt = $this->_db->prepare("UPDATE salud_estudiante SET 
            peso = :peso, 
            altura = :altura, 
            imc = :imc, 
            categoria_peso = :categoriaPeso, 
            somatotipo = :somatotipo, 
            condicion_medica = :condicion, 
            descripcion = :descripcion, 
            medicacion = :medicacion 
        WHERE id_estudiante = :idEstudiante");
            $stmt->execute(array(
                "peso" => $peso,
                "altura" => $altura,
                "imc" => $imc,
                "categoriaPeso" => $categoriaPeso,
                "somatotipo" => $somatotipo,
                "condicion" => $condicion,
                "descripcion" => $descripcion,
                "medicacion" => $medicacion,
                "idEstudiante" => $idEstudiante
            ));
            echo $idGrupo;
        } else {
            // Insert a new user
            $stmt = $this->_db->prepare("INSERT INTO salud_estudiante (
            id_estudiante, peso, altura, imc, categoria_peso, condicion_medica, descripcion, medicacion, somatotipo
        ) VALUES (
            :idEstudiante,  :peso, :altura, :imc, :categoriaPeso, :condicion,  :descripcion, :medicacion, :somatotipo
        )");
            $stmt->execute(array(
                "idEstudiante" => $idEstudiante,
                "peso" => $peso,
                "altura" => $altura,
                "imc" => $imc,
                "categoriaPeso" => $categoriaPeso,
                "somatotipo" => $somatotipo,
                "condicion" => $condicion,
                "descripcion" => $descripcion,
                "medicacion" => $medicacion
            ));
            echo $idGrupo;
        }
    }

}