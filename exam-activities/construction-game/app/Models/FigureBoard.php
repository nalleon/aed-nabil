<?php

namespace App\Models;
/**
 * @author Nabil L. A.
 */
class FigureBoard {
    /**
     * @var int
     */
    private int $id;

    /**
     * @var int
     */
    private int $boardId;

    /**
     * @var int
     */
    private int $figureId;

    /**
     * @var int
     */
    private int $position;

    // Getters y Setters
    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }
    public function getBoardId(): int {
        return $this->boardId;
    }
    public function setBoardId(int $boardId): void {
        $this->boardId = $boardId;
    }
    public function getFigureId(): int {
        return $this->figureId;
    }
    public function setFigureId(int $figureId): void {
        $this->figureId = $figureId;
    }
    public function getPosition(): int {
        return $this->position;
    }
    public function setPosition(int $position): void {
        $this->position = $position;
    }


}
