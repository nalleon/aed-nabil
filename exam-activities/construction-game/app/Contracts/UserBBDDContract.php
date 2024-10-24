<?php

namespace App\Contracts;

    final class UserBBDDContract {

        public const TABLE_NAME = "usuarios";
        public const COL_ID = "id";
        public const COL_NOMBRE = "nombre";
        public const COL_PASSWORD = "password";
        public const COL_ROL = "rol";

        private function __construct() {}
    }
?>
