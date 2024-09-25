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
        return $this->_db->query("SELECT * FROM grupos INNER JOIN matricula ON grupos.id_grupo=matricula.id_grupo INNER JOIN  estudiantes ON matricula.id_estudiante=estudiantes.id_estudiante INNER JOIN salud_estudiante ON salud_estudiante.id_estudiante=estudiantes.id_estudiante WHERE grupos.id_grupo='$id'")->fetchAll();
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