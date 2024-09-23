<?php

class docenteModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    // Función para obtener ESCUELAS para la Vista
    public function obtenerEscuela()
    {
        return $this->_db->query("SELECT * FROM escuelas")->fetchAll();
    }

    // Función para obtener DOCENTES en la Vista
    public function obtenerDocente()
    {
        return $this->_db->query("SELECT * FROM docentes")->fetchAll();
    }

    // Función para AGREGAR Docente
    public function agregarDocente(
        $idEscuela,
        $nombreDocente,
        $apellidoDocente,
        $emailDocente,
        $telefonoDocente,
        $usuarioDocente,
        $claveDocente
    ) {
        try {
            // Insertar docente en la tabla docentes
            $stmt = $this->_db->prepare("INSERT INTO docentes (
                id_escuela,
                nombre,
                apellido,
                email,
                telefono
            ) VALUES (
                :idEscuela,
                :nombreDocente,
                :apellidoDocente,
                :emailDocente,
                :telefonoDocente
            )");
            $stmt->execute(array(
                'idEscuela' => $idEscuela,
                'nombreDocente' => $nombreDocente,
                'apellidoDocente' => $apellidoDocente,
                'emailDocente' => $emailDocente,
                'telefonoDocente' => $telefonoDocente
            ));

            // Hash de la contraseña
            $hash = password_hash($claveDocente, PASSWORD_DEFAULT);

            // Insertar usuario en la tabla usuarios
            $stmt = $this->_db->prepare("INSERT INTO usuarios (
                usuario,
                clave,
                rol
            ) VALUES (
                :usuarioDocente,
                :hash,
                'docente'
            )");
            $stmt->execute(array(
                'usuarioDocente' => $usuarioDocente,
                'hash' => $hash
            ));

        } catch (PDOException $e) {
            // Imprimir o registrar el error
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }

    // Función para EDITAR Docente
    public function editarDocente(
        $idDocente,
        $idEscuela,
        $nombre,
        $apellido,
        $email,
        $telefono
        ) {
        try {
            $stmt = $this->_db->prepare("UPDATE docentes SET 
            id_escuela=:idEscuela,
            nombre=:nombre,
            apellido=:apellido,
            email=:email,
            telefono=:telefono
            ;");

            $stmt->execute(array(
                'idEscuela' => $idEscuela,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'email' => $email,
                'telefono' => $telefono
            ));

            // Mensaje opcional de éxito
            echo "Docente actualizado con éxito.";
        } catch (PDOException $e) {
            // Capturamos el error y lo mostramos o registramos
            echo "Error al actualizar el docente: " . $e->getMessage();
            // Alternativamente, puedes registrar el error en un log:
            // registrarError("Error en la base de datos al actualizar docente: " . $e->getMessage());
        }
    }

    // Función para BORRAR Docente
    public function borrarDocente($idDocenteDel)
    {
        $this->_db->prepare('DELETE FROM docentes WHERE id_docente=:idDocenteDel')->execute(array('idDocenteDel' => $idDocenteDel));
    }
}