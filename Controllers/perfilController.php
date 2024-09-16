<?php
class perfilController extends Controller
{
    private $_perf;

    // function __construct()
    // {
    //     parent::__construct();
    //     $this->_perf = $this->loadModel('perfil');
    // }


    /*Función para RENDERIZAR la Vista PERFIL DEL ESTUDIANTE*/
    public function index()
    {
        $this->_view->renderizar('perfil');
    }

}

?>