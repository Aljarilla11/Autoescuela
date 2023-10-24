<?php

class PreguntaExamen 
{
    public $id;
    public $id_pregunta;
    public $id_examen;

    public function __construct($id, $id_pregunta, $id_examen) 
    {
        $this->id = $id;
        $this->id_pregunta = $id_pregunta;
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

    // Getter y Setter para el atributo $id_pregunta
    public function getIdPregunta() 
    {
        return $this->id_pregunta;
    }

    public function setIdPregunta($id_pregunta) 
    {
        $this->id_pregunta = $id_pregunta;
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