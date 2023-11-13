<?php

class Register
{
    public static function registerUser()
    {
        //Sesion::iniciaSesion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $nombre = $_POST['nombre'];
            $password = $_POST['password'];
            FuncionesLogin::register($nombre, $password);
        }
    }
}

// Llamar al método para registrar usuarios
Register::registerUser();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="../estilos/estiloRegistro.css">
</head>
<body>
    <h1>Registro de Usuario</h1>
    <form action="" method="POST">
        <label for="nombre">Nombre de Usuario:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" name="enviar" value="Registrarse">
    </form>
</body>
</html>
