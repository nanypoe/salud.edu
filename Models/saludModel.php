<?php

class saludModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    /*Función para obtener los Datos de Salud que se enviarán al a Vista en sección SALUD */
    public function obtenerDatosSalud()
    {
        return $this->_db->query("SELECT * FROM salud_estudiante INNER JOIN estudiantes ON estudiantes.id_estudiante=salud_estudiante.id_estudiante")->fetchAll();
    }

    /*Función para enviar Estudiantes al Form en DATOS DE SALUD*/
    public function obtenerEstudiante()
    {
        return $this->_db->query("SELECT * FROM estudiantes")->fetchAll();
    }

    /*Función para agregar DATOS DE SALUD */
    public function agregarDatosSalud($idEstudiante, $pesoEstudiante, $alturaEstudiante, $imc, $categoriaPeso, $condicionMedica, $descripcionMedica, $medicacion, $somatotipo)
    {
        $this->_db->prepare('INSERT INTO salud_estudiante (id_estudiante, peso, altura, imc, categoria_peso, condicion_medica, descripcion, medicacion, somatotipo) VALUES (:idEstudiante, :pesoEstudiante, :alturaEstudiante, :imc, :categoriaPeso, :condicionMedica, :descripcionMedica, :medicacion, :somatotipo);')->execute(array(
            'idEstudiante' => $idEstudiante,
            'pesoEstudiante' => $pesoEstudiante,
            'alturaEstudiante' => $alturaEstudiante,
            'imc' => $imc,
            'categoriaPeso' => $categoriaPeso,
            'condicionMedica' => $condicionMedica,
            'descripcionMedica' => $descripcionMedica,
            'medicacion' => $medicacion,
            'somatotipo' => $somatotipo
        ));
    }
    /*
    public function editarAlum($id, $nombre, $sexo, $telefono, $ciudad)
    {
        $this->_db->prepare("update alumno set nombre=:nombre,sexo=:sexo,telefono=:telefono,ciudad=:ciudad where id=:id")->execute(array('nombre' => $nombre, 'sexo' => $sexo, 'telefono' => $telefono, 'ciudad' => $ciudad, 'id' => $id));
    }

    

    public function obtenerEscuela()
    {
        return $this->_db->query("SELECT * FROM escuelas")->fetchAll();
    }

    public function borrarAlum($id)
    {
        $this->_db->prepare('delete from alumno where id=:id')->execute(array('id' => $id));
    }





*/

}
?>