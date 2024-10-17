<?php

class escuelaModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    // ########## C.R.U.D ###### //
    //  //  LECTURA
    /*Función para OBTENER datos de ESCUELA para la Vista*/
    public function obtenerDatosEscuela()
    {
        return $this->_db->query("SELECT axo, municipio.nombre_municipio, id_escuela, nombre, direccion, telefono, longitud, latitud FROM escuelas INNER JOIN municipios ON escuelas.id_municipio=municipios.id_municipio INNER JOIN axo_lectivo ON escuelas.id_lectivo=axo_lectivo.id_lectivo")->fetchAll();
    }

    /*Función para Obtener AÑOS LECTIVOS en la VISTA de ESCUELAS*/
    public function obtenerLectivo()
    {
        return $this->_db->query("SELECT * FROM axo_lectivo")->fetchAll();
    }

    /*Función para Obtener DEPARTAMENTOS en la VISTA de ESCUELAS*/
    public function obtenerDepartamento()
    {
        return $this->_db->query("SELECT * FROM departamentos")->fetchAll();
    }

    //Función para obtener MUNICIPIOS en la VISTA de ESCUELAS
    public function obtenerMunicipio($idDepartamento)
    {
        return $this->_db->query("SELECT * FROM municipios WHERE id_departamento='$idDepartamento';")->fetchAll();
    }

    //Función para obtener ESCUELAS en la Vista
    public function obtenerEscuela()
    {
        return $this->_db->query("SELECT * FROM escuelas INNER JOIN municipios ON escuelas.id_municipio=municipios.id_municipio INNER JOIN axo_lectivo ON escuelas.id_lectivo=axo_lectivo.id_lectivo")->fetchAll();
    }

    //  //  CREACIÓN
    /*Función para AGREGAR Escuela*/
    public function agregarEscuela(
        $idLectivo,
        $municEscuela,
        $nombreEscuela,
        $direccionEscuela,
        $telefonoEscuela,
        $longitudEscuela,
        $latitudEscuela
    ) {
        try {
            $stmt = $this->_db->prepare("INSERT INTO escuelas (
                id_lectivo,
                id_municipio,
                nombre,
                direccion,
                telefono,
                longitud,
                latitud
            ) VALUES (
                :idLectivo,
                :municEscuela,
                :nombreEscuela,
                :direccionEscuela,
                :telefonoEscuela,
                :longitudEscuela,
                :latitudEscuela
            )");

            $stmt->execute(array(
                'idLectivo' => $idLectivo,
                'municEscuela' => $municEscuela,
                'nombreEscuela' => $nombreEscuela,
                'direccionEscuela' => $direccionEscuela,
                'telefonoEscuela' => $telefonoEscuela,
                'longitudEscuela' => $longitudEscuela,
                'latitudEscuela' => $latitudEscuela
            ));

        } catch (PDOException $e) {
            // Imprimir o registrar el error
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }

    // // EDICION
/*Función para EDITAR Escuela */
    public function editarEscuela(
        $idEscuela,
        $municEscuelaUp,
        $idAñoLectivoUp,
        $nombreEscuelaUp,
        $direccionEscuelaUp,
        $telefonoEscuelaUp,
        $longitudEscuelaUp,
        $latitudEscuelaUp
    ) {
        try {
            // Preparamos la consulta con placeholders
            $stmt = $this->_db->prepare("UPDATE escuelas SET 
            id_municipio=:id_municipio,
            id_lectivo=:id_lectivo,
            nombre=:nombre,
            direccion=:direccion,
            telefono=:telefono,
            longitud=:longitud,
            latitud=:latitud WHERE
            id_escuela=:id_escuela;
            ");

            // Ejecutamos la consulta con los valores
            $stmt->execute(array(
                'id_escuela' => $idEscuela,
                'id_municipio' => $municEscuelaUp,
                'id_lectivo' => $idAñoLectivoUp,
                'nombre' => $nombreEscuelaUp,
                'direccion' => $direccionEscuelaUp,
                'telefono' => $telefonoEscuelaUp,
                'longitud' => $longitudEscuelaUp,
                'latitud' => $latitudEscuelaUp
            ));

            // Mensaje opcional de éxito
            echo "Escuela actualizada con éxito.";
        } catch (PDOException $e) {
            // Capturamos el error y lo mostramos o registramos
            echo "Error al actualizar la escuela: " . $e->getMessage();
            // Alternativamente, puedes registrar el error en un log:
            // registrarError("Error en la base de datos al actualizar escuela: " . $e->getMessage());
        }
    }

    // //ELIMINACIÓN
    public function borrarEscuela($id)
    {
        $this->_db->prepare("DELETE FROM escuelas WHERE id_escuela=:id;")->execute(array('id' => $id));
    }
}