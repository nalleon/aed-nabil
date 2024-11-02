<?php

namespace App\Repository\Interface;

interface IRepositoryCrud{
    public function findAll(): array;
    public function save($dao): object | null;
    public function findById($id): object | null;
    public function update($dao): bool;
    public function delete($id): bool;
}
    
?>