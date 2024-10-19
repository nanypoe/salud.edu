<?php

class ejercicioModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    // ########## C.R.U.D ###### //
    // LECTURA
    /*Función para OBTENER datos de Ejercicio para la Vista*/
    public function obtenerDatosEjercicio()
    {
        return $this->_db->query("SELECT * FROM ejercicios")->fetchAll();
    }


    // CREACIÓN
    /*Función para AGREGAR Ejercicio*/
    public function agregarEjercicio($ejercicio, $descripcion, $categoria, $duracion)
    {
        $this->_db->prepare("INSERT INTO ejercicios (nombre_ejercicio, 
        descripcion, 
        categoria, 
        duracion_estimada) VALUES (
        :ejercicio,
        :descripcion,
        :categoria,
        :duracion);")->execute(array('ejercicio' => $ejercicio, 'descripcion' => $descripcion, 'categoria' => $categoria, 'duracion' => $duracion));
    }

    // EDICION
    /*Función para EDITAR Ejercicio */
    
    public function editarEjercicio(
        $idEjercicio,
        $ejercicio,
        $descripcion,
        $categoria,
        $duracion    
    ) {
        try {
            // Preparamos la consulta con placeholders
            $stmt = $this->_db->prepare("UPDATE ejercicios SET 
            nombre_ejercicio=:ejercicio,
            descripcion=:descripcion,
            categoria=:categoria,
            duracion_estimada=:duracion
            WHERE
            id_ejercicio=:idEjercicio;
            ");

            // Ejecutamos la consulta con los valores
            $stmt->execute(array(
                'idEjercicio' => $idEjercicio,
                'ejercicio' => $ejercicio,
                'descripcion' => $descripcion,
                'categoria' => $categoria,
                'duracion' => $duracion
            ));

            // Mensaje opcional de éxito
            echo "Ejercicio actualizado con éxito.";
        } catch (PDOException $e) {
            // Capturamos el error y lo mostramos o registramos
            echo "Error al actualizar el Ejercicio: " . $e->getMessage();
            // Alternativamente, puedes registrar el error en un log:
            // registrarError("Error en la base de datos al actualizar ejercicio: " . $e->getMessage());
        }
    }

    //ELIMINACIÓN
    //Función para BORRAR Ejercicio
    public function borrarEjercicio($idEjercicioDel)
    {
        $this->_db->prepare('DELETE FROM ejercicios WHERE id_ejercicio=:idEjercicioDel')->execute(array('idEjercicioDel' => $idEjercicioDel));
    }
}
?>