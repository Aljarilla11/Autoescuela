<?php

class Db
{
    private static $conexion = null;

    static function conectar()
    {
        if (self::$conexion == null)
        {
            self::$conexion = new PDO('mysql:host=localhost;dbname=autoescuela', 'root', '');
        }
        
        return self::$conexion;
    }

}

?>