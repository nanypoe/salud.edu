<?php

class estudianteModel extends Model
{
    private $_estudiante;

    function __construct()
    {
        parent::__construct();
    }

    //Función para OBTENER Escuelas
    public function obtenerEscuelas()
    {
        return $this->_db->query("SELECT * FROM escuelas")->fetchAll();
    }

    //Función para OBTENER Datos Estudiantes
    public function obtenerDatosEstudiantes()
    {
        return $this->_db->query("SELECT * FROM estudiantes INNER JOIN escuelas  ON estudiantes.id_escuela = escuelas.id_escuela")->fetchAll();
    }

    //Función para agregar Estudiante con Foto
    public function agregarEstudianteFoto(
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
            $stmt = $this->_db->prepare("INSERT INTO estudiantes(id_escuela, primer_nombre,  segundo_nombre, primer_apellido, segundo_apellido, edad, fecha_nacimiento, sexo, direccion,  telefono, email, nombre_tutor, telefono_tutor, estado, imagen) VALUES (:idEscuela, :pNombre, :sNombre, :pApellido, :sApellido, :edad, :nacimiento, :sexo, :direccion, :telefono, :email,  :tutor, :tutorTel, :estado, :imagen
            )");
            $stmt->execute(array(
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

    //Función para agregar Estudiante sin Foto
    public function agregarEstudianteNoFoto(
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
        $estado
    ) {
        try {
            $stmt = $this->_db->query("INSERT INTO estudiantes (
            id_grupo, id_escuela, primer_nombre,  segundo_nombre, primer_apellido, segundo_apellido, edad, fecha_nacimiento, sexo, direccion,  telefono, email, tutor, tutor_tel, estado)
            ) VALUES (
            :idSeccion,  :idEscuela, :pNombre, :sNombre, :pApellido, :sApellido,  :edad, :nacimiento, :sexo, :direccion, :telefono, :email,  :tutor, :tutorTel, :estado
            );");
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
                'estado' => $estado
            ));
        } catch (PDOException $e) {
            echo "Error al agregar estudiante: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Función para editar un estudiante
     */
    public function editarEstudiante($idEstudiante, $idGrupoUp, $idEscuelaUp, $pNombreUp, $sNombreUp, $pApellidoUp, $sApellidoUp, $edadUp, $nacimientoUp, $sexoUp, $direccionUp, $telefonoUp, $emailUp, $tutorUp, $tutorTelUp, $estadoUp, $imagenUp)
    {
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
                'sexoUp' => $sexoUp,
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

    /**
     * Función para eliminar un estudiante
     */
    public function eliminarEstudiante($idEstudiante)
    {
        try {
            $stmt = $this->_db->prepare("DELETE FROM estudiantes WHERE id_estudiante=:idEstudiante");
            $stmt->execute(array('idEstudiante' => $idEstudiante));
        } catch (PDOException $e) {
            echo "Error al eliminar estudiante: " . $e->getMessage();
            return false;
        }
    }
}