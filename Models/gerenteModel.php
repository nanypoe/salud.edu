<?php

class gerenteModel extends Model{

    function __construct()
    {
        parent::__construct();
    }

    public function agregarAlum($nombre,$sexo,$telefono,$ciudad){
        $this->_db->prepare("insert into alumno(nombre,sexo,telefono,ciudad)values(:nombre,:sexo,:telefono,:ciudad)")->execute(array('nombre'=>$nombre,'sexo'=>$sexo,'telefono'=>$telefono,'ciudad'=>$ciudad));
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