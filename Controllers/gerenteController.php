<?php
    class gerenteController extends Controller{
        private $_geren;

        function __construct()
        {
            parent::__construct();
            $this->_geren=$this->loadModel('gerente');
        } 

        public function verGerente(){
            $fila=$this->_geren->obtenerGerente();
            $tabla='';
            for($i=0;$i<count($fila);$i++){
                $datos=json_encode($fila[$i]);
                $tabla.='
                <tr>
                    <td>'.$fila[$i]['id'].'</td>
                    <td>'.$fila[$i]['nombre'].'</td>
                    <td>'.$fila[$i]['fecha_nacimiento'].'</td>
                    <td>'.$fila[$i]['sexo'].'</td>
                    <td>'.$fila[$i]['direccion'].'</td>
                    <td>'.$fila[$i]['telefono'].'</td>
                    <td>'.$fila[$i]['email'].'</td>
                    <td>'.$fila[$i]['contacto_emergencia'].'</td>
                    <td>'.$fila[$i]['telefono_emergencia'].'</td>
                    <td>'.$fila[$i]['edad'].'</td>
                    <td>'.$fila[$i]['cedula'].'</td>
                    <td>'.$fila[$i]['usuario'].'</td>
                    <td>'.$fila[$i]['clave'].'</td>
                    

                    <td>
                    <button data-gerente=\''.$datos.'\'  data-bs-toggle="modal" data-bs-target="#modalEditarAlumno" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarAlumno"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
        <button data-id='.$fila[$i]['id'].' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarAlumno"><i class="fa-solid fa-trash"></i> Borrar</button> 

                    </td>
                </tr>
                ';
            }
            return $tabla;

        }

        public function index()
        {
            $this->_view->tabla=$this->verGerente();
            $this->_view->renderizar('gerente');
            
        }

        public function agregarAlumno(){
            $this->_alum->agregarAlum($this->getTexto('nombre'),$this->getTexto('sexo'),$this->getTexto('telefono'),$this->getTexto('ciudad'));

            echo $this->verAlumnos();

        }

        public function editarAlumno(){
            $this->_alum->editarAlum($this->getTexto('id'),$this->getTexto('nombre'),$this->getTexto('sexo'),$this->getTexto('telefono'),$this->getTexto('ciudad'));

            echo $this->verAlumnos();

        }

        public function borrarAlumno(){
            $this->_alum->borrarAlum($this->getTexto('id'));
            echo $this->verAlumnos();
        }





    }



?>