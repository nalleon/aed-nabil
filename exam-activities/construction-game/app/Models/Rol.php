<?php

namespace App\Models;

class Rol{

/**
 * @var int
 *
 */
    private int $id;

    /**
     * @var string
     */
    private string $nombre;


    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     *
     * @return  string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @param  string  $nombre
     *
     * @return  self
     */
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}

?>
