<?php

class estudianteModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function insertarEstudiante($id, $pNombre, $sNombre, $pApellido, $sApellido, $edad, $fecha, $sexo,$direccion, $telefonoAlumno, $correo, $nombreTutor, $telefonoTutor, $imagen)
    {
        $this->_db->prepare('INSERT INTO estudiantes (id_escuela, primer_nombre, segundo_nombre, primer_apellido,segundo_apellido,edad,fecha_nacimiento,sexo,direccion,telefono,email, nombre_tutor, telefono_tutor, imagen) VALUES (:id, :pNombre, :sNombre, :pApellido, :sApellido, :edad, :fecha, :sexo, :direccion, :telefonoAlumno,:correo,:nombreTutor,:telefonoTutor,:imagen);')->execute(array(
            'id' => $id,
            'pNombre' => $pNombre,
            'sNombre' => $sNombre,
            'pApellido' => $pApellido,
            'sApellido' => $sApellido,
            'edad' => $edad,
            'fecha' => $fecha,
            'sexo' => $sexo,
            'direccion' => $direccion,
            'telefonoAlumno' => $telefonoAlumno,
            'correo' => $correo, 
            'nombreTutor' => $nombreTutor,
            'telefonoTutor' => $telefonoTutor,
            'imagen' => $imagen
        ));
    }

    public function insertarEstSinImagen($id, $pNombre, $sNombre, $pApellido, $sApellido, $fecha, $edad, $sexo, $telefonoAlumno, $correo, $direccion, $nombreTutor, $telefonoTutor)
    {
        $this->_db->prepare('INSERT INTO estudiantes (id_escuela, primer_nombre, segundo_nombre, primer_apellido,segundo_apellido,edad,fecha_nacimiento,sexo,direccion,telefono,email, nombre_tutor, telefono_tutor) VALUES (:id, :pNombre, :sNombre, :pApellido, :sApellido, :edad, :fecha, :sexo, :direccion, :telefonoAlumno,:correo,:nombreTutor,:telefonoTutor);')->execute(array(
            'id' => $id,
            'pNombre' => $pNombre,
            'sNombre' => $sNombre,
            'pApellido' => $pApellido,
            'sApellido' => $sApellido,
            'edad' => $edad,
            'fecha' => $fecha,
            'sexo' => $sexo,
            'direccion' => $direccion,
            'telefonoAlumno' => $telefonoAlumno,
            'correo' => $correo,
            'nombreTutor' => $nombreTutor,
            'telefonoTutor' => $telefonoTutor,
        ));
    }

    public function obtenerAlumno()
    {
        return $this->_db->query("select esc.nombre as nombre_escuela,est.id_estudiante,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,edad,imagen,est.fecha_nacimiento,est.sexo,est.direccion,est.telefono,
        est.email,est.nombre_tutor,est.telefono_tutor from estudiantes as est inner join escuelas as
        esc on esc.id_escuela=est.id_escuela;")->fetchAll();
    } 

    public function obtenerEscuela()
    {
        return $this->_db->query("select *from escuelas")->fetchAll();
    }

    public function borrarAlum($id)
    {
        $this->_db->prepare('delete from alumno where id=:id')->execute(array('id' => $id));
    }





}






?>