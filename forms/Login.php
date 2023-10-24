<?php
require_once "funcionesLogin.php";
require_once "sesion.php";

iniciaSesion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $usuarios = 'usuarios.csv';
    login($nombre,$password,$usuarios);  
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
</body>
</html>
