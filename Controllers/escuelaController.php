<?php
    class escuelaController extends Controller{
        private $_escue;

        function __construct()
        {
            parent::__construct();
            $this->_escue=$this->loadModel('escuela');
        } 

        public function verEscuela(){
            $fila=$this->_escue->obtenerEscuela();
            $tabla='';
            for($i=0;$i<count($fila);$i++){
                $datos=json_encode($fila[$i]);
                $tabla.='
                <tr>
                    <td>'.$fila[$i]['id_escuela'].'</td>
                    <td>'.$fila[$i]['nombre'].'</td>
                    <td>'.$fila[$i]['direccion'].'</td>
                    <td>'.$fila[$i]['telefono'].'</td>
                    <td>'.$fila[$i]['longitud'].'</td>
                    <td>'.$fila[$i]['latitud'].'</td>
                    <td>
                    <button data-escuela=\''.$datos.'\'  data-bs-toggle="modal" data-bs-target="#modalEditarEscuela" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarEscuela"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
        <button data-id='.$fila[$i]['id_escuela'].' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarEscuela"><i class="fa-solid fa-trash"></i> Borrar</button> 

                    </td>
                </tr>
                ';
            }
            return $tabla;

        }

        public function index()
        {
            $this->_view->tabla=$this->verEscuela();
            $this->_view->renderizar('escuela');
            
        }

        public function agregarEscuela(){
            $this->_escue->agregarEsc($this->getTexto('nombreEscuela'),$this->getTexto('direccionEscuela'),$this->getTexto('telefonoEscuela'),$this->getTexto('longitudEscuela'),$this->getTexto('latitudEscuela'));

            echo $this->verEscuela();

        }

        public function editarEscuela(){
            $this->_escue->editarEscue($this->getTexto('id_escuela'),$this->getTexto('nombre'),$this->getTexto('direccion'),$this->getTexto('telefono'),$this->getTexto('longitud'),$this->getTexto('latitud'));

            echo $this->verEscuela();

        }

        public function borrarEscuela(){
            $this->_escue->borrarEscue($this->getTexto('id_escuela'));
            echo $this->verEscuela();
        }





    }



?>