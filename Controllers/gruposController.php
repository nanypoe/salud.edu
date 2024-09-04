<?php
    class gruposController extends Controller{
        private $_grupo;

        function __construct()
        {
            parent::__construct();
            $this->_grupo=$this->loadModel('grupos');
        } 

        public function verGrupos(){
            $fila=$this->_grupo->obtenerGrupos();
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
                    <td>'.$fila[$i]['lectivo'].'</td>
                    <td>
                    <button data-grupos=\''.$datos.'\'  data-bs-toggle="modal" data-bs-target="#modalEditarEscuela" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarEscuela"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
        <button data-id='.$fila[$i]['id_grupo'].' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarEscuela"><i class="fa-solid fa-trash"></i> Borrar</button> 

                    </td>
                </tr>
                ';
            }
            return $tabla;
 
        }

        public function index()
        {
            $this->_view->tabla=$this->verGrupos();
            $this->_view->renderizar('grupos');
            
        }

        public function agregarGrupos(){
            $this->_grupo->agregarGru($this->getTexto('gradoGrupos'),$this->getTexto('seccionGrupos'),$this->getTexto('turnoGrupos'),$this->getTexto('modalidadGrupos'),$this->getTexto('lectivoGrupos'));

            echo $this->verGrupos();

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