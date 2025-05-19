CREATE DATABASE habitos;

USE habitos;

CREATE TABLE estatus(
    id TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    situacion VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
) ENGINE = InnoDB;

INSERT INTO estatus(situacion) VALUES
    ('Activo'),
    ('Inactivo'),
    ('Pausa'),
    ('Completo'),
    ('Incompleto');

CREATE TABLE insignias(
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(150) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB;

INSERT INTO insignias(tipo) VALUES
    ('dias'),
    ('habitos'),
    ('metas');

CREATE TABLE usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(50) NOT NULL DEFAULT 'user',
    insignia_id INT NOT NULL,
    FOREIGN KEY (insignia_id) REFERENCES insignias(id),
    estatus_id TINYINT UNSIGNED NOT NULL DEFAULT 1,
    FOREIGN KEY (estatus_id) REFERENCES estatus(id),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB;

INSERT INTO usuarios(nombre, email, password, rol,insignia_id, estatus_id) VALUES
    ('reimon', 'reimon8@example.com', 'reimon123', 'admin', 1, 1);

CREATE TABLE habitos(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    nombre VARCHAR(100) NOT NULL,
    frecuencia VARCHAR(100) NOT NULL,
    estatus_id TINYINT UNSIGNED NOT NULL DEFAULT 1,
    FOREIGN KEY (estatus_id) REFERENCES estatus(id),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB;

CREATE TABLE seguimiento(
    id INT AUTO_INCREMENT PRIMARY KEY,
    habito_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (habito_id) REFERENCES habitos(id),
    racha INT UNSIGNED DEFAULT 0,
    fecha DATETIME,
    estatus_id TINYINT UNSIGNED NOT NULL DEFAULT 5,
    FOREIGN KEY (estatus_id) REFERENCES estatus(id),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB;

CREATE TABLE metas(
    id INT AUTO_INCREMENT PRIMARY KEY,
    habito_id INT UNSIGNED,
    FOREIGN KEY (habito_id) REFERENCES habitos(id),
    veces_semana INT UNSIGNED DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB;
