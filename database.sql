CREATE DATABASE saludedu;

USE saludedu;

-- Tabla USUARIOS
CREATE TABLE
    usuarios (
        id_usuario INT PRIMARY KEY AUTO_INCREMENT,
        usuario VARCHAR(255),
        clave VARCHAR(255),
        rol VARCHAR(255)
    ) ENGINE = InnoDB;

-- Tabla DEPARTAMENTOS
CREATE TABLE
    departamentos (
        id_departamento INT PRIMARY KEY AUTO_INCREMENT,
        nombre_departamento VARCHAR(255)
    ) ENGINE = InnoDB;

-- Tabla AÑO LECTIVO
CREATE TABLE
    axo_lectivo (
        id_lectivo INT PRIMARY KEY AUTO_INCREMENT,
        axo INT
    ) ENGINE = InnoDB;

-- Tabla MUNICIPIOS
CREATE TABLE
    municipios (
        id_municipio INT PRIMARY KEY AUTO_INCREMENT,
        id_departamento INT,
        nombre_municipio VARCHAR(255),
        FOREIGN KEY (id_departamento) REFERENCES departamentos (id_departamento) ON DELETE CASCADE
    ) ENGINE = InnoDB;

-- Tabla ESCUELAS
CREATE TABLE
    escuelas (
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
    ) ENGINE = InnoDB;

-- Tabla DOCENTES
CREATE TABLE
    docentes (
        id_docente INT AUTO_INCREMENT PRIMARY KEY,
        id_escuela INT,
        nombre VARCHAR(255) NOT NULL,
        apellido VARCHAR(255) NOT NULL,
        email VARCHAR(100),
        telefono VARCHAR(50),
        usuario VARCHAR(50),
        FOREIGN KEY (id_escuela) REFERENCES escuelas (id_escuela) ON DELETE CASCADE
    ) ENGINE = InnoDB;

-- Tabla GRUPOS
CREATE TABLE
    grupos (
        id_grupo INT AUTO_INCREMENT PRIMARY KEY,
        lectivo_id INT,
        docente_id INT,
        axo_grupo VARCHAR(15),
        nombre_grupo VARCHAR(50),
        modalidad ENUM (
            "Matutino",
            "Vespertino",
            "Nocturno",
            "Sabatino",
            "Dominical"
        ),
        FOREIGN KEY (lectivo_id) REFERENCES axo_lectivo (id_lectivo),
        FOREIGN KEY (docente_id) REFERENCES docentes (id_docente)
    ) ENGINE = InnoDB;

-- Tabla MATERIA
CREATE TABLE
    materias (
        id_materia INT PRIMARY KEY AUTO_INCREMENT,
        id_grupo INT,
        nombre_materia VARCHAR(45),
        FOREIGN KEY (id_grupo) REFERENCES grupos (id_grupo)
    ) ENGINE = InnoDB;

-- Tabla ESTUDIANTES
CREATE TABLE
    estudiantes (
        id_estudiante INT AUTO_INCREMENT PRIMARY KEY,
        id_escuela INT,
        primer_nombre VARCHAR(50),
        segundo_nombre VARCHAR(50),
        primer_apellido VARCHAR(50),
        segundo_apellido VARCHAR(50),
        edad INT,
        fecha_nacimiento DATE,
        sexo ENUM ('Masculino', 'Femenino'),
        direccion VARCHAR(255),
        telefono VARCHAR(50),
        email VARCHAR(100),
        nombre_tutor VARCHAR(255),
        telefono_tutor VARCHAR(50),
        imagen VARCHAR(50),
        estado ENUM ('Activo', 'Inactivo'),
        usuario VARCHAR(50),
        clave VARCHAR(50),
        FOREIGN KEY (id_escuela) REFERENCES escuelas (id_escuela)
    ) ENGINE = InnoDB;

-- Tabla Matrícula
CREATE TABLE
    matricula (
        id_matricula INT AUTO_INCREMENT PRIMARY KEY,
        id_grupo INT,
        id_estudiante INT,
        FOREIGN KEY (id_grupo) REFERENCES grupos (id_grupo),
        FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id_estudiante)
    ) ENGINE = InnoDB;

-- Tabla para los Datos de SALUD del ESTUDIANTE
CREATE TABLE
    salud_estudiante (
        id_estudiante INT,
        peso FLOAT,
        altura FLOAT,
        imc FLOAT,
        categoria_peso VARCHAR(255),
        condicion_medica VARCHAR(255),
        descripcion TEXT,
        medicacion TEXT,
        somatotipo VARCHAR(255),
        FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id_estudiante)
    ) ENGINE = InnoDB;

--  Tabla para HISTORIA de SALUD
CREATE TABLE
    historial_salud (
        id_estudiante INT,
        fecha_realizacion DATE,
        peso FLOAT,
        altura FLOAT,
        imc FLOAT,
        categoria_peso VARCHAR(255),
        FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id_estudiante)
    ) ENGINE = InnoDB;

