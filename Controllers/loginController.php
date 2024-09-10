<?php
    class loginController extends Controller{
        private $_log;
    
        function __construct(){
            parent::__construct(); 
            $this->_log=$this->loadModel("login");
        }
    
        public function index(){
            if($this->getTexto('validar')==1)
            {
                $datos=$this->_log->obtenerUsuario($this->getTexto('user'));
                if(password_verify($this->getTexto('clave'), $datos["clave"]))
                {
                    Sessiones::setClave('rol', $datos["rol"]);
                    Sessiones::setClave('autenticado', true);
                    Sessiones::setClave('usuario', $datos["usuario"]);
                    Sessiones::setClave('id_usuario',$datos["id_usuario"]);
                    $this->redireccionar('index');
                }
                else
                $this->_view->mensaje=' <div class="alert alert-danger" role="alert">
                <center>  Usuario y/o Clave Incorrecta! </center>
              </div>'; 
            }
            $this->_view->renderizar('login');
        }
    
        public function salir()
        {
            Sessiones::salir();
            $this->redireccionar('index');
        }
    }
?>