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
                  
        if(existeUsuario($nombre, $password)) 
        {
            $role = obtenerRoleUsuario($nombre, $password);

            if ($role === 'admin') 
            {
                guardarSesion('usuario', $_SESSION['usuario'] = $nombre);
                header('Location: http://autoescuela.com/forms/Admin.php');
                exit;
            } 
            elseif ($role === 'alumno') 
            {
                guardarSesion('usuario', $_SESSION['usuario'] = $nombre);
                header('Location: http://autoescuela.com/forms/Alumno.php');
                exit;
            } 
            elseif ($role === 'profesor') 
            {
                guardarSesion('usuario', $_SESSION['usuario'] = $nombre);
                header('Location: http://autoescuela.com/forms/Profesor.php');
                exit;
            } 
            else 
            {
                echo "No tienes un rol para esta aplicacion";
            }
        }
    } 
    else 
    {
        echo "No se encuntra registrado";
    }   
}

function existeUsuario($nombre, $password)
{
    global $conexion;

    // Utilizar sentencias preparadas para prevenir ataques de inyección de SQL
    $sql = "SELECT * FROM usuario WHERE nombre = :nombre AND password = :password AND role <> ''";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) 
    {
        return true;
    } 
    else 
    {
        return false;
    }
}

function obtenerRoleUsuario($nombre, $password)
{
    global $conexion;

    $sql = "SELECT role FROM usuario WHERE nombre = :nombre AND password = :password";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) 
    {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['role'];
    } 
    else 
    {
        return null;
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