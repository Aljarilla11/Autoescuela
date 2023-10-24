<?php

class Pregunta 
{
    public $id;
    public $enunciado;
    public $resp1;
    public $resp2;
    public $resp3;
    public $correcto;
    public $url;
    public $tipoUrl;
    public $id_dificultad;
    public $id_categoria;

    public function __construct($id, $enunciado, $resp1, $resp2, $resp3, $correcto, $url, $tipoUrl, $id_dificultad, $id_categoria) 
    {
        $this->id = $id;
        $this->enunciado = $enunciado;
        $this->resp1 = $resp1;
        $this->resp2 = $resp2;
        $this->resp3 = $resp3;
        $this->correcto = $correcto;
        $this->url = $url;
        $this->tipoUrl = $tipoUrl;
        $this->id_dificultad = $id_dificultad;
        $this->id_categoria = $id_categoria;
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

    // Getter y Setter para el atributo $enunciado
    public function getEnunciado() 
    {
        return $this->enunciado;
    }

    public function setEnunciado($enunciado) 
    {
        $this->enunciado = $enunciado;
    }

    // Getter y Setter para el atributo $resp1
    public function getResp1() 
    {
        return $this->resp1;
    }

    public function setResp1($resp1) 
    {
        $this->resp1 = $resp1;
    }

    // Getter y Setter para el atributo $resp2
    public function getResp2() 
    {
        return $this->resp2;
    }

    public function setResp2($resp2) 
    {
        $this->resp2 = $resp2;
    }

    // Getter y Setter para el atributo $resp3
    public function getResp3() 
    {
        return $this->resp3;
    }

    public function setResp3($resp3) 
    {
        $this->resp3 = $resp3;
    }

    // Getter y Setter para el atributo $correcto
    public function getCorrecto() 
    {
        return $this->correcto;
    }

    public function setCorrecto($correcto) 
    {
        $this->correcto = $correcto;
    }

    // Getter y Setter para el atributo $url
    public function getUrl() 
    {
        return $this->url;
    }

    public function setUrl($url) 
    {
        $this->url = $url;
    }

    // Getter y Setter para el atributo $tipoUrl
    public function getTipoUrl() 
    {
        return $this->tipoUrl;
    }

    public function setTipoUrl($tipoUrl) 
    {
        $this->tipoUrl = $tipoUrl;
    }

    // Getter y Setter para el atributo $id_dificultad
    public function getIdDificultad() 
    {
        return $this->id_dificultad;
    }

    public function setIdDificultad($id_dificultad) 
    {
        $this->id_dificultad = $id_dificultad;
    }

    // Getter y Setter para el atributo $id_categoria
    public function getIdCategoria() 
    {
        return $this->id_categoria;
    }

    public function setIdCategoria($id_categoria) 
    {
        $this->id_categoria = $id_categoria;
    }
}


?>
