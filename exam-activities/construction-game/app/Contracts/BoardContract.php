<?php

namespace App\Contracts;
/**
 * @author Nabil L. A.
 */
final class BoardContract {

    public const TABLE_NAME = "tableros";
    public const COL_ID = "id";
    public const COL_NAME = "nombre";
    public const COL_CONTENT = "contenido";
    public const COL_DATE = "fecha";
    public const COL_USER = "usuario_id";

    private function __construct() {}
}
?>
