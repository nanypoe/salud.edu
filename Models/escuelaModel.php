<?php

class escuelaModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function agregarEsc($nombre, $direccion, $telefono, $longitud, $latitud)
    {
        $this->_db->prepare("INSERT INTO escuelas (nombre, direccion, telefono, longitud, latitud) VALUES (:nombre, :direccion, :telefono, :longitud, :latitud)")->execute(array('nombre' => $nombre, 'direccion' => $direccion, 'telefono' => $telefono, 'longitud' => $longitud, 'latitud' => $latitud));
    }

    public function editarEscuela($nombre, $direccion, $telefono, $longitud, $latitud, $id_escuela)
    {
        $this->_db->prepare("UPDATE escuelas set nombre=:nombre, direccion=:direccion, telefono=:telefono, longitud=:longitud, latitud=:latitud where id_escuela=:idEscuela")->execute(array('nombre' => $nombre, 'direccion' => $direccion, 'telefono' => $telefono, 'longitud' => $longitud, 'latitud' => $latitud, 'id_escuela' => $id_escuela));
    }

    public function obtenerEscuela()
    {
        return $this->_db->query("SELECT * FROM escuelas")->fetchAll();
    }

    public function borrarEscuela($id_escuela)
    {
        $this->_db->prepare('DELETE FROM Escuelas WHERE id_escuela=:id_escuela')->execute(array('id_escuela' => $id_escuela));
    }
}
?>