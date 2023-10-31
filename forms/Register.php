<?php
require_once "../helpers/funcionesLogin.php";
require_once "../helpers/sesion.php";


iniciaSesion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    register($nombre,$password);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Formulario de Registro</title>
</head>
<body>
    <h1>Registro de Usuario</h1>
    <form action="Register.php" method="POST">
        <label for="nombre">Nombre de Usuario:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" name="enviar" value="Registrarse">
    </form>
</body>
</html>
