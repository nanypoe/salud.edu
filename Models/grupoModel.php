<?php

class grupoModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    // Función para obtener LECTIVOS para la Vista
    public function obtenerLectivos()
    {
        return $this->_db->query("SELECT * FROM axo_lectivo")->fetchAll();
    }

    // Función para obtener DOCENTES para la Vista
    public function obtenerDocentes()
    {
        return $this->_db->query("SELECT * FROM docentes")->fetchAll();
    }

    // Función para obtener GRUPOS para la Vista
    public function obtenerGrupos()
    {
        return $this->_db->query("SELECT * FROM grupos INNER JOIN axo_lectivo ON  grupos.lectivo_id = axo_lectivo.id_lectivo INNER JOIN  docentes ON grupos.docente_id = docentes.id_docente")->fetchAll();
    }

    // Función para AGREGAR Grupo
    public function agregarGrupo(
        $lectivo_id,
        $docente_id,
        $axo_grupo,
        $nombre_grupo,
        $modalidad
    ) {
        try {
            $stmt = $this->_db->prepare("INSERT INTO grupos (
                lectivo_id,
                docente_id,
                axo_grupo,
                nombre_grupo,
                modalidad
            ) VALUES (
                :lectivo_id,
                :docente_id,
                :axo_grupo,
                :nombre_grupo,
                :modalidad
            )");
            $stmt->execute(array(
                'lectivo_id' => $lectivo_id,
                'docente_id' => $docente_id,
                'axo_grupo' => $axo_grupo,
                'nombre_grupo' => $nombre_grupo,
                'modalidad' => $modalidad
            ));
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }

    // Función para EDITAR Grupo
    public function editarGrupo(
        $idGrupo,
        $idAxo,
        $idDocenteUp,
        $gradoGrupo,
        $seccionGrado,
        $modalidadUp
    ) {
        try {
            $stmt = $this->_db->prepare("UPDATE grupos SET 
            lectivo_id=:idAxo,
            docente_id=:idDocenteUp,
            axo_grupo=:gradoGrupo,
            nombre_grupo=:seccionGrado,
            modalidad=:modalidadUp
            WHERE id_grupo=:idGrupo");
            $stmt->execute(array(
                'idGrupo'=>$idGrupo,
                'idAxo' => $idAxo,
                'idDocenteUp' => $idDocenteUp,
                'gradoGrupo' => $gradoGrupo,
                'seccionGrado' => $seccionGrado,
                'modalidadUp' => $modalidadUp
            ));
        } catch (PDOException $e) {
            echo "Error al actualizar el grupo: " . $e->getMessage();
            return false;
        }
    }

    // Función para BORRAR Grupo
    public function borrarGrupo($id_grupoDel)
    {
        $this->_db->prepare('DELETE FROM grupos WHERE id_grupo=:id_grupoDel')->execute(array('id_grupoDel' => $id_grupoDel));
    }
}