<?php

class Db
{
    private $conexion = null;

    static function conetar()
    {
        if ($conexion == null)
        {
            $conexion = new PDO('mysql:host=localhost;dbname=autoescuela', 'root','');
        }
        
        return $conexion;
    }

}

?>