<?php
$pdo->exec("
CREATE TABLE roles (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    nombre varchar(30) NOT NULL
    );

CREATE TABLE usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    password TEXT NOT NULL,
    rol INTEGER NOT NULL DEFAULT 1,
    FOREIGN KEY (rol) REFERENCES roles(id)
);


CREATE TABLE tableros (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    usuario_id INTEGER NOT NULL,
    nombre TEXT NOT NULL,
    contenido TEXT,
    fecha INTEGER,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);


CREATE TABLE figuras (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    imagen BLOB,
    tipo_imagen TEXT
);


CREATE TABLE figuras_tableros (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    tablero_id INTEGER NOT NULL,
    figura_id INTEGER NOT NULL,
    posicion INTEGER NOT NULL,
    CONSTRAINT fk_tablero FOREIGN KEY(tablero_id) REFERENCES tableros(id),
    CONSTRAINT fk_figura FOREIGN KEY(figura_id) REFERENCES figuras(id),
    CONSTRAINT uq_tablero_posicion UNIQUE (tablero_id, posicion)
);



");


$pdo->exec("INSERT INTO roles (id, nombre) VALUES (1,'usuario');");
$pdo->exec("INSERT INTO roles (id, nombre) VALUES (2,'admin');");

?>