<?php

class errorController extends Controller{

    function __construct(){
        parent::__construct();
    }

    public function index(){

       
        
    }

    public function error($num){
        if($num=='505')
            $mensaje='<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
  <div class="d-flex flex-column justify-content-between">
    <div class="row justify-content-center mt-5">
      <div class="text-center page-404">
        <h1 class="error-title">505</h1>
        <p class="pt-4 pb-5 error-subtitle">No tienes priveligios sufientes para acceder.</p>
        <a href="'.BASE_URL.'index'.'" class="btn btn-primary btn-pill">Back to Home</a>
      </div>
    </div>
  </div>
</div>';
        else if($num=='504')
        $mensaje='<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
  <div class="d-flex flex-column justify-content-between">
    <div class="row justify-content-center mt-5">
      <div class="text-center page-404">
        <h1 class="error-title">505</h1>
        <p class="pt-4 pb-5 error-subtitle">No a ingresado al sistema.</p>
        <a href="'.BASE_URL.'index'.'" class="btn btn-primary btn-pill">Ingresar</a>
      </div>
    </div>
  </div>
</div>';

       

        $this->_view->error=$mensaje;
        $this->_view->renderizar('error');
        
    }

}