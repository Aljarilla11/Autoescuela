<?php

require_once "../helpers/sesion.php";
//require_once "usuario.php";
require_once "../repository/Db.php";

$conexion = Db::conectar();

function login($nombre,$password)
{
    global $conexion;

    if (isset($_POST['enviar'])) 
    {
                  
        if(existeUsuario($nombre,$password))
        {
            guardarSesion('usuario',$_SESSION['usuario'] = $nombre);
            header('Location: http://autoescuela.com/forms/ejemplo.php');
            exit;
        }
    } 
    else 
    {
        echo "No se encuntra registrado";
    }   
}

function existeUsuario($nombre,$password)
{
    global $conexion;

    $sql = "SELECT * FROM usuario WHERE nombre = '$nombre' AND password = '$password'";
    $result = $conexion->query($sql);

    if ($result->rowCount() > 0) 
    {
        return true;
    } 
    else 
    {
        return false;
    }
}

/*function getUsuario()
{
    return new Usuario($nombre,$password,);
}*/

function estaLogeado()
{
    if (isset($_SESSION['usuario'])) 
    {
        return true; // El usuario está autenticado
    } 
    else 
    {
        echo "Credenciales incorrectas";
        return false; // El usuario no está autenticado
    }
}




function logout()
{
     cerrarSesion();
     header('Location: http://autoescuela.com/forms/Login.php');
     exit;
}

function register($nombre,$password)
{
    global $conexion;

    if (isset($_POST['enviar'])) 
    {
        $query = "INSERT INTO usuario (nombre, password) VALUES ('$nombre', '$password')";
        $conexion->exec($query);
        header('Location: http://autoescuela.com/forms/Login.php');
    }
}

    
?>