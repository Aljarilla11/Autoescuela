<?php
require_once "../helpers/funcionesLogin.php";

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
    <form action="registro.php" method="POST">
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" name="registrar" value="Registrarse">
    </form>
</body>
</html>
