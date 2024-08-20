<?php

class maestrosModel extends Model{

    function __construct()
    {
        parent::__construct();
    }

    public function agregarGer($nombre,$apellido,$correo,$telefono,$perfil,$id){
        $this->_db->prepare("insert into maestros (id_escuela,nombre,apellido,email,telefono,perfil)values(:id,:nombre,:apellido,:correo,:telefono,:correo,:edad,:perfil,:usuario,:clave)")->execute(array('id'=>$id,'nombre'=>$nombre,'apellido'=>$apellido,'correo'=>$correo,'telefono'=>$telefono,'correo'=>$correo,'edad'=>$edad,'perfil'=>$perfil,'usuario'=>$usuario,'clave'=>$clave));
    }

    public function editarAlum($id,$nombre,$sexo,$telefono,$ciudad){
        $this->_db->prepare("update alumno set nombre=:nombre,sexo=:sexo,telefono=:telefono,ciudad=:ciudad where id=:id")->execute(array('nombre'=>$nombre,'sexo'=>$sexo,'telefono'=>$telefono,'ciudad'=>$ciudad,'id'=>$id));
    }

    public function obtenerMaestro(){
        return $this->_db->query("select *from maestros")->fetchAll();
    }

    public function obtenerEscuela(){
        return $this->_db->query("select *from escuelas")->fetchAll();
    }

    public function borrarAlum($id){
        $this->_db->prepare('delete from alumno where id=:id')->execute(array('id'=>$id));
    }





}






?>