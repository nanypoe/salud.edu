<?php

class metricaModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }



    public function obtenerDatosEstudiante($usuario)
    {
        return $this->_db->query("SELECT  * FROM estudiantes INNER JOIN matricula  ON estudiantes.id_estudiante = matricula.id_estudiante 
        INNER JOIN grupos  ON matricula.id_grupo = grupos.id_grupo WHERE usuario='$usuario'")->fetchAll();
    }
 
    public function obtenerDatos($id)
    {
        return $this->_db->query("SELECT 
    e.primer_nombre, 
    e.segundo_nombre,
    e.primer_apellido, 
    e.segundo_apellido,
    pf.fecha_prueba, 
    SUM(pf.resultado) AS total_repeticiones 
FROM 
    pruebas_fisicas pf
JOIN 
    estudiantes e ON pf.id_estudiante = e.id_estudiante
WHERE 
    pf.id_estudiante = '$id' AND 
    pf.tipo_prueba = 'Velocidad' 
GROUP BY 
    pf.fecha_prueba, e.id_estudiante 
ORDER BY 
    pf.fecha_prueba;")->fetchAll();
    }

    public function obtenerSalto($id)
    {
        return $this->_db->query("SELECT 
    e.primer_nombre, 
    e.segundo_nombre,
    e.primer_apellido, 
    e.segundo_apellido,
    pf.fecha_prueba, 
    SUM(pf.resultado) AS total_repeticiones 
FROM 
    pruebas_fisicas pf
JOIN 
    estudiantes e ON pf.id_estudiante = e.id_estudiante
WHERE 
    pf.id_estudiante = '$id' AND 
    pf.tipo_prueba = 'Salto' 
GROUP BY 
    pf.fecha_prueba, e.id_estudiante 
ORDER BY 
    pf.fecha_prueba;")->fetchAll();
    }

    public function obtenerLanzamiento($id)
    {
        return $this->_db->query("SELECT 
    e.primer_nombre, 
    e.segundo_nombre,
    e.primer_apellido, 
    e.segundo_apellido,
    pf.fecha_prueba, 
    SUM(pf.resultado) AS total_repeticiones 
FROM 
    pruebas_fisicas pf
JOIN 
    estudiantes e ON pf.id_estudiante = e.id_estudiante
WHERE 
    pf.id_estudiante = '$id' AND 
    pf.tipo_prueba = 'Lanzamiento' 
GROUP BY 
    pf.fecha_prueba, e.id_estudiante 
ORDER BY 
    pf.fecha_prueba;")->fetchAll();
    }

    public function obtenerFuerza($id)
    {
        return $this->_db->query("SELECT 
    e.primer_nombre, 
    e.segundo_nombre,
    e.primer_apellido, 
    e.segundo_apellido,
    pf.fecha_prueba, 
    SUM(pf.resultado) AS total_repeticiones 
FROM 
    pruebas_fisicas pf
JOIN 
    estudiantes e ON pf.id_estudiante = e.id_estudiante
WHERE 
    pf.id_estudiante = '$id' AND 
    pf.tipo_prueba = 'Fuerza' 
GROUP BY 
    pf.fecha_prueba, e.id_estudiante 
ORDER BY 
    pf.fecha_prueba;")->fetchAll();
    }

    public function obtenerResistencia($id)
    {
        return $this->_db->query("SELECT 
    e.primer_nombre, 
    e.segundo_nombre,
    e.primer_apellido, 
    e.segundo_apellido,
    pf.fecha_prueba, 
    SUM(pf.resultado) AS total_repeticiones 
FROM 
    pruebas_fisicas pf
JOIN 
    estudiantes e ON pf.id_estudiante = e.id_estudiante
WHERE 
    pf.id_estudiante = '$id' AND 
    pf.tipo_prueba = 'Resistencia' 
GROUP BY 
    pf.fecha_prueba, e.id_estudiante 
ORDER BY 
    pf.fecha_prueba;")->fetchAll();
    }

    

    public function obtenerIMC($id)
    {

        return $this->_db->query("SELECT 
    'Actual' AS tipo,
    e.primer_nombre, 
    e.segundo_nombre,
    e.primer_apellido, 
    e.segundo_apellido,
    se.imc
FROM 
    salud_estudiante se
JOIN 
    estudiantes e ON se.id_estudiante = e.id_estudiante
WHERE 
    se.id_estudiante = '$id'

UNION ALL

SELECT 
    'Historial' AS tipo,
    e.primer_nombre, 
    e.segundo_nombre,
    e.primer_apellido, 
    e.segundo_apellido,
    hs.imc
FROM 
    historial_salud hs
JOIN 
    estudiantes e ON hs.id_estudiante = e.id_estudiante
WHERE 
    hs.id_estudiante = '$id';")->fetchAll();
    }



}