<?php

namespace App\Contracts;

final class RolContract {

    public const TABLE_NAME = "roles";
    public const COL_ID = "id";
    public const COL_NAME = "nombre";


    private function __construct() {}
}