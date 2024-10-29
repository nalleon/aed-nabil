<?php

namespace App\Contracts;

    final class FigureBoardContract {

        public const TABLE_NAME = "figuras_tableros";
        public const COL_ID = "id";
        public const COL_BOARD_ID = "tablero_id";
        public const COL_FIGURE_ID = "figura_id";
        public const COL_POSITION = "posicion";

        private function __construct() {}
    }
?>
