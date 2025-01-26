SET MODE MYSQL;

DROP TABLE IF EXISTS asignaturas_matriculas;
DROP TABLE IF EXISTS matriculas;
DROP TABLE IF EXISTS alumnos;
DROP TABLE IF EXISTS asignaturas;

CREATE TABLE alumnos(
   dni char(20) NOT NULL,
   nombre char(50) DEFAULT NULL,
   apellidos char(50) DEFAULT NULL,
   fechanacimiento bigint DEFAULT NULL
);
INSERT INTO alumnos (dni, nombre, apellidos, fechanacimiento) VALUES
('12312312K', 'María Luisa', 'Gutiérrez', 821234400000),
('12345678Z', 'Ana', 'Martín', 968972400000),
('87654321X', 'Marcos', 'Afonso Jiménez', 874278000000);



CREATE TABLE asignaturas (
  id int AUTO_INCREMENT NOT NULL,
  nombre char(50) DEFAULT NULL,
  curso char(50) DEFAULT NULL
);


INSERT INTO asignaturas (nombre, curso) VALUES
('AED', '2º DAM'),
('BAE', '1º DAM'),
('DAA', '1ºDAM'),
('DOO', '2ºDAM'),
('DPL', '2º DAW'),
('DSW', '2º DAW'),
('LND', '1º DAM'),
('PGL', '2º DAM'),
('PGV', '2º DAM'),
('PRO', '1º DAM');

CREATE TABLE matriculas (
  id int AUTO_INCREMENT NOT NULL,
  dni char(20) DEFAULT NULL,
  `year` int DEFAULT NULL
);

INSERT INTO matriculas (dni, `year`) VALUES
('12312312K', 2020);


CREATE TABLE asignaturas_matriculas (
  id int AUTO_INCREMENT NOT NULL,
  idmatricula int DEFAULT NULL,
  idasignatura int DEFAULT NULL
);

INSERT INTO asignaturas_matriculas (idmatricula, idasignatura) VALUES
(1, 2);


ALTER TABLE alumnos
  ADD PRIMARY KEY (dni);

ALTER TABLE asignaturas
  ADD PRIMARY KEY (id);

ALTER TABLE asignaturas
  ADD UNIQUE KEY uc_nombrecurso (nombre,curso);

ALTER TABLE asignaturas_matriculas
  ADD PRIMARY KEY (id);
ALTER TABLE asignaturas_matriculas
  ADD UNIQUE KEY uq_matasig (idmatricula,idasignatura);
ALTER TABLE asignaturas_matriculas
  ADD KEY fk_asignaturas (idasignatura);

  ALTER TABLE asignaturas_matriculas
    ADD CONSTRAINT fk_asignaturas FOREIGN KEY (idasignatura) REFERENCES asignaturas (id);
  ALTER TABLE asignaturas_matriculas
    ADD CONSTRAINT fk_matriculas FOREIGN KEY (idmatricula) REFERENCES matriculas (id);


  ALTER TABLE matriculas
    ADD CONSTRAINT fk_alumnos FOREIGN KEY (dni) REFERENCES alumnos (dni);