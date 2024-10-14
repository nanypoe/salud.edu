CREATE DATABASE saludedu;

USE saludedu;


-- Tabla USUARIOS

CREATE TABLE usuarios(

    id_usuario INT AUTO_INCREMENT,

    usuario VARCHAR (45) NOT NULL,

    clave VARCHAR (255) NOT NULL,

    rol VARCHAR (255) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id_usuario),

    UNIQUE KEY (usuario),

    UNIQUE KEY (clave)

)ENGINE=InnoDB;


-- Tabla DEPARTAMENTOS

CREATE TABLE departamentos (

    id_departamento INT AUTO_INCREMENT,

    nombre_departamento VARCHAR (255) NOT NULL,

    PRIMARY KEY (id_departamento)

)ENGINE=InnoDB;


-- Tabla AÑO LECTIVO

CREATE TABLE axo_lectivo(

    id_lectivo INT AUTO_INCREMENT,

    axo INT NOT NULL,

    PRIMARY KEY (id_lectivo)

)ENGINE=InnoDB;


-- Tabla MUNICIPIOS

CREATE TABLE municipios (

    id_municipio INT AUTO_INCREMENT,

    id_departamento INT NOT NULL,

    nombre_municipio VARCHAR (255) NOT NULL,

    PRIMARY KEY (id_municipio),

    FOREIGN KEY (id_departamento) REFERENCES departamentos(id_departamento) ON DELETE CASCADE

)ENGINE=InnoDB;


-- Tabla ESCUELAS

CREATE TABLE escuelas (

    id_escuela INT AUTO_INCREMENT,

    id_municipio INT NOT NULL,

    id_lectivo INT NOT NULL,

    nombre VARCHAR(255) NOT NULL,

    direccion VARCHAR(255),

    telefono VARCHAR(50),

    longitud DOUBLE,

    latitud DOUBLE,

    PRIMARY KEY (id_escuela),

    FOREIGN KEY (id_lectivo) REFERENCES axo_lectivo (id_lectivo) ON DELETE CASCADE,

    FOREIGN KEY (id_municipio) REFERENCES municipios (id_municipio) ON DELETE CASCADE

)ENGINE=InnoDB;


-- Tabla DOCENTES

CREATE TABLE docentes (

    id_docente INT AUTO_INCREMENT,

    id_escuela INT NOT NULL,

    nombre VARCHAR(255) NOT NULL,

    apellido VARCHAR(255) NOT NULL,

    email VARCHAR(100) NOT NULL,

    telefono VARCHAR(50),

    usuario VARCHAR(50) NOT NULL,

    PRIMARY KEY (id_docente),

    UNIQUE KEY (email),

    UNIQUE KEY (usuario),

    FOREIGN KEY (id_escuela) REFERENCES escuelas(id_escuela) ON DELETE CASCADE

)ENGINE=InnoDB;


-- Tabla GRUPOS

CREATE TABLE grupos (

    id_grupo INT AUTO_INCREMENT,

    lectivo_id INT NOT NULL,

    docente_id INT NOT NULL,

    axo_grupo VARCHAR(15) NOT NULL,

    nombre_grupo VARCHAR(50) NOT NULL,

    modalidad ENUM ("Matutino", "Vespertino", "Nocturno", "Sabatino", "Dominical") NOT NULL,

    PRIMARY KEY (id_grupo),

    FOREIGN KEY (lectivo_id) REFERENCES axo_lectivo (id_lectivo) ON DELETE CASCADE,

    FOREIGN KEY (docente_id) REFERENCES docentes (id_docente) ON DELETE CASCADE

) ENGINE=InnoDB;


-- Tabla MATERIA

CREATE TABLE materias (

    id_materia INT AUTO_INCREMENT,

    id_grupo INT NOT NULL,

    nombre_materia VARCHAR (45) NOT NULL,

    PRIMARY KEY (id_materia),

    FOREIGN KEY (id_grupo) REFERENCES grupos (id_grupo) ON DELETE CASCADE

)ENGINE=InnoDB;


-- Tabla ESTUDIANTES

CREATE TABLE estudiantes (

    id_estudiante INT AUTO_INCREMENT,

    id_escuela INT NOT NULL,

    primer_nombre VARCHAR(50) NOT NULL,

    segundo_nombre VARCHAR(50),

    primer_apellido VARCHAR(50) NOT NULL,

    segundo_apellido VARCHAR(50),

    edad INT NOT NULL,

    fecha_nacimiento DATE NOT NULL,

    sexo ENUM('Masculino', 'Femenino') NOT NULL,

    direccion VARCHAR(255),

    telefono VARCHAR(50),

    email VARCHAR(100) NOT NULL,

    nombre_tutor VARCHAR(255),

    telefono_tutor VARCHAR(50),

    imagen VARCHAR(50),

    estado ENUM('Activo', 'Inactivo') NOT NULL,

    usuario VARCHAR(50) NOT NULL,

    clave VARCHAR (50) NOT NULL,

    PRIMARY KEY (id_estudiante),

    UNIQUE KEY (email),

    UNIQUE KEY (usuario),

    FOREIGN KEY (id_escuela) REFERENCES escuelas (id_escuela) ON DELETE CASCADE,

    CHECK (edad BETWEEN 0 AND 100)

) ENGINE=InnoDB;


-- Tabla Matrícula

CREATE TABLE  matricula (

    id_matricula INT AUTO_INCREMENT,

    id_grupo INT NOT NULL,

    id_estudiante INT NOT NULL,

    PRIMARY KEY (id_matricula),

    FOREIGN KEY  (id_grupo) REFERENCES grupos (id_grupo) ON DELETE CASCADE,

    FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id_estudiante) ON DELETE CASCADE

)ENGINE=InnoDB;


-- Tabla para los Datos de SALUD del ESTUDIANTE

CREATE TABLE salud_estudiante (

    id_estudiante INT NOT NULL,

    peso FLOAT,

    altura FLOAT,

    imc FLOAT,

    categoria_peso VARCHAR(255),

    condicion_medica VARCHAR (255),

    descripcion TEXT,

    medicacion TEXT,

    somatotipo VARCHAR (255),

    PRIMARY KEY (id_estudiante),

    FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id_estudiante) ON DELETE CASCADE

) ENGINE=InnoDB;


CREATE TABLE historial_salud (

    id_estudiante INT NOT NULL,

    fecha_realizacion DATE NOT NULL,

    peso FLOAT,

    altura FLOAT,

    imc FLOAT,

    categoria_peso VARCHAR(255),

    PRIMARY KEY (id_estudiante, fecha_realizacion),

    FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id_estudiante) ON DELETE CASCADE

) ENGINE=InnoDB;


DELIMITER //


CREATE TRIGGER before_update_salud_estudiante

BEFORE UPDATE ON salud_estudiante

FOR EACH ROW

BEGIN

    INSERT INTO historial_salud (id_estudiante, fecha_realizacion, peso, altura, imc, categoria_peso)

    VALUES (OLD.id_estudiante, CURDATE(), OLD.peso, OLD.altura, OLD.imc, OLD.categoria_peso);

END;


//


DELIMITER ;


-- Tabla de PRUEBAS FÍSICO-MOTRICES

CREATE TABLE pruebas_fisicas (

    id_prueba INT AUTO_INCREMENT,

    id_estudiante INT NOT NULL,

    fecha_prueba DATE NOT NULL, 

    tipo_prueba VARCHAR(75) NOT NULL,

    resultado FLOAT,

    unidad_medida VARCHAR(20),

    observaciones TEXT,

    PRIMARY KEY (id_prueba),

    FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id_estudiante) ON DELETE CASCADE

) ENGINE=InnoDB;


CREATE TABLE historial_pruebas (

    id_estudiante INT NOT NULL,

    fecha_prueba DATE NOT NULL,

    tipo_prueba VARCHAR(75) NOT NULL,

    resultado FLOAT,

    unidad_medida VARCHAR(20),

    observaciones TEXT,

    PRIMARY KEY (id_estudiante, fecha_prueba),

    FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id_estudiante) ON DELETE CASCADE

) ENGINE=InnoDB;


-- Tabla para asignar ESTUDIANTES a un GRUPO

CREATE TABLE asignacion_estudiantes (

    id_asignacion INT AUTO_INCREMENT,

    id_estudiante INT NOT NULL,

    id_grupo INT NOT NULL,

    fecha_asignacion DATE NOT NULL,

    PRIMARY KEY (id_asignacion),

    FOREIGN KEY (id_estudiante) REFERENCES estudiantes(id_estudiante) ON DELETE CASCADE,

    FOREIGN KEY (id_grupo) REFERENCES grupos(id_grupo) ON DELETE CASCADE

) ENGINE=InnoDB;


-- Tabla de EVENTOS Deportivos y otros

CREATE TABLE eventos_deportivos (

    id_evento INT AUTO_INCREMENT,

    nombre_evento VARCHAR(255) NOT NULL,

    fecha_evento DATE NOT NULL,

    duracion TIME,  -- Se puede cambiar a DECIMAL o INT si se prefiere en horas

    direccion VARCHAR(255),

    latitud DOUBLE,

    longitud DOUBLE,

    descripcion TEXT,

    PRIMARY KEY (id_evento)

) ENGINE=InnoDB;


-- Tabla de CATEGORÍAS

CREATE TABLE categorias (

    id_categoria INT AUTO_INCREMENT,

    nombre_categoria VARCHAR(255) NOT NULL,

    PRIMARY KEY (id_categoria)

) ENGINE=InnoDB;


-- Tabla de EJERCICIOS

CREATE TABLE ejercicios (

    id_ejercicio INT AUTO_INCREMENT,

    nombre_ejercicio VARCHAR(255) NOT NULL,

    descripcion TEXT,

    id_categoria INT NOT NULL,

    duracion_estimada INT,  -- En minutos o segundos, según prefiera

    PRIMARY KEY (id_ejercicio),

    FOREIGN KEY (id_categoria) REFERENCES categorias (id_categoria) ON DELETE CASCADE

) ENGINE=InnoDB;


-- Tabla de PLANES - EJERCICIO

CREATE TABLE ejercicios_plan (

    id_plan INT AUTO_INCREMENT,

    id_ejercicio INT NOT NULL,

    repeticiones INT,

    series INT,

    PRIMARY KEY (id_plan),

    FOREIGN KEY (id_ejercicio) REFERENCES ejercicios(id_ejercicio) ON DELETE CASCADE

) ENGINE=InnoDB;

-- Procedimiento de Almacenado para agregar MUNICIPIO a los DEPARTAMENTOS
 DELIMITER //
CREATE PROCEDURE ingresarMunicipios(
    IN deptoNombre VARCHAR(50),
    IN municipio VARCHAR(255)
)
BEGIN
    DECLARE deptoId INT;

    -- Obtener el id del departamento basado en su nombre
    SELECT id_departamento INTO deptoId
    FROM departamentos
    WHERE nombre_departamento = deptoNombre;
    
    -- Inserta los municipios, si el departamento existe
    IF deptoId IS NOT NULL THEN
        INSERT INTO municipios (id_departamento, nombre_municipio) VALUES (deptoId, municipio);
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Departamento no encontrado';
    END IF;
END //
DELIMITER ;