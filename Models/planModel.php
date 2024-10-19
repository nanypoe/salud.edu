<?php

class planModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    // ########## C.R.U.D ###### //
    // LECTURA
    /*Función para OBTENER datos de Ejercicio para la Vista*/

    public function obtenerEjercicios(){
        return $this->_db->query("SELECT * FROM ejercicios")->fetchAll();
    }

    public function obtenerDatosPlan()
    {
        return $this->_db->query("SELECT * FROM ejercicios_plan")->fetchAll();
    }


    // CREACIÓN
    /*Función para AGREGAR Ejercicio*/
    public function agregarPlan($idEjercicio, $repeticiones, $series)
    {
        $this->_db->prepare("INSERT INTO ejercicios_plan (id_ejercicio, repeticiones, series) VALUES (:idEjercicio, :repeticiones, :series);")->execute(array(
            'idEjercicio' => $idEjercicio,
            'repeticiones' => $repeticiones,
            'series' => $series));
    }

    // EDICION
    /*Función para EDITAR Ejercicio */
    
    public function editarPlan(
        $idPlan,
        $repeticiones,
        $series  
    ) {
        try {
            // Preparamos la consulta con placeholders
            $stmt = $this->_db->prepare("UPDATE ejercicios_plan SET 
            repeticiones=:repeticiones,
            series=:series
            WHERE
            id_plan=:idPlan;
            ");

            // Ejecutamos la consulta con los valores
            $stmt->execute(array(
                'idPlan' => $idPlan,
                'repeticiones' => $repeticiones,
                'series' => $series
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
    public function borrarPlan($idPlan)
    {
        $this->_db->prepare('DELETE FROM ejercicios_plan WHERE id_plan=:idPlan')->execute(array('idPlan' => $idPlan));
    }
}