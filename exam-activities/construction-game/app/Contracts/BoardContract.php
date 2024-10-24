<?php

namespace App\Contracts;

    final class BoardContract {

        public const TABLE_NAME = "tableros";
        public const COL_CONTENIDO = "contenido";
        public const COL_FECHA = "fecha";
        public const COL_ID = "id";
        public const COL_NOMBRE = "nombre";
        public const COL_USUARIO = "usuario";

        private function __construct() {}
    }
?>
