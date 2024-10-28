<?php
$pdo->exec("
CREATE TABLE roles (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    nombre varchar(30) NOT NULL
    );
");

$pdo->exec("
INSERT INTO roles (id, nombre) VALUES (1,'usuario');
INSERT INTO roles (id, nombre) VALUES (2,'admin');

");
?>
