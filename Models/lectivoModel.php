<?php

class lectivoModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    /*Función para OBTENER datos de AÑO Lectivo para la Vista*/
    public function obtenerLectivo()
    {
        return $this->_db->query("SELECT * FROM axo_lectivo")->fetchAll();
    }

    /*Función para AGREGAR AÑO Lectivo*/
    public function agregarLectivo($nombreLectivo)
    {
        $this->_db->prepare("INSERT INTO axo_lectivo (axo) VALUES (:nombreLectivo);")->execute(array('nombreLectivo' => $nombreLectivo));
    }

    /*Función para EDITAR AÑO Lectivo */
    public function editarLectivo ($axoUp, $idLectivo)
    {
        $this->_db->prepare("UPDATE axo_lectivo set axo=:axoUp where id_lectivo=:idLectivo")->execute(array('axoUp'=>$axoUp, 'idLectivo'=>$idLectivo));
    }

    //Función para BORRAR Año Lectivo
    public function borrarLectivo($idLectivoDel)
    {
        $this->_db->prepare('DELETE FROM axo_lectivo WHERE id_lectivo=:idLectivoDel')->execute(array('idLectivoDel' => $idLectivoDel));
    }
}
?>