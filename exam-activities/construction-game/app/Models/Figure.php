<?php

namespace App\Models;


class Figure {
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $image;

    /**
     * @var string
     */
    private string $type_image;

    // Getters y Setters

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getImage(): string {
        return $this->image;
    }

    public function setImage(string $image): void {
        $this->image = $image;
    }

    public function getTypeImage(): string {
        return $this->type_image;
    }

    public function setTypeImage(string $type_image): void {
        $this->type_image = $type_image;
    }
}
