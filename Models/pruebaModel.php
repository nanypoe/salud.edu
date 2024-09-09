<?php

class pruebaModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

/*Función para OBTENER datos de PRUEBAS FÍSICAS para la Vista*/
public function obtenerDatosPruebas()
{
    return $this->_db->query("SELECT * FROM pruebas_fisicas INNER JOIN estudiantes ON pruebas_fisicas.id_estudiante=estudiantes.id_estudiante")->fetchAll();
}

    public function agregarPrueba($idE, $tipo, $resultado, $unidad, $observacion, $fecha)
    {
        $this->_db->prepare("INSERT INTO puebras_fisicas (id_estudiante,tipo, resultado, unidad, observacion, fecha) VALUES (:idE,:tipo, :resultado, :unidad, :observacion, :fecha)")->execute(array('idE' => $idE,'tipo' => $tipo, 'resultado' => $resultado, 'unidad' => $unidad, 'observacion' => $observacion, 'fecha' => $fecha));
    }

    public function editarEscuela($nombre, $direccion, $telefono, $longitud, $latitud, $id_escuela)
    {
        $this->_db->prepare("UPDATE escuelas set nombre=:nombre, direccion=:direccion, telefono=:telefono, longitud=:longitud, latitud=:latitud where id_escuela=:idEscuela")->execute(array('nombre' => $nombre, 'direccion' => $direccion, 'telefono' => $telefono, 'longitud' => $longitud, 'latitud' => $latitud, 'id_escuela' => $id_escuela));
    }

    public function obtenerPrueba()
    {
        return $this->_db->query("SELECT * FROM puebras_fisicas")->fetchAll();
    }

    public function obtenerEstudiante()
    {
        return $this->_db->query("SELECT * FROM  estudiantes")->fetchAll();
    }

    public function borrarEscuela($id_escuela)
    {
        $this->_db->prepare('DELETE FROM Escuelas WHERE id_escuela=:id_escuela')->execute(array('id_escuela' => $id_escuela));
    }
}
?>
