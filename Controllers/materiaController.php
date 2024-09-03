<?php
    class materiaController extends Controller{
        private $_mater;

        function __construct()
        {
            parent::__construct();
            $this->_mater=$this->loadModel('materia');
        } 

        public function index()
        {
            $this->_view->tabla=$this->vermateria();
            $this->_view->renderizar('materia');
            
        }

        public function verMateria(){
            $fila=$this->_mater->obtenerMateria();
            $tabla='';
            for($i=0;$i<count($fila);$i++){
                $datos=json_encode($fila[$i]);
                $tabla.='
                <tr>
                    <td>'.$fila[$i][''].'</td>
                    <td>'.$fila[$i][''].'</td>
                    <td>'.$fila[$i][''].'</td>
                    <td>'.$fila[$i][''].'</td>
                    <td>'.$fila[$i][''].'</td>
                    <td>'.$fila[$i][''].'</td>
                    <td>
                    <button data-grupos=\''.$datos.'\'  data-bs-toggle="modal" data-bs-target="#modalEditarMateria" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarEscuela"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
        <button data-id='.$fila[$i]['id_escuela'].' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarEscuela"><i class="fa-solid fa-trash"></i> Borrar</button> 

                    </td>
                </tr>
                ';
            }
            return $tabla;
        }

        

        /* public function agregarEscuela(){
            $this->_escue->agregarEsc($this->getTexto('nombreEscuela'),$this->getTexto('direccionEscuela'),$this->getTexto('telefonoEscuela'),$this->getTexto('longitudEscuela'),$this->getTexto('latitudEscuela'));

            echo $this->verEscuela();

        }

        public function editarEscuela(){
            $this->_escue->editarEscue($this->getTexto('id_escuela'),$this->getTexto('nombre'),$this->getTexto('direccion'),$this->getTexto('telefono'),$this->getTexto('longitud'),$this->getTexto('latitud'));

            echo $this->verGrupos();

        }

        public function borrarEscuela(){
            $this->_escue->borrarEscue($this->getTexto('id_escuela'));
            echo $this->verEscuela();
        } */

    }
?>