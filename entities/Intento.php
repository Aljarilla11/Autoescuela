<?php

class Intento 
{
    public $id;
    public $fecha;
    public $json;
    public $id_usuario;
    public $id_examen;

    public function __construct($id, $fecha, $json, $id_usuario, $id_examen) 
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->json = $json;
        $this->id_usuario = $id_usuario;
        $this->id_examen = $id_examen;
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

    // Getter y Setter para el atributo $fecha
    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) 
    {
        $this->fecha = $fecha;
    }

    // Getter y Setter para el atributo $json
    public function getJson() 
    {
        return $this->json;
    }

    public function setJson($json) 
    {
        $this->json = $json;
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

    // Getter y Setter para el atributo $id_examen
    public function getIdExamen() 
    {
        return $this->id_examen;
    }

    public function setIdExamen($id_examen) 
    {
        $this->id_examen = $id_examen;
    }
}


?>