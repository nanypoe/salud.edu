<?php

class IndexController extends Controller {
    private $_index;

    function __construct() {
        parent::__construct();
        $this->_index=$this->loadModel('index');

    }

    public function obtenerUbicaciones(){
        $fila=$this->_index->obtenerUbi();
        for($i=0;$i<count($fila);$i++){
            $datos=json_encode($fila); 
        }
        return $datos;
    }

    public function index() {

        $this->_view->datos=$this->obtenerUbicaciones();


        $this->_view->renderizar("index");
    }

}

?>