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
        return $this->_db->query("SELECT nombre, id_estudiante, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, edad, fecha_nacimiento, sexo, direccion, escuelas.telefono, email, nombre_tutor, telefono_tutor, estado 
FROM estudiantes 
INNER JOIN escuelas ON estudiantes.id_escuela = escuelas.id_escuela;
")->fetchAll();
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
        $imagen,
        $usuario,
        $clave
    ) {// Validación de datos
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Correo electrónico inválido');
        }
        if (!preg_match('/^[a-zA-Z0-9]+$/', $usuario)) {
            throw new Exception('Nombre de usuario inválido');
        }
        if (strlen($clave) < 8) {
            throw new Exception('Contraseña demasiado corta');
        }
        try {
            $stmt = $this->_db->prepare("INSERT INTO estudiantes(id_escuela, primer_nombre,  segundo_nombre, primer_apellido, segundo_apellido, edad, fecha_nacimiento, sexo, direccion,  telefono, email, nombre_tutor, telefono_tutor, estado, imagen, usuario, clave) VALUES (:idEscuela, :pNombre, :sNombre, :pApellido, :sApellido, :edad, :nacimiento, :sexo, :direccion, :telefono, :email,  :tutor, :tutorTel, :estado, :imagen,  :usuario, :clave
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
                'imagen' => $imagen,
                'usuario' => $usuario,
                'clave' => $clave
            ));
            //Hash de la clave
            $hash = password_hash($clave, PASSWORD_DEFAULT);
            $stmt = $this->_db->prepare("INSERT INTO usuarios (usuario, clave, rol) VALUES  (:usuario, :hash, 'estudiante')");
            $stmt->execute(array('usuario' => $usuario, 'hash' => $hash));
        } catch (PDOException $e) {
            echo "Error al agregar estudiante: " . $e->getMessage();
            return false;
        }
    }

    //AGREGAR Estudiantes sin Fotos
    public function agregarEstudianteNoFoto(
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
        $usuario,
        $clave
    ) {
        try {
            $stmt = $this->_db->prepare("INSERT INTO estudiantes(id_escuela, primer_nombre,  segundo_nombre, primer_apellido, segundo_apellido, edad, fecha_nacimiento, sexo, direccion,  telefono, email, nombre_tutor, telefono_tutor, estado, usuario, clave) VALUES (:idEscuela, :pNombre, :sNombre, :pApellido, :sApellido, :edad, :nacimiento, :sexo, :direccion, :telefono, :email,  :tutor, :tutorTel, :estado,  :usuario, :clave
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
                'usuario' => $usuario,
                'clave' => $clave
            ));
            //Hash de la clave
            $hash = password_hash($clave, PASSWORD_DEFAULT);
            $stmt = $this->_db->prepare("INSERT INTO usuarios (usuario, clave, rol) VALUES  (:usuario, :hash, 'estudiante')");
            $stmt->execute(array('usuario' => $usuario, 'hash' => $hash));
        } catch (PDOException $e) {
            echo "Error al agregar estudiante: " . $e->getMessage();
            return false;
        }
    }

    //EDITAR Estudiantes
    public function editarEstudianteFoto(
        $idEstudiante,
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
                id_escuela = :idEscuelaUp, 
                primer_nombre = :pNombreUp, 
                segundo_nombre = :sNombreUp, 
                primer_apellido = :pApellidoUp, 
                segundo_apellido = :sApellidoUp, 
                edad = :edadUp, 
                fecha_nacimiento = :nacimientoUp, 
                sexo = :sexoUp, 
                direccion = :direccionUp, 
                telefono = :telefonoUp, 
                email = :emailUp, 
                nombre_tutor = :tutorUp, 
                telefono_tutor = :tutorTelUp, 
                estado = :estadoUp, 
                imagen = :imagenUp 
            WHERE id_estudiante = :idEstudiante");
            $stmt->execute(array(
                'idEstudiante' => $idEstudiante,
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

    public function editarEstudianteNoFoto(
        $idEstudiante,
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
        $estadoUp
    ) {
        try {
            $stmt = $this->_db->prepare("UPDATE estudiantes SET 
                id_escuela = :idEscuelaUp, 
                primer_nombre = :pNombreUp, 
                segundo_nombre = :sNombreUp, 
                primer_apellido = :pApellidoUp, 
                segundo_apellido = :sApellidoUp, 
                edad = :edadUp, 
                fecha_nacimiento = :nacimientoUp, 
                sexo = :sexoUp, 
                direccion = :direccionUp, 
                telefono = :telefonoUp, 
                email = :emailUp, 
                nombre_tutor = :tutorUp, 
                telefono_tutor = :tutorTelUp, 
                estado = :estadoUp 
            WHERE id_estudiante = :idEstudiante");
            $stmt->execute(array(
                'idEstudiante' => $idEstudiante,
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
                'estadoUp' => $estadoUp
            ));
        } catch (PDOException $e) {
            echo "Error al editar estudiante: " . $e->getMessage();
            return false;
        }
    }

    //ELIMINAR Estudiantes
    public function borrarEstudiante($idEstudianteDel)
    {
        try {
            $stmt = $this->_db->prepare("DELETE FROM estudiantes WHERE id_estudiante=:idEstudianteDel");
            $stmt->execute(array('idEstudianteDel' => $idEstudianteDel));
        } catch (PDOException $e) {
            echo "Error al eliminar estudiante: " . $e->getMessage();
            return false;
        }
    }
}