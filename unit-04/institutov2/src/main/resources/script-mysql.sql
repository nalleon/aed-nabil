CREATE TABLE `alumnos`(
    dni CHARACTER(20),
    nombre CHARACTER(50),
    apellidos CHARACTER(50),
    fechanacimiento BIGINT,

    CONSTRAINT pk_alumnos PRIMARY KEY(dni)
);

CREATE TABLE `asignaturas`(
    id int AUTO_INCREMENT,
    nombre CHARACTER(50),
    curso CHARACTER(50),
    CONSTRAINT pk_asignaturas PRIMARY KEY(id),
    CONSTRAINT uc_nombrecurso UNIQUE(nombre,curso)
);


CREATE TABLE `matriculas`(
    `id` int AUTO_INCREMENT,
    `dni` CHARACTER(20),
    `year` int,
    CONSTRAINT `pk_matriculas` PRIMARY KEY(`id`),
    CONSTRAINT `fk_alumnos` FOREIGN KEY(`dni`) REFERENCES `alumnos`(`dni`),
    CONSTRAINT `uc_dniyear` UNIQUE(`dni`,`year`)
);

CREATE TABLE `asignaturas_matriculas`(
    id int AUTO_INCREMENT,
    idmatricula int,
    idasignatura int,
    CONSTRAINT pk_asignatura_matriculas PRIMARY KEY(id),
    CONSTRAINT fk_matriculas FOREIGN KEY(idmatricula) REFERENCES matriculas(id),
    CONSTRAINT fk_asignaturas FOREIGN KEY(idasignatura) REFERENCES asignaturas(id)

);

INSERT INTO `alumnos` (`dni`, `nombre`, `apellidos`, `fechanacimiento`) VALUES ('12345678Z', 'Ana', 'Martín', '968972400000');
INSERT INTO `alumnos` (`dni`, `nombre`, `apellidos`, `fechanacimiento`) VALUES ('87654321X', 'Marcos', 'Afonso Jiménez', '874278000000');
INSERT INTO `alumnos` (`dni`, `nombre`, `apellidos`, `fechanacimiento`) VALUES ('12312312K', 'María Luisa', 'Gutiérrez', '821234400000');


INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (1, 'BAE', '1º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (2, 'PGV', '2º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (3, 'LND', '1º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (4, 'AED', '2º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (5, 'DSW', '2º DAW');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (6, 'DPL', '2º DAW');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (7, 'PRO', '1º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (8, 'PGL', '2º DAM');

INSERT INTO `matriculas` (`id`, `dni`,`year`) VALUES (1, '12345678Z', 2023);

INSERT INTO `asignaturas_matriculas` (`idmatricula`,`idasignatura`) VALUES (1, 2);

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
        'b05t46116p',
        '$2a$10$P0fZ.FcD.rBwolLS9P5bAOZETI3K9E5JsiE/NQC82HgkXccYnFvry',
        'admin@gmail.com',
        'ROLE_ADMIN',
        1,
        'CHANGE_THIS',
        UNIX_TIMESTAMP()
    );
