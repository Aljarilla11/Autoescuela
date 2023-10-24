<?php

class Dificultad 
{
    public $id;
    public $nombre;

    public function __construct($id, $nombre) 
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    // Getter y Setter para el atributo $id
    public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    // Getter y Setter para el atributo $nombre
    public function getNombre() 
    {
        return $this->nombre;
    }

    public function setNombre($nombre) 
    {
        $this->nombre = $nombre;
    }
}

?>