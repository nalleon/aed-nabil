<?php

namespace App\Repository\Interface;

interface IRepositoryCrud{
    public function findAll(): array;
    public function save($p): object | null;
    public function findById($id): object | null;
    public function update($p): bool;
    public function delete($id): bool;
}
    
?>