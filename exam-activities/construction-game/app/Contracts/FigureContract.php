<?php

namespace App\Contracts;

    final class FigureContract {

        public const TABLE_NAME = "figuras";
        public const COL_ID = "id";
        public const COL_IMG = "imagen";
        public const COL_TYPE = "tipo_imagen";

        private function __construct() {}
    }
?>
