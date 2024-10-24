<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board {
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $content;

    /**
     * @var int
     */
    private int $date;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var int
     */
    private int $user_id;

    // Getters y Setters

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function getDate(): int {
        return $this->date;
    }

    public function setDate(int $date): void {
        $this->date = $date;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void {
        $this->user_id = $user_id;
    }
}
