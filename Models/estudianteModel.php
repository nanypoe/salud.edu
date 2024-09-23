<?php

class estudianteModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    // Función para obtener GRUPOS para la Vista
    public function obtenerGrupos()
    {
        return $this->_db->query("SELECT * FROM grupos")->fetchAll();
    }

    // Función para obtener ESCUELAS para la Vista
    public function obtenerEscuelas()
    {
        return $this->_db->query("SELECT * FROM escuelas")->fetchAll();
    }

    // Función para obtener ESTUDIANTES para la Vista
    public function obtenerEstudiantes()
    {
        return $this->_db->query("SELECT * FROM estudiantes")->fetchAll();
    }

    // Función para AGREGAR Estudiante
    public function agregarEstudiante(
        $idSeccion,
        $idEscuela,
        $pNombre,
        $sNombre,
        $pApellido,
        $sApellido,
        $edad,
        $nacimiento,
        $sexo,
        $direccion,
        $telefono,
        $email,
        $tutor,
        $tutorTel,
        $estado,
        $imagen
    ) {
        try {
            $stmt = $this->_db->prepare("INSERT INTO estudiantes (
                id_seccion,
                id_escuela,
                p_nombre,
                s_nombre,
                p_apellido,
                s_apellido,
                edad,
                nacimiento,
                sexo,
                direccion,
                telefono,
                email,
                tutor,
                tutor_tel,
                estado,
                imagen
            ) VALUES (
                :idSeccion,
                :idEscuela,
                :pNombre,
                :sNombre,
                :pApellido,
                :sApellido,
                :edad,
                :nacimiento,
                :sexo,
                :direccion,
                :telefono,
                :email,
                :tutor,
                :tutorTel,
                :estado,
                :imagen
            )");
            $stmt->execute(array(
                'idSeccion' => $idSeccion,
                'idEscuela' => $idEscuela,
                'pNombre' => $pNombre,
                'sNombre' => $sNombre,
                'pApellido' => $pApellido,
                'sApellido' => $sApellido,
                'edad' => $edad,
                'nacimiento' => $nacimiento,
                'sexo' => $sexo,
                'direccion' => $direccion,
                'telefono' => $telefono,
                'email' => $email,
                'tutor' => $tutor,
                'tutorTel' => $tutorTel,
                'estado' => $estado,
                'imagen' => $imagen
            ));
        } catch (PDOException $e) {
            echo "Error al agregar estudiante: " . $e->getMessage();
            return false;
        }
    }

    // Función para EDITAR Estudiante
    public function editarEstudiante(
        $idEstudiante,
        $idGrupoUp,
        $idEscuelaUp,
        $pNombreUp,
        $sNombreUp,
        $pApellidoUp,
        $sApellidoUp,
        $edadUp,
        $nacimientoUp,
        $sexoUp,
        $direccionUp,
        $telefonoUp,
        $emailUp,
        $tutorUp,
        $tutorTelUp,
        $estadoUp,
        $imagenUp
    ) {
        try {
            $stmt = $this->_db->prepare("UPDATE estudiantes SET 
            id_grupo=:idGrupoUp,
            id_escuela=:idEscuelaUp,
            p_nombre=:pNombreUp,
            s_nombre=:sNombreUp,
            p_apellido=:pApellidoUp,
            s_apellido=:sApellidoUp,
            edad=:edadUp,
            nacimiento=:nacimientoUp,
            sexo=:sexoUp,
            direccion=:direccionUp,
            telefono=:telefonoUp,
            email=:emailUp,
            tutor=:tutorUp,
            tutor_tel=:tutorTelUp,
            estado=:estadoUp,
            imagen=:imagenUp
            WHERE id_estudiante=:idEstudiante");
            $stmt->execute(array(
                'idEstudiante' => $idEstudiante,
                'idGrupoUp' => $idGrupoUp,
                'idEscuelaUp' => $idEscuelaUp,
                'pNombreUp' => $pNombreUp,
                'sNombreUp' => $sNombreUp,
                'pApellidoUp' => $pApellidoUp,
                'sApellidoUp' => $sApellidoUp,
                'edadUp' => $edadUp,
                'nacimientoUp' => $nacimientoUp,
                ' sexoUp' => $sexoUp,
                'direccionUp' => $direccionUp,
                'telefonoUp' => $telefonoUp,
                'emailUp' => $emailUp,
                'tutorUp' => $tutorUp,
                'tutorTelUp' => $tutorTelUp,
                'estadoUp' => $estadoUp,
                'imagenUp' => $imagenUp
            ));
        } catch (PDOException $e) {
            echo "Error al editar estudiante: " . $e->getMessage();
            return false;
        }
    }

    // Función para BORRAR Estudiante
    public function borrarEstudiante($idEstudiante)
    {
        try {
            $stmt = $this->_db->prepare("DELETE FROM estudiantes WHERE id_estudiante=:idEstudiante");
            $stmt->execute(array('idEstudiante' => $idEstudiante));
        } catch (PDOException $e) {
            echo "Error al borrar estudiante: " . $e->getMessage();
            return false;
        }
    }
}

?>