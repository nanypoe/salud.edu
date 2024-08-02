<?php

class gimnasioModel extends Model{

    function __construct()
    {
        parent::__construct();
    }

    public function insertarGym($duexo,$nombre,$latitud,$longitud,$horaAbre,$horaCierra,$telefono,$direccion,$imagen){
        $this->_db->prepare("insert into local(nombre,direccion,telefono,longitud,latitud,hora_apertura,hora_cierre,imagen,gerente_id)values(:nombre,:direccion,:telefono,:longitud,:latitud,:horaAbre,:horaCierra,:imagen,:duexo)")->execute(array('nombre'=>$nombre,'direccion'=>$direccion,'telefono'=>$telefono,'longitud'=>$longitud,'latitud'=>$latitud,'horaAbre'=>$horaAbre,'horaCierra'=>$horaCierra,'imagen'=>$imagen,'duexo'=>$duexo));
    }

    public function insertarGym2($duexo,$nombre,$latitud,$longitud,$horaAbre,$horaCierra,$telefono,$direccion){
        $this->_db->prepare("insert into local(nombre,direccion,telefono,longitud,latitud,hora_apertura,hora_cierre,imagen,gerente_id)values(:nombre,:direccion,:telefono,:longitud,:latitud,:horaAbre,:horaCierra,:duexo)")->execute(array('nombre'=>$nombre,'direccion'=>$direccion,'telefono'=>$telefono,'longitud'=>$longitud,'latitud'=>$latitud,'horaAbre'=>$horaAbre,'horaCierra'=>$horaCierra,'duexo'=>$duexo));
    }

    public function obteneDuexo(){
        return $this->_db->query("select *from gerentes")->fetchAll();
    }

    public function obtenerGym(){
        return $this->_db->query("select *from local")->fetchAll();
    }

    public function borrarAlum($id){
        $this->_db->prepare('delete from alumno where id=:id')->execute(array('id'=>$id));
    }





}






?>