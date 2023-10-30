<?php

require_once "../helpers/funcionesLogin.php";
require_once "../helpers/sesion.php";

iniciaSesion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    login($nombre,$password);  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Formulario de Inicio de Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form action="login.php" method="POST">
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" name="enviar" value="Iniciar Sesión">
    </form>
    <p>¿No tienes una cuenta? <a href="http://autoescuela.com/forms/Register.php">Regístrate</a></p>
</body>
</html>

