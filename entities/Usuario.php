<?php

class Usuario 
{
    public $id;
    public $nombre;
    public $password;
    public $role;

    public function __construct($id, $nombre, $password, $role) 
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->role = $role;
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

    // Getter y Setter para el atributo $password
    public function getPassword() 
    {
        return $this->password;
    }

    public function setPassword($password) 
    {
        $this->password = $password;
    }

    // Getter y Setter para el atributo $role
    public function getRole() 
    {
        return $this->role;
    }

    public function setRole($role) 
    {
        $this->role = $role;
    }
}


?>