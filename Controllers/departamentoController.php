<?php
    class departamentoController extends Controller{
        private $_depart;

        function __construct()
        {
            parent::__construct();
            $this->_depart=$this->loadModel('departamento');
        } 

        public function verDepartamento(){
            $fila=$this->_depart->obtenerDepartamento();
            $tabla='';
            for($i=0;$i<count($fila);$i++){
                $datos=json_encode($fila[$i]);
                $tabla.='
                <tr>
                    <td>'.$fila[$i]['id_departamento'].'</td>
                    <td>'.$fila[$i]['nombre_departamento'].'</td>
                    <td>
                    <button data-departamento=\''.$datos.'\'  data-bs-toggle="modal" data-bs-target="#modalEditarEscuela" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarEscuela"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
        <button data-id='.$fila[$i]['id_departamento'].' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarEscuela"><i class="fa-solid fa-trash"></i> Borrar</button> 

                    </td>
                </tr>
                ';
            }
            return $tabla;

        }

        public function index()
        {
            $this->_view->tabla=$this->verDepartamento();
            $this->_view->renderizar('departamento');
            
        }

        public function agregarDepartamento(){
            $this->_depart->agregarDep($this->getTexto('nombreDepartamento'));

            echo $this->verDepartamento();

        }

        public function editarEscuela(){
            $this->_escue->editarEscue($this->getTexto('id_departamento'),$this->getTexto('nombre'));

            echo $this->verEscuela();

        }

        public function borrarEscuela(){
            $this->_escue->borrarEscue($this->getTexto('id_escuela'));
            echo $this->verEscuela();
        }





    }



?>