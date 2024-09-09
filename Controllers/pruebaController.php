<?php
    class pruebaController extends Controller{
        private $_prue;

        function __construct()
        {
            parent::__construct();
            $this->_prue=$this->loadModel('prueba');
        } 

        public function verPrueba(){
            $fila=$this->_prue->obtenerPrueba();
            $tabla='';
            for($i=0;$i<count($fila);$i++){
                $datos=json_encode($fila[$i]);
                $tabla.='
                <tr>
                    <td>'.$fila[$i]['primer_nombre'].' ' .$fila[$i]['segundo_nombre'].' '.$fila[$i]['primer_apellido'].' '.$fila[$i]['segundo_apellido'].'</td>
                    <td>'.$fila[$i]['id_prueba'].'</td>
                    <td>'.$fila[$i]['tipo'].'</td>
                    <td>'.$fila[$i]['unidad'].'</td>
                    <td>'.$fila[$i]['resultado'].'</td>
                    <td>'.$fila[$i]['observacion'].'</td>
                    <td>'.$fila[$i]['fecha'].'</td>
                    
                    <td>
                    <button data-puebras=\''.$datos.'\'  data-bs-toggle="modal" data-bs-target="#modalEditarEscuela" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarEscuela"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
                    <button data-id='.$fila[$i]['id_prueba'].' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarEscuela"><i class="fa-solid fa-trash"></i> Borrar</button> 
                    </td>
                </tr>
                ';
            }
            return $tabla;

        }

        public function index()
        {
             /* mandando a la vista los datos de los estudiantes */
             $fila=$this->_prue->obtenerEstudiante();
             $datos='<option value="0"> Seleccione un estudiante</option>';
             for($i=0;$i<count($fila);$i++){
                 $datos.= '<option value="'.$fila[$i]['id_estudiante'].'">'.$fila[$i]['primer_nombre'].' '.$fila[$i]['segundo_nombre'].' '.$fila[$i]['primer_apellido'].' '.$fila[$i]['segundo_apellido'].'</option>';
             }
             $this->_view->estudiantes=$datos;
            $this->_view->tabla=$this->verPrueba(); 
            $this->_view->renderizar('prueba');
            
        }

        public function agregarPrueba(){
            $this->_prue->agregarPru($this->getTexto('idE'),$this->getTexto('tipoPrueba'),$this->getTexto('resultadoPrueba'),$this->getTexto('unidadPrueba'),$this->getTexto('observacionPrueba'),$this->getTexto('axo'));

            echo $this->verPrueba();

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