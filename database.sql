CREATE DATABASE saludedu;
USE saludedu;

-- Tabla DEPARTAMENTOS
CREATE TABLE departamentos (
    id_departamento INT PRIMARY KEY AUTO_INCREMENT,
    nombre_departamento VARCHAR (255)
)ENGINE=InnoDB;

-- Tabla AÑO LECTIVO
CREATE TABLE axo_lectivo(
 id_lectivo INT PRIMARY KEY AUTO_INCREMENT,
 axo INT
)ENGINE=InnoDB;

-- Tabla MUNICIPIOS
CREATE TABLE municipios (
    id_municipio INT PRIMARY KEY AUTO_INCREMENT,
    id_departamento INT,
    nombre_municipio VARCHAR (255),
    FOREIGN KEY (id_departamento) REFERENCES departamentos(id_departamento) ON DELETE CASCADE
)ENGINE=InnoDB;

-- Tabla ESCUELAS
CREATE TABLE escuelas (
    id_escuela INT AUTO_INCREMENT PRIMARY KEY,
    id_municipio INT,
    id_lectivo INT,
    nombre VARCHAR(255) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(50),
    longitud DOUBLE,
    latitud DOUBLE,
    FOREIGN KEY (id_lectivo) REFERENCES axo_lectivo (id_lectivo) ON DELETE CASCADE,
    FOREIGN KEY (id_municipio) REFERENCES municipios (id_municipio) ON DELETE CASCADE    
)ENGINE=InnoDB;

-- Tabla GRADOS
CREATE TABLE grados (
id_grado INT,
id_escuela INT,
nombre_grado VARCHAR (15)
)ENGINE=InnoDB;

-- Tabla GRUPOS
CREATE TABLE grupos (
id_grupo INT AUTO_INCREMENT PRIMARY KEY,
id_grado INT,
nombre_grupo varchar(1),
modalidad ENUM ("Matutino", "Vespertino", "Nocturno", "Sabatino", "Dominical")
)engine=InnoDB;


-- Tabla ESTUDIANTES
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

-- Tabla DATOS DE SALUD del estudiante
CREATE TABLE salud_estudiante (
    id_salud INT PRIMARY KEY AUTO_INCREMENT,
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


-- Tabla MATERIA
CREATE TABLE materia(
id_materia int primary key auto_increment,
id_grupo int,
id_maestro int,
nombre_materia varchar(45),
foreign key (id_grupo) references grupos (id_grupo),
foreign key (id_maestro) references grupos (id_grupo)
)engine=innodb;

-- Tabla MAESTROS
CREATE TABLE maestros (
id_maestro INT AUTO_INCREMENT PRIMARY KEY,
id_escuela INT,
id_materia INT,
nombre VARCHAR(255) NOT NULL,
apellido VARCHAR(255) NOT NULL,
email VARCHAR(100),
telefono VARCHAR(50),
FOREIGN KEY (id_escuela) REFERENCES Escuelas(id_escuela) ON DELETE CASCADE,
FOREIGN KEY (id_materia) REFERENCES materia (id_materia) ON DELETE CASCADE
)ENGINE=InnoDB;

-- Tabla de PRUEBAS FÍSICO-MOTRICES
CREATE TABLE puebras_fisicas (
    id_prueba INT PRIMARY KEY AUTO_INCREMENT,
    id_estudiante INT,
    tipo_prueba VARCHAR (255),
    resultado VARCHAR (255),
    unidad_medida VARCHAR (255),
    observaciones TEXT,
    fecha_prueba DATE
)ENGINE=InnoDB;


-- ######### CONSULTAS ###############
-- Procedimiento de Almacenado para agregar MUNICIPIO a los DEPARTAMENTOS
 DELIMITER //
CREATE PROCEDURE ingresarGrados(
    IN escuelaNombre VARCHAR(255),
    IN grado VARCHAR(15)
)
BEGIN
    DECLARE escuelaId INT;

    -- Obtener el id del departamento basado en su nombre
    SELECT id_escuela INTO escuelaId
    FROM escuelas
    WHERE nombre_escuela = escuelaNombre;
    
    -- Inserta los municipios, si el departamento existe
    IF escueloId IS NOT NULL THEN
        INSERT INTO grados (id_escuela, nombre_grado) VALUES (escuelaId, grado);
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Departamento no encontrado';
    END IF;
END //
DELIMITER ;

-- Call ingresarGrados("", "Primer grado");

-- Consulta para agregar todos los DEPARTAMENTOS
 INSERT INTO departamentos (nombre_departamento) VALUES ("Madriz"), ("Nueva Segovia"), ("Estelí"), ("Jinotega"), ("Matagalpa"), ("Managua"), 
 ("León"), ("Chinandega"), ("Masaya"), ("Carazo"), ("Granada"), ("Rivas"), ("Boaco"), ("Chontales"), ("Río San Juan"), ("Costa Caribe Norte"), ("Costa Caribe Sur");
 
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

-- Agregando los municipios de MADRIZ
CALL ingresarMunicipios ('Madriz', 'Somoto');
CALL ingresarMunicipios ('Madriz', 'San Juan del Río Coco');
CALL ingresarMunicipios ('Madriz', 'San José de Cusmapa');
CALL ingresarMunicipios ('Madriz', 'Las Sabanas');
CALL ingresarMunicipios ('Madriz', 'San Lucas');
CALL ingresarMunicipios ('Madriz', 'Yalagüina');
CALL ingresarMunicipios ('Madriz', 'Palacagüina');
CALL ingresarMunicipios ('Madriz', 'Totogalpa');
CALL ingresarMunicipios ('Madriz', 'Telpaneca');

-- Agregando los municipios de NUEVA SEGOVIA
CALL ingresarMunicipios ('Nueva Segovia', 'Ciudad Antigua');
CALL ingresarMunicipios ('Nueva Segovia', 'Dipilto');
CALL ingresarMunicipios ('Nueva Segovia', 'El Jícaro');
CALL ingresarMunicipios ('Nueva Segovia', 'Jalapa');
CALL ingresarMunicipios ('Nueva Segovia', 'Macuelizo');
CALL ingresarMunicipios ('Nueva Segovia', 'Mozonte');
CALL ingresarMunicipios ('Nueva Segovia', 'Murra');
CALL ingresarMunicipios ('Nueva Segovia', 'Ocotal');
CALL ingresarMunicipios ('Nueva Segovia', 'Quilalí');
CALL ingresarMunicipios ('Nueva Segovia', 'San Fernando');
CALL ingresarMunicipios ('Nueva Segovia', 'Santa María');
CALL ingresarMunicipios ('Nueva Segovia', 'Wiwilí');

-- Agregando los municipios de ESTELÍ
CALL ingresarMunicipios ('Estelí', 'Condega');
CALL ingresarMunicipios ('Estelí', 'Estelí');
CALL ingresarMunicipios ('Estelí', 'La Trinidad');
CALL ingresarMunicipios ('Estelí', 'Pueblo Nuevo');
CALL ingresarMunicipios ('Estelí', 'San Juan de Limay');
CALL ingresarMunicipios ('Estelí', 'San Nicolás');

-- Agregando los municipios de JINOTEGA
CALL ingresarMunicipios ('Jinotega', 'El Cuá');
CALL ingresarMunicipios ('Jinotega', 'Jinotega');
CALL ingresarMunicipios ('Jinotega', 'La Concordia');
CALL ingresarMunicipios ('Jinotega', 'San José de Bocay');
CALL ingresarMunicipios ('Jinotega', 'San Rafael del Norte');
CALL ingresarMunicipios ('Jinotega', 'San Sebastián de Yalí');
CALL ingresarMunicipios ('Jinotega', 'Santa María de Pantasma');
CALL ingresarMunicipios ('Jinotega', 'Wiwilí de Jinotega');

-- Agregando los municipios de MATAGALPA
CALL ingresarMunicipios ('Matagalpa', 'Ciudad Darío');
CALL ingresarMunicipios ('Matagalpa', 'El Tuma La Dalia');
CALL ingresarMunicipios ('Matagalpa', 'Esquipulas');
CALL ingresarMunicipios ('Matagalpa', 'Matagalpa');
CALL ingresarMunicipios ('Matagalpa', 'Matiguás');
CALL ingresarMunicipios ('Matagalpa', 'Muy Muy');
CALL ingresarMunicipios ('Matagalpa', 'Rancho Grande');
CALL ingresarMunicipios ('Matagalpa', 'Río Blanco');
CALL ingresarMunicipios ('Matagalpa', 'San Dionisio');
CALL ingresarMunicipios ('Matagalpa', 'San Isidro');
CALL ingresarMunicipios ('Matagalpa', 'San Ramón');
CALL ingresarMunicipios ('Matagalpa', 'Sébaco');
CALL ingresarMunicipios ('Matagalpa', 'Terrabona');

-- Agregando los municipios de MANAGUA
CALL ingresarMunicipios ('Managua', 'Ciudad Sandino');
CALL ingresarMunicipios ('Managua', 'El Crucero');
CALL ingresarMunicipios ('Managua', 'Managua');
CALL ingresarMunicipios ('Managua', 'Mateare');
CALL ingresarMunicipios ('Managua', 'San Francisco Libre');
CALL ingresarMunicipios ('Managua', 'San Rafael del Sur');
CALL ingresarMunicipios ('Managua', 'Ticuantepe');
CALL ingresarMunicipios ('Managua', 'Tipitapa');
CALL ingresarMunicipios ('Managua', 'Villa Carlos Fonseca');

-- Agregando los municipios de LEÓN
CALL ingresarMunicipios ('León', 'Achuapa');
CALL ingresarMunicipios ('León', 'El Jicaral');
CALL ingresarMunicipios ('León', 'El Sauce');
CALL ingresarMunicipios ('León', 'La Paz Centro');
CALL ingresarMunicipios ('León', 'Larreynaga');
CALL ingresarMunicipios ('León', 'León');
CALL ingresarMunicipios ('León', 'Nagarote');
CALL ingresarMunicipios ('León', 'Quezalguaque');
CALL ingresarMunicipios ('León', 'Santa Rosa del Peñón');
CALL ingresarMunicipios ('León', 'Telica');

-- Agregando los municipios de CHINANDEGA
CALL ingresarMunicipios ('Chinandega', 'Chichigalpa');
CALL ingresarMunicipios ('Chinandega', 'Chinandega');
CALL ingresarMunicipios ('Chinandega', 'Cinco Pinos');
CALL ingresarMunicipios ('Chinandega', 'Corinto');
CALL ingresarMunicipios ('Chinandega', 'El Realejo');
CALL ingresarMunicipios ('Chinandega', 'El Viejo');
CALL ingresarMunicipios ('Chinandega', 'Posoltega');
CALL ingresarMunicipios ('Chinandega', 'Puerto Morazán');
CALL ingresarMunicipios ('Chinandega', 'San Francisco del Norte');
CALL ingresarMunicipios ('Chinandega', 'San Pedro del Norte');
CALL ingresarMunicipios ('Chinandega', 'Santo Tomás del Norte');
CALL ingresarMunicipios ('Chinandega', 'Somotillo');
CALL ingresarMunicipios ('Chinandega', 'Villa Nueva');

-- Agregando los municipios de MASAYA
CALL ingresarMunicipios ('Masaya', 'Catarina');
CALL ingresarMunicipios ('Masaya', 'La Concepción');
CALL ingresarMunicipios ('Masaya', 'Masatepe');
CALL ingresarMunicipios ('Masaya', 'Masaya');
CALL ingresarMunicipios ('Masaya', 'Nandasmo');
CALL ingresarMunicipios ('Masaya', 'Nindirí');
CALL ingresarMunicipios ('Masaya', 'Niquinohomo');
CALL ingresarMunicipios ('Masaya', 'San Juan de Oriente');
CALL ingresarMunicipios ('Masaya', 'Tisma');

-- Agregando los municipios de CARAZO
CALL ingresarMunicipios ('Carazo', 'Diriamba');
CALL ingresarMunicipios ('Carazo', 'Dolores');
CALL ingresarMunicipios ('Carazo', 'El Rosario');
CALL ingresarMunicipios ('Carazo', 'Jinotepe');
CALL ingresarMunicipios ('Carazo', 'La Conquista');
CALL ingresarMunicipios ('Carazo', 'La Paz de Oriente');
CALL ingresarMunicipios ('Carazo', 'San Marcos');
CALL ingresarMunicipios ('Carazo', 'Santa Teresa');

-- Agregando los municipios de GRANADA
CALL ingresarMunicipios ('Granada', 'Diriá');
CALL ingresarMunicipios ('Granada', 'Diriomo');
CALL ingresarMunicipios ('Granada', 'Granada');
CALL ingresarMunicipios ('Granada', 'Nandaime');

-- Agregando los municipios de RIVAS
CALL ingresarMunicipios ('Rivas', 'Altagracia');
CALL ingresarMunicipios ('Rivas', 'Belén');
CALL ingresarMunicipios ('Rivas', 'Buenos Aires');
CALL ingresarMunicipios ('Rivas', 'Cárdenas');
CALL ingresarMunicipios ('Rivas', 'Moyogalpa');
CALL ingresarMunicipios ('Rivas', 'Potosí');
CALL ingresarMunicipios ('Rivas', 'Rivas');
CALL ingresarMunicipios ('Rivas', 'San Jorge');
CALL ingresarMunicipios ('Rivas', 'San Juan del Sur');
CALL ingresarMunicipios ('Rivas', 'Tola');

-- Agregando los municipios de BOACO
CALL ingresarMunicipios ('Boaco', 'Boaco');
CALL ingresarMunicipios ('Boaco', 'Camoapa');
CALL ingresarMunicipios ('Boaco', 'San José de los Remates');
CALL ingresarMunicipios ('Boaco', 'San Lorenzo');
CALL ingresarMunicipios ('Boaco', 'Santa Lucía');
CALL ingresarMunicipios ('Boaco', 'Teustepe');

-- Agregando los municipios de CHONTALES
CALL ingresarMunicipios ('Chontales', 'Acoyapa');
CALL ingresarMunicipios ('Chontales', 'Comalapa');
CALL ingresarMunicipios ('Chontales', 'Cuapa');
CALL ingresarMunicipios ('Chontales', 'El Coral');
CALL ingresarMunicipios ('Chontales', 'Juigalpa');
CALL ingresarMunicipios ('Chontales', 'La Libertad');
CALL ingresarMunicipios ('Chontales', 'San Pedro de Lóvago');
CALL ingresarMunicipios ('Chontales', 'Santo Domingo');
CALL ingresarMunicipios ('Chontales', 'Santo Tomás');
CALL ingresarMunicipios ('Chontales', 'Villa Sandino');

-- Agregando los municipios de RÍO SAN JUAN
CALL ingresarMunicipios ('Río San Juan', 'El Almendro');
CALL ingresarMunicipios ('Río San Juan', 'El Castillo');
CALL ingresarMunicipios ('Río San Juan', 'Morrito');
CALL ingresarMunicipios ('Río San Juan', 'San Carlos');
CALL ingresarMunicipios ('Río San Juan', 'San Juan del Norte');
CALL ingresarMunicipios ('Río San Juan', 'San Miguelito');

-- Agregando los municipios de COSTA CARIBE NORTE
CALL ingresarMunicipios ('Costa Caribe Norte', 'Bonanza');
CALL ingresarMunicipios ('Costa Caribe Norte', 'Mulukukú');
CALL ingresarMunicipios ('Costa Caribe Norte', 'Prinzapolka');
CALL ingresarMunicipios ('Costa Caribe Norte', 'Puerto Cabezas');
CALL ingresarMunicipios ('Costa Caribe Norte', 'Rosita');
CALL ingresarMunicipios ('Costa Caribe Norte', 'Siuna');
CALL ingresarMunicipios ('Costa Caribe Norte', 'Waslala');
CALL ingresarMunicipios ('Costa Caribe Norte', 'Waspán');

-- Agregando los municipios de COSTA CARIBE SUR
CALL ingresarMunicipios ('Costa Caribe Sur', 'Bluefields');
CALL ingresarMunicipios ('Costa Caribe Sur', 'Corn Island');
CALL ingresarMunicipios ('Costa Caribe Sur', 'Desembocadura del Río Grande');
CALL ingresarMunicipios ('Costa Caribe Sur', 'El Ayote');
CALL ingresarMunicipios ('Costa Caribe Sur', 'El Rama');
CALL ingresarMunicipios ('Costa Caribe Sur', 'El Tortuguero');
CALL ingresarMunicipios ('Costa Caribe Sur', 'Kukra Hill');
CALL ingresarMunicipios ('Costa Caribe Sur', 'La Cruz Río Grande');
CALL ingresarMunicipios ('Costa Caribe Sur', 'Laguna de Perlas');
CALL ingresarMunicipios ('Costa Caribe Sur', 'Muelle de los Bueyes');
CALL ingresarMunicipios ('Costa Caribe Sur', 'Nueva Guinea');
CALL ingresarMunicipios ('Costa Caribe Sur', 'Paiwas');

-- Consulta para ver los MUNICIPIOS y DEPARTAMENTOS
-- use saludedu;
-- SELECT departamentos.id_departamento, nombre_departamento, id_municipio, nombre_municipio FROM municipios INNER JOIN departamentos ON municipios.id_departamento=departamentos.id_departamento;




