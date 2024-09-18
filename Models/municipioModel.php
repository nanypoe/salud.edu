<?php

class municipioModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    // ########## C.R.U.D ###### //
    // LECTURA
    /*Función para OBTENER datos de MUNICIPIOS para la Vista*/
    public function obtenerDatosMunicipio()
    {
        return $this->_db->query("SELECT id_municipio, departamentos.nombre_departamento, nombre_municipio FROM municipios INNER JOIN departamentos ON municipios.id_departamento=departamentos.id_departamento")->fetchAll();
    }

    /*Función para Obtener DEPARTAMENTOS en la VISTA de MUNICIPIOS */
    public function obtenerDepartamento()
    {
        return $this->_db->query("SELECT * FROM departamentos")->fetchAll();
    }

    // CREACIÓN
    /*Función para AGREGAR Municipio*/
    public function agregarMunicipio($dptoId, $municipio)
    {
        $this->_db->prepare("INSERT INTO municipios (id_departamento, nombre_municipio) VALUES (:dptoId, :municipio);")->execute(array('dptoId' => $dptoId, 'municipio' => $municipio));
    }

    // EDICION
    /*Función para EDITAR Municipio */
    public function editarMunicipio($muniIdUp, $municipioUp)
    {
        $this->_db->prepare("UPDATE municipios set nombre_municipio=:municipioUp where id_municipio=:muniIdUp")->execute(array('muniIdUp' => $muniIdUp, 'municipioUp' => $municipioUp));
    }

    //ELIMINACIÓN
    //Función para BORRAR Departamentos
    public function borrarMunicipio($idMunicipioDel)
    {
        $this->_db->prepare('DELETE FROM municipios WHERE id_municipio=:idMunicipioDel')->execute(array('idMunicipioDel' => $idMunicipioDel));
    }
}
?>