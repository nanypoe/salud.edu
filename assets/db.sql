CREATE DATABASE GymBro;
USE GymBro;

hola

-- Tabla de credenciales
CREATE TABLE credenciales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL,
    clave VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'gerente', 'empleado', 'entrenador', 'cliente') NOT NULL
);

-- Tabla de gerentes
CREATE TABLE gerentes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(75) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    sexo ENUM('masculino', 'femenino') NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    contacto_emergencia VARCHAR(255) NOT NULL,
    telefono_emergencia VARCHAR(20) NOT NULL,
    edad INT NOT NULL,
    cedula VARCHAR(20) NOT NULL,
    usuario VARCHAR(255),
    clave VARCHAR(255)
)ENGINE=InnoDB;

-- Tabla de local
CREATE TABLE local (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    direccion TEXT NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    longitud DOUBLE NOT NULL,
    latitud DOUBLE NOT NULL,
    hora_apertura TIME NOT NULL,
    hora_cierre TIME NOT NULL,
    imagen VARCHAR(50),
    gerente_id INT,
    FOREIGN KEY (gerente_id) REFERENCES gerentes(id)
)ENGINE=InnoDB;

-- Tabla de eventos
CREATE TABLE eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    encargado VARCHAR (50) NOT NULL,
    foto_encargado VARCHAR (50),
    foto_evento VARCHAR (50),
    descripcion TEXT NOT NULL,
    fecha DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_termina TIME NOT NULL,
    local_id INT,
    FOREIGN KEY (local_id) REFERENCES local(local_id)
)ENGINE=InnoDB;