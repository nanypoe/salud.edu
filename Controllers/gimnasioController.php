<?php
    class gimnasioController extends Controller{
        private $_gym;

        function __construct()
        {
            parent::__construct();
            $this->_gym=$this->loadModel('gimnasio');
        } 

        public function verGym(){
            $fila=$this->_gym->obtenerGym();
            $tabla='';
            for($i=0;$i<count($fila);$i++){
                $datos=json_encode($fila[$i]);
                $tabla.='
                <tr>
                    <td>'.$fila[$i]['id'].'</td>
                    <td>'.$fila[$i]['nombre'].'</td>
                    <td>'.$fila[$i]['direccion'].'</td>
                    <td>'.$fila[$i]['telefono'].'</td>
                    <td>'.$fila[$i]['latitud'].'</td>
                    <td>'.$fila[$i]['longitud'].'</td>
                    <td>'.$fila[$i]['hora_apertura'].'</td>
                    <td>'.$fila[$i]['hora_cierre'].'</td>
                    <td>'.$fila[$i]['imagen'].'</td>
                    <td>'.$fila[$i]['gerente_id'].'</td>
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
            $this->_view->tabla=$this->verGym();
            /* Cargando los dueños para mostrarlos en la vista */
            $fila=$this->_gym->obteneDuexo();
            $datos='<option value="0">Seleccione Dueño</option>';

            for($i=0;$i<count($fila);$i++){
            $datos.='<option value="'.$fila[$i]['id'].'">'.$fila[$i]['nombre'] .'</option>';
            }
            
            $this->_view->duexo=$datos;

            $this->_view->renderizar('gimnasio');
            
        }

        public function agregarGym(){

            function upload_image()
            {
                if(isset($_FILES["imagen"]))
                {
                 $extension = explode('.', $_FILES['imagen']['name']);
                 $new_name = rand() . '.' . $extension[1];
                 $destination = './Views/plantilla/images/' . $new_name;
                 move_uploaded_file($_FILES['imagen']['tmp_name'], $destination);
                 return $new_name;
                }
            }
               $image = '';
               if($_FILES["imagen"]["name"] != '')
                 { 
                  $image = upload_image();
                $this->_gym->insertarGym($this->getTexto('duexo'),$this->getTexto('nombre'),$this->getTexto('latitud'),$this->getTexto('longitud'),$this->getTexto('horaAbre'),$this->getTexto('horaCierra'),$this->getTexto('telefono'),$this->getTexto('direccion'),$image);
                echo $this->verGym();
                }
              else{
                $this->_gym->insertarGym2($this->getTexto('duexo'),$this->getTexto('nombre'),$this->getTexto('latitud'),$this->getTexto('longitud'),$this->getTexto('horaAbre'),$this->getTexto('horaCierra'),$this->getTexto('telefono'),$this->getTexto('direccion'));
                echo $this->verGym();
                }
        

            
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