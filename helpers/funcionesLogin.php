<?php

require_once "sesion.php";
require_once "usuario.php";


function login($nombre,$password,$usuarios)
{
 
    if (isset($_POST['enviar'])) 
    {
                  
        if(existeUsuario($nombre,$password,$usuarios))
        {
            guardarSesion('usuario',getUsuario());
            header('Location: http://login.com/csv.php?nombre=' . urlencode($nombre));
            exit;
        }
    } 
    else 
    {
        echo "No se encuntra registrado";
    }   
}

function existeUsuario($nombre,$password,$usuarios)
{
    $lines = file($usuarios);

    if ($lines != false) 
    {
        foreach ($lines as $line) 
        {
            // Dividir cada línea en nombre y contraseña
            list($nombreEnviado, $contrasenaEnviada) = explode(',', trim($line));

            // Comprobar si las credenciales coinciden
            if ($nombre == $nombreEnviado && $password == $contrasenaEnviada) 
            {
               return true; // Las credenciales coinciden, el usuario está autenticado
            }
        }
        // Si el bucle llega hasta aquí, significa que no se encontraron coincidencias
        echo "Credenciales incorrectas";
    } 
    else 
    {
        echo "No se pudo acceder al archivo de usuarios.";
    }
    
    return false; // Si no se encontraron coincidencias o hubo un error, regresa false
}

function getUsuario()
{
    return new Usuario($nombre,$password,'user');
}

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
     header('Location: http://login.com/login.php');
     exit;
}

function register($nombre,$password,$usuarios)
{
    if (!empty($nombre) && !empty($password)) 
    {
        $registro = "$nombre,$password\n";

        $usuarios = 'usuarios.csv';
        $archivo = fopen($usuarios, 'a');

        fwrite($archivo, $registro);
        fclose($archivo);

        echo "Registro exitoso. El usuario $nombre ha sido registrado.";
        header('Location: http://login.com/login.php');
        exit;
    } 
    else 
    {
        echo "Por favor, ingrese un nombre de usuario y una contraseña válidos.";
    }
}

function descargarPDF($nombrePDF,$pdf_subido)
{
    // Establecer encabezado para abrir el PDF en una nueva pestaña
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . $nombrePDF . '"');
    readfile($pdf_subido);
    exit;
}

    
?>