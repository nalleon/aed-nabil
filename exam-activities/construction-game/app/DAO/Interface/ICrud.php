<?php

namespace App\DAO\Interface;

interface ICrud{
    public function findAll(): array;
    public function save($dao): object | null;
    public function findById($id): object | null;
    public function update($d): bool;
    public function delete($id): bool;
}
    
?>