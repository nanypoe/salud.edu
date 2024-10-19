<?php
class asignacionController extends Controller
{
    private $_ejercicio;

    function __construct()
    {
        parent::__construct();
        // $this->_ejercicio = $this->loadModel('asignacion');
    }

    public function index()
    {
        // $this->_view->grupos = $this->getEstudiantes();
        $this->_view->renderizar('asignacion');
    }



    // // Método para obtener estudiantes por grupo
    // public function getEstudiantesByGrupo()
    // {
    //     $idGrupo = $this->getTexto("grupoId");
    //     $estudiantes = $this->_ejercicio->obtenerEstudiantes($idGrupo);
    //     echo json_encode($estudiantes);
    // }

    // // Método para obtener información de un estudiante por ID
    // public function getEstudianteById()
    // {
    //     $idEstudiante = $this->getTexto("idEstudiante");
    //     $estudiante = $this->_ejercicio->obtenerEstudiantePorId($idEstudiante);
    //     echo json_encode($estudiante);
    // }

    // // Método para asignar ejercicios a un estudiante
    // public function asignarEjercicio()
    // {
    //     $idEstudiante = $this->getTexto('idEstudiante');
    //     $idGrupo = $this->getTexto('idGrupo');
    //     $ejercicio = $this->getTexto('ejercicio');
    //     $planEjercicio = $this->getTexto('planEjercicio');
    //     $duracion = $this->getTexto('duracion');
    //     $frecuencia = $this->getTexto('frecuencia');
    //     $descripcion = $this->getTexto('descripcion');

    //     // Aquí llamamos al modelo para guardar la asignación
    //     $this->_ejercicio->asignarEjercicio(
    //         $idEstudiante,
    //         $idGrupo,
    //         $ejercicio,
    //         $planEjercicio,
    //         $duracion,
    //         $frecuencia,
    //         $descripcion
    //     );

    //     // Retornamos una respuesta de éxito
    // //     echo json_encode(['status' => 'success', 'message' => 'Ejercicio asignado correctamente.']);
    // }

}