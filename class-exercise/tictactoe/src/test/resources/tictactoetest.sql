SET MODE MySQL;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(45) UNIQUE NOT NULL,
    password VARCHAR(200) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    rol VARCHAR(45) NOT NULL,
    verificado TINYINT(1) DEFAULT 0,
    token_verificacion VARCHAR(255),
    fecha_creacion BIGINT NOT NULL
);

INSERT INTO usuarios (
    nombre,
    password,
    correo,
    rol,
    verificado,
    token_verificacion,
    fecha_creacion
) VALUES (
    'root',
    '$2a$10$P0fZ.FcD.rBwolLS9P5bAOZETI3K9E5JsiE/NQC82HgkXccYnFvry',
    'admin@gmail.com',
    'ROLE_ADMIN',
    1,
    'readumineko',
    UNIX_TIMESTAMP()
);
