<?php
    class grupoController extends Controller{
        private $_grup;

        function __construct()
        {
            parent::__construct();
            $this->_grup=$this->loadModel('grupo');
        } 

        public function verGrupo(){
            $fila=$this->_grup->obtenerGrupo();
            $tabla='';
            for($i=0;$i<count($fila);$i++){
                $datos=json_encode($fila[$i]);
                $tabla.='
                <tr>
                    <td>'.$fila[$i]['id_grupo'].'</td>
                    <td>'.$fila[$i]['grado'].'</td>
                    <td>'.$fila[$i]['seccion'].'</td>
                    <td>'.$fila[$i]['turno'].'</td>
                    <td>'.$fila[$i]['modalidad'].'</td>
                    <td>'.$fila[$i]['axo'].'</td>
                    <td>
                    <button data-grupo=\''.$datos.'\'  data-bs-toggle="modal" data-bs-target="#modalEditarEscuela" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarEscuela"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
        <button data-id='.$fila[$i]['id_escuela'].' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarEscuela"><i class="fa-solid fa-trash"></i> Borrar</button> 

                    </td>
                </tr>
                ';
            }
            return $tabla;

        }

        public function index()
        {
            $this->_view->tabla=$this->verGrupo(); 
            $this->_view->renderizar('grupo');
            
        }

        public function agregarGrupo(){
            $this->_escue->agregarGru($this->getTexto('nombreEscuela'),$this->getTexto('direccionEscuela'),$this->getTexto('telefonoEscuela'),$this->getTexto('longitudEscuela'),$this->getTexto('latitudEscuela'));

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