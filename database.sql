CREATE DATABASE saludedu;
USE saludedu;

-- Tabla ESCUELAS
CREATE TABLE escuelas (
    id_escuela INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(50),
    longitud DOUBLE,
    latitud DOUBLE
)ENGINE=InnoDB;

-- Tabla Estudiantes
CREATE table estudiantes (
	id_estudiante INT PRIMARY KEY AUTO_INCREMENT,
    id_escuela INT,
    primer_nombre VARCHAR (255),
    segundo_nombre VARCHAR (255),
    primer_apellido VARCHAR (255),
    segundo_apellido VARCHAR (255),
    edad INT,
    fecha_nacimiento DATE,
    sexo ENUM('Masculino', 'Femenino'),
    direccion VARCHAR(255),
    telefono VARCHAR(50),
    email VARCHAR(100),
    nombre_tutor VARCHAR(255),
    telefono_tutor VARCHAR(50),
    imagen VARCHAR (15),
	FOREIGN KEY (id_escuela) REFERENCES escuelas(id_escuela)
)ENGINE=InnoDB;

CREATE TABLE departamentos (
    id_departamento INT PRIMARY KEY AUTO_INCREMENT,
    nombre_departamento VARCHAR (255)
)ENGINE=InnoDB;


CREATE TABLE municipios (
    id_municipios INT PRIMARY KEY AUTO_INCREMENT,
    id_departamento INT,
    nombre_municipio VARCHAR (255),
    FOREIGN KEY (id_departamento) REFERENCES departamentos(id_departamento)
);

--Tabla de Perfil de Salud
CREATE TABLE salud_estudiante (
    id_salud INT PRIMARY KEY,
    id_estudiante INT,
    peso FLOAT,
    altura FLOAT,
    imc FLOAT,
    categoria_peso VARCHAR(255),
    condicion_medica VARCHAR (255),
    descripcion TEXT,
    medicacion TEXT,
    somatotipo VARCHAR (255)
)ENGINE=InnoDB;

--Tabla de Pruebas de Cualidades Físico-motrices
CREATE TABLE puebras_fisicas (
    id_pruebas INT PRIMARY KEY,
    id_estudiante INT,
    tipo_prueba VARCHAR (255),
    resultado VARCHAR (255),
    unidad_medida VARCHAR (255),
    observaciones TEXT,
    fecha_prueba DATE
)ENGINE=InnoDB;

-- -- Tabla MAESTROS
-- CREATE TABLE maestros (
--     id_maestros INT AUTO_INCREMENT PRIMARY KEY,
--     id_escuela INT,
--     nombre VARCHAR(255) NOT NULL,
--     apellido VARCHAR(255) NOT NULL,
--     email VARCHAR(100),
--     telefono VARCHAR(50),
--     perfil VARCHAR(100),
--     FOREIGN KEY (id_escuela) REFERENCES Escuelas(id_escuela) ON DELETE CASCADE
-- );

