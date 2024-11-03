<?php

namespace App\DAO\Interface;
/**
 * @author Nabil L. A.
 */
interface ICrud{
    public function findAll(): array;
    public function save($p): object | null;
    public function findById($id): object | null;
    public function update($p): bool;
    public function delete($id): bool;
}
    
?>