-- Trigger para cambios antes de actualizar SALUD ESTUDIANTE
DELIMITER / / CREATE TRIGGER before_update_salud_estudiante BEFORE
UPDATE ON salud_estudiante FOR EACH ROW BEGIN
INSERT INTO
    historial_salud (
        id_estudiante,
        fecha_realizacion,
        peso,
        altura,
        imc,
        categoria_peso
    )
VALUES
    (
        OLD.id_estudiante,
        CURDATE (),
        OLD.peso,
        OLD.altura,
        OLD.imc,
        OLD.categoria_peso
    );

END;

/ / DELIMITER;

-- Tabla de PRUEBAS FÍSICO-MOTRICES
CREATE TABLE
    pruebas_fisicas (
        id_prueba INT AUTO_INCREMENT PRIMARY KEY,
        id_estudiante INT,
        fecha_prueba DATE,
        tipo_prueba VARCHAR(75),
        resultado FLOAT,
        unidad_medida VARCHAR(20),
        observaciones TEXT,
        FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id_estudiante)
    ) ENGINE = InnoDB;

CREATE TABLE
    historial_pruebas (
        id_estudiante INT,
        fecha_prueba DATE,
        tipo_prueba VARCHAR(75),
        resultado FLOAT,
        unidad_medida VARCHAR(20),
        observaciones TEXT,
        FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id_estudiante)
    ) ENGINE = InnoDB;

CREATE TABLE
    estudiantes (
        id_estudiante INT AUTO_INCREMENT PRIMARY KEY,
        id_escuela INT,
        primer_nombre VARCHAR(50),
        segundo_nombre VARCHAR(50),
        primer_apellido VARCHAR(50),
        segundo_apellido VARCHAR(50),
        edad INT,
        fecha_nacimiento DATE,
        sexo ENUM ('Masculino', 'Femenino'),
        direccion VARCHAR(255),
        telefono VARCHAR(50),
        email VARCHAR(100),
        nombre_tutor VARCHAR(255),
        telefono_tutor VARCHAR(50),
        imagen VARCHAR(50),
        estado ENUM ('Activo', 'Inactivo'),
        usuario VARCHAR(50),
        clave VARCHAR(50),
        FOREIGN KEY (id_escuela) REFERENCES escuelas (id_escuela)
    ) ENGINE = InnoDB;

-- Tabla Matrícula
CREATE TABLE
    matricula (
        id_matricula INT AUTO_INCREMENT PRIMARY KEY,
        id_grupo INT,
        id_estudiante INT,
        FOREIGN KEY (id_grupo) REFERENCES grupos (id_grupo),
        FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id_estudiante)
    ) ENGINE = InnoDB;

-- Tabla para los Datos de SALUD del ESTUDIANTE
CREATE TABLE
    salud_estudiante (
        id_estudiante INT,
        peso FLOAT,
        altura FLOAT,
        imc FLOAT,
        categoria_peso VARCHAR(255),
        condicion_medica VARCHAR(255),
        descripcion TEXT,
        medicacion TEXT,
        somatotipo VARCHAR(255),
        FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id_estudiante)
    ) ENGINE = InnoDB;

--  Tabla para HISTORIA de SALUD
CREATE TABLE
    historial_salud (
        id_estudiante INT,
        fecha_realizacion DATE,
        peso FLOAT,
        altura FLOAT,
        imc FLOAT,
        categoria_peso VARCHAR(255),
        FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id_estudiante)
    ) ENGINE = InnoDB;

-- Tabla de PRUEBAS FÍSICO-MOTRICES
CREATE TABLE
    pruebas_fisicas (
        id_prueba INT AUTO_INCREMENT PRIMARY KEY,
        id_estudiante INT,
        fecha_prueba DATE,
        tipo_prueba VARCHAR(75),
        resultado FLOAT,
        unidad_medida VARCHAR(20),
        observaciones TEXT,
        FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id_estudiante)
    ) ENGINE = InnoDB;

CREATE TABLE
    historial_pruebas (
        id_estudiante INT,
        fecha_prueba DATE,
        tipo_prueba VARCHAR(75),
        resultado FLOAT,
        unidad_medida VARCHAR(20),
        observaciones TEXT,
        FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id_estudiante)
    ) ENGINE = InnoDB;

-- Tabla para asignar ESTUDIANTES a un GRUPO
CREATE TABLE
    asignacion_estudiantes (
        id_asignacion INT AUTO_INCREMENT PRIMARY KEY,
        id_estudiante INT,
        id_grupo INT,
        fecha_asignacion DATE NOT NULL,
        FOREIGN KEY (id_estudiante) REFERENCES estudiantes (id_estudiante) ON DELETE CASCADE,
        FOREIGN KEY (id_grupo) REFERENCES grupos (id_grupo) ON DELETE CASCADE
    ) ENGINE = InnoDB;

-- Tabla de EVENTOS Deportivos y otros
CREATE TABLE
    eventos_deportivos (
        id_evento INT AUTO_INCREMENT PRIMARY KEY,
        nombre_evento VARCHAR(255) NOT NULL,
        fecha_evento DATE NOT NULL,
        duracion TIME, -- Se puede cambiar a DECIMAL o INT si se prefiere en horas
        direccion VARCHAR(255),
        latitud DOUBLE,
        longitud DOUBLE,
        descripcion TEXT
    ) ENGINE = InnoDB;

-- Tabla de EJERCICIOS
CREATE TABLE
    ejercicios (
        id_ejercicio INT AUTO_INCREMENT PRIMARY KEY,
        nombre_ejercicio VARCHAR(255),
        descripcion TEXT,
        categoria VARCHAR(255), -- Por ejemplo, fuerza, resistencia, flexibilidad, etc.
        duracion_estimada INT -- En minutos o segundos, según prefieras
    ) ENGINE = InnoDB;

-- Tabla de PLANES - EJERCICIO
CREATE TABLE
    ejercicios_plan (
        id_plan INT AUTO_INCREMENT PRIMARY KEY,
        id_ejercicio INT,
        repeticiones INT,
        series INT,
        FOREIGN KEY (id_ejercicio) REFERENCES ejercicios (id_ejercicio) ON DELETE CASCADE
    ) ENGINE = InnoDB;

-- ######### CONSULTAS ###############
-- Consulta para agregar todos los DEPARTAMENTOS
INSERT INTO
    departamentos (nombre_departamento)
VALUES
    ("Madriz"),
    ("Nueva Segovia"),
    ("Estelí"),
    ("Jinotega"),
    ("Matagalpa"),
    ("Managua"),
    ("León"),
    ("Chinandega"),
    ("Masaya"),
    ("Carazo"),
    ("Granada"),
    ("Rivas"),
    ("Boaco"),
    ("Chontales"),
    ("Río San Juan"),
    ("Costa Caribe Norte"),
    ("Costa Caribe Sur");

-- Procedimiento de Almacenado para agregar MUNICIPIO a los DEPARTAMENTOS
DELIMITER //
CREATE PROCEDURE ingresarMunicipios (
    IN deptoNombre VARCHAR(50),
    IN municipio VARCHAR(255)
)
BEGIN
    DECLARE deptoId INT;

    -- Obtener el id del departamento basado en su nombre
    SELECT
        id_departamento INTO deptoId
    FROM
        departamentos
    WHERE
        nombre_departamento = deptoNombre;

    -- Inserta los municipios, si el departamento existe
    IF deptoId IS NOT NULL THEN
        INSERT INTO
            municipios (id_departamento, nombre_municipio)
        VALUES
            (deptoId, municipio);
    ELSE
        SIGNAL SQLSTATE '45000'
        SET
            MESSAGE_TEXT = 'Departamento no encontrado';
    END IF;
END//
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

CALL ingresarMunicipios (
    'Costa Caribe Sur',
    'Desembocadura del Río Grande'
);

CALL ingresarMunicipios ('Costa Caribe Sur', 'El Ayote');

CALL ingresarMunicipios ('Costa Caribe Sur', 'El Rama');

CALL ingresarMunicipios ('Costa Caribe Sur', 'El Tortuguero');

CALL ingresarMunicipios ('Costa Caribe Sur', 'Kukra Hill');

CALL ingresarMunicipios ('Costa Caribe Sur', 'La Cruz Río Grande');

CALL ingresarMunicipios ('Costa Caribe Sur', 'Laguna de Perlas');

CALL ingresarMunicipios ('Costa Caribe Sur', 'Muelle de los Bueyes');

CALL ingresarMunicipios ('Costa Caribe Sur', 'Nueva Guinea');

CALL ingresarMunicipios ('Costa Caribe Sur', 'Paiwas');

-- CONSULTA PARA Usuario Root, contraseña: Root-2024*
INSERT INTO
    `usuarios` (`usuario`, `clave`, `rol`)
VALUES
    (
        'root',
        '$2y$10$fELo5JQP5ETIfJqKoqPP/ONOspQgn8rJerxvK07Ug3KIWVZeAfNS.',
        'admin'
    );

-- OTRAS TABLAS FUTURAS
-- -- Tabla GRADOS
-- CREATE TABLE grados (
--     id_grado INT AUTO_INCREMENT,
--     id_escuela INT NOT NULL,
--     nombre_grado VARCHAR (15) NOT NULL,
--     PRIMARY KEY (id_grado, nombre_grado)
-- )ENGINE=InnoDB;