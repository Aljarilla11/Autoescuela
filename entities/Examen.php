<?php

class Examen 
{
    public $id;
    public $fechaHora;
    public $id_usuario;

    public function __construct($id, $fechaHora, $id_usuario) 
    {
        $this->id = $id;
        $this->fechaHora = $fechaHora;
        $this->id_usuario = $id_usuario;
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

    // Getter y Setter para el atributo $fechaHora
    public function getFechaHora() 
    {
        return $this->fechaHora;
    }

    public function setFechaHora($fechaHora) 
    {
        $this->fechaHora = $fechaHora;
    }

    // Getter y Setter para el atributo $id_usuario
    public function getIdUsuario() 
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario) 
    {
        $this->id_usuario = $id_usuario;
    }
}



?>