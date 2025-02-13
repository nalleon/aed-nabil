
CREATE TABLE `usuarios` (
    id int AUTO_INCREMENT NOT NULL,
    nombre CHAR(45) UNIQUE NOT NULL,
    password CHAR(200) NOT NULL,
    correo CHAR(100) UNIQUE NOT NULL,
    rol CHAR(45) NOT NULL,
    verificado TINYINT(1) DEFAULT 0,
    token_verificacion CHAR(255),
    fecha_creacion BIGINT NOT NULL,
    CONSTRAINT pk_usuarios PRIMARY KEY(id)
);

INSERT INTO `usuarios` (
        `nombre`,
        `password`,
        `correo`,
        `rol`,
        `verificado`,
        `token_verificacion`,
        `fecha_creacion`
    )
VALUES (
        'root',
        '$2a$10$P0fZ.FcD.rBwolLS9P5bAOZETI3K9E5JsiE/NQC82HgkXccYnFvry',
        'nlamail1529@gmail.com',
        'ROLE_ADMIN',
        1,
        'readumineko',
        UNIX_TIMESTAMP()
    );

INSERT INTO `usuarios` (
        `nombre`,
        `password`,
        `correo`,
        `rol`,
        `verificado`,
        `token_verificacion`,
        `fecha_creacion`
    )
VALUES (
        'nalleon',
        '$2a$10$P0fZ.FcD.rBwolLS9P5bAOZETI3K9E5JsiE/NQC82HgkXccYnFvry',
        'nabil14716@gmail.com',
        'ROLE_USER',
        1,
        'ef34fd1b-c8da-4397-9d7e-06b554a2d617',
        UNIX_TIMESTAMP()
    );


