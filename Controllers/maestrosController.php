<?php
    class maestrosController extends Controller{
        private $_maes;

        function __construct()
        {
            parent::__construct();
            $this->_maes=$this->loadModel('maestros');
        } 

        public function verMaestro(){
            $fila=$this->_maes->obtenerMaestro();
            $tabla='';
            for($i=0;$i<count($fila);$i++){
                $datos=json_encode($fila[$i]);
                $tabla.='
                <tr>
                    <td>'.$fila[$i]['id'].'</td>
                    <td>'.$fila[$i]['nombre'].'</td>
                    <td>'.$fila[$i]['apellido'].'</td>
                    <td>'.$fila[$i]['email'].'</td>
                    <td>'.$fila[$i]['telefono'].'</td>
                    <td>'.$fila[$i]['perfil'].'</td>
                    

                    <td>
                    <button data-Maestro=\''.$datos.'\'  data-bs-toggle="modal" data-bs-target="#modalEditarMaestro" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarAlumno"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
        <button data-id='.$fila[$i]['id'].' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarAlumno"><i class="fa-solid fa-trash"></i> Borrar</button> 

                    </td>
                </tr>
                ';
            }
            return $tabla;

        }

        public function index()
        {
            /* mandando a la vista los datos de las escuelas */
            $fila=$this->_maes->obtenerEscuela();
            $datos='<option value="0"> Seleccione una escuela</option>';
            for($i=0;$i<count($fila);$i++){
                $datos.='<option value="'.$fila[$i]['id_escuela'].'">'.$fila[$i]['nombre'].'</option>';
            }

            $this->_view->escuelas=$datos; 
 

            $this->_view->tabla=$this->verMaestro();
            $this->_view->renderizar('maestros');
            
        }

        public function agregarMaestros(){
            $this->_maes->agregarMaes($this->getTexto('nombre'),$this->getTexto('apellido'),$this->getTexto('correo'),$this->getTexto('telefono'),$this->getTexto('perfil'),$this->getTexto('id'));

            echo $this->obtenerMaestro();

        }

        public function editarAlumno(){
            $this->_maes->editarAlum($this->getTexto('id'),$this->getTexto('nombre'),$this->getTexto('sexo'),$this->getTexto('telefono'),$this->getTexto('ciudad'));

            echo $this->verAlumnos();

        }

        public function borrarAlumno(){
            $this->_maes->borrarAlum($this->getTexto('id'));
            echo $this->verAlumnos();
        }





    }



?>