<?php
class matriculadoModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function obtenerDatosMatriculados()
    {
        return $this->_db->query("SELECT * FROM matricula INNER JOIN estudiantes ON estudiantes.id_estudiante=matricula.id_estudiante INNER JOIN grupos ON grupos.id_grupo=matricula.id_grupo;")->fetchAll();
    }

    public function borrarMatricula($estudiante)
    {
        $this->_db->prepare("DELETE FROM matricula WHERE id_estudiante=:estudiante;")->execute(array(
            'estudiante' => $estudiante
        ));
    }
}