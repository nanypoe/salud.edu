CREATE DATABASE saludedu;
USE saludedu;

-- Tabla ESCUELAS
CREATE TABLE Escuelas (
    id_escuela INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(50),
    longitud DOUBLE,
    latitud DOUBLE
);

-- Tabla MAESTROS
CREATE TABLE maestros (
    id_maestros INT AUTO_INCREMENT PRIMARY KEY,
    id_escuela INT,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    telefono VARCHAR(50),
    perfil VARCHAR(100),
    FOREIGN KEY (id_escuela) REFERENCES Escuelas(id_escuela) ON DELETE CASCADE
);

