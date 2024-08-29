<?php

class estudianteModel extends Model{

    function __construct()
    {
        parent::__construct();
    }

    public function agregarMaes($nombre,$apellido,$correo,$telefono,$perfil,$id){
        $this->_db->prepare("insert into maestros (id_escuela,nombre,apellido,email,telefono,perfil)values(:id,:nombre,:apellido,:correo,:telefono,:perfil)")->execute(array('id'=>$id,'nombre'=>$nombre,'apellido'=>$apellido,'correo'=>$correo,'telefono'=>$telefono,'perfil'=>$perfil));
    }

    public function editarAlum($id,$nombre,$sexo,$telefono,$ciudad){
        $this->_db->prepare("update alumno set nombre=:nombre,sexo=:sexo,telefono=:telefono,ciudad=:ciudad where id=:id")->execute(array('nombre'=>$nombre,'sexo'=>$sexo,'telefono'=>$telefono,'ciudad'=>$ciudad,'id'=>$id));
    }

    public function obtenerAlumno(){
        return $this->_db->query("select esc.nombre as nombre_escuela,est.id_estudiante,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,est.fecha_nacimiento,est.sexo,est.direccion,est.telefono,
        est.email,est.nombre_tutor,est.telefono_tutor from estudiantes as est inner join escuelas as
        esc on esc.id_escuela=est.id_escuela;")->fetchAll();
    }

    public function obtenerEscuela(){
        return $this->_db->query("select *from escuelas")->fetchAll();
    }

    public function borrarAlum($id){
        $this->_db->prepare('delete from alumno where id=:id')->execute(array('id'=>$id));
    }





}






?>