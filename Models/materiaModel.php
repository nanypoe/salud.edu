<?php

class materiaModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function obtenerMateria()
    {
        return $this->_db->query("SELECT * FROM materia")->fetchAll();
    }

    /* public function agregarEsc($nombre, $direccion, $telefono, $longitud, $latitud)
    {
        $this->_db->prepare("INSERT INTO Escuelas (nombre, direccion, telefono, longitud, latitud) VALUES (:nombre, :direccion, :telefono, :longitud, :latitud)")->execute(array('nombre' => $nombre, 'direccion' => $direccion, 'telefono' => $telefono, 'longitud' => $longitud, 'latitud' => $latitud));
    }

    public function editarEscuela($nombre, $direccion, $telefono, $longitud, $latitud, $id_escuela)
    {
        $this->_db->prepare("UPDATE Escuelas set nombre=:nombre, direccion=:direccion, telefono=:telefono, longitud=:longitud, latitud=:latitud where id_escuela=:idEscuela")->execute(array('nombre' => $nombre, 'direccion' => $direccion, 'telefono' => $telefono, 'longitud' => $longitud, 'latitud' => $latitud, 'id_escuela' => $id_escuela));
    } 

    public function borrarEscuela($id_escuela)
    {
        $this->_db->prepare('DELETE FROM Escuelas WHERE id_escuela=:id_escuela')->execute(array('id_escuela' => $id_escuela));
    }
*/

}
?>