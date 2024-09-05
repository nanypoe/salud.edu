<?php
    class materiaController extends Controller{
        private $_mater;

        function __construct()
        {
            parent::__construct();
            $this->_mater=$this->loadModel('materia');
        }

/*Función para RENDERIZAR la Vista REGISTRO Y LISTADO DE MATERIAS*/
        public function index()
        {
            $this->_view->tabla=$this->vermateria();
            $this->_view->renderizar('materia');
        }

        /*Función para VISUALIZAR las MATERIAS en la DataTable*/
        public function verMateria(){
            $fila=$this->_mater->obtenerMateria();
            $tabla='';
            for($i=0;$i<count($fila);$i++){
                $datos=json_encode($fila[$i]);
                $tabla.='
                <tr>
                    <td>'.$fila[$i]['id_materia'].'</td>
                    <td>'.$fila[$i]['nombre_grupo'].'</td>
                    <td>'.$fila[$i]['maestros.nombre'].' '.$fila[$i]['apellido'].'</td>
                    <td>'.$fila[$i]['nombre_materia'].'</td>
                    
                    <td>
                    <button data-materias=\''.$datos.'\'  data-bs-toggle="modal" data-bs-target="#modalEditarMateria" type="button" style="color:white;font-weight:bold" class="btn btn-warning btnEditarMateria"><i class="fa-solid fa-rotate-right"></i> Actualizar</button>  
                    <button data-id='.$fila[$i]['id_materia'].' type="button" style="color:white;font-weight:bold" class="btn btn-danger BtnBorrarMateria"><i class="fa-solid fa-trash"></i> Borrar</button> 
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