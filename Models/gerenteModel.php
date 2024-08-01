<?php

class gerenteModel extends Model{

    function __construct()
    {
        parent::__construct();
    }

    public function agregarGer($nombre,$sexo,$fecha,$telefono,$cedula,$edad,$usuario,$clave,$direccion,$correo){
        $this->_db->prepare("insert into gerentes (nombre,fecha_nacimiento,sexo,direccion,telefono,email,edad,cedula,usuario,clave)values(:nombre,:fecha,:sexo,:direccion,:telefono,:correo,:edad,:cedula,:usuario,:clave)")->execute(array('nombre'=>$nombre,'fecha'=>$fecha,'sexo'=>$sexo,'direccion'=>$direccion,'telefono'=>$telefono,'correo'=>$correo,'edad'=>$edad,'cedula'=>$cedula,'usuario'=>$usuario,'clave'=>$clave));
    }

    public function editarAlum($id,$nombre,$sexo,$telefono,$ciudad){
        $this->_db->prepare("update alumno set nombre=:nombre,sexo=:sexo,telefono=:telefono,ciudad=:ciudad where id=:id")->execute(array('nombre'=>$nombre,'sexo'=>$sexo,'telefono'=>$telefono,'ciudad'=>$ciudad,'id'=>$id));
    }

    public function obtenerGerente(){
        return $this->_db->query("select *from gerentes")->fetchAll();
    }

    public function borrarAlum($id){
        $this->_db->prepare('delete from alumno where id=:id')->execute(array('id'=>$id));
    }





}






?>