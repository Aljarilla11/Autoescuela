<?php
require_once "funcionesLogin.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $nombreImagen = $_FILES['imagen_usuario']['name'];
    $nombrePDF = $_FILES['pdf_usuario']['name'];
    $usuarios = 'usuarios.csv';

    $dir_subida = 'C:/xampp/htdocs/uploads/';
    $imagen_subida = $dir_subida . $nombreImagen;
    $pdf_subido = $dir_subida . $nombrePDF;

    if (move_uploaded_file($_FILES['imagen_usuario']['tmp_name'], $imagen_subida) &&
        move_uploaded_file($_FILES['pdf_usuario']['tmp_name'], $pdf_subido)) 
    {
        echo "La imagen y el PDF se subieron con éxito.\n";    
    } 
    else 
    {
        echo "¡Posible ataque de subida de ficheros!\n";
    } 
    
    register($nombre, $password, $usuarios);

    descargarPDF($nombrePDF,$pdf_subido);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro con Imagen</title>
</head>
<body>
    <h1>Registro de Usuario con Imagen</h1>
    <form enctype="multipart/form-data" action="register.php" method="POST">
        <label for="nombre">Nombre de Usuario:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="password" required><br><br>
        
        Subir Imagen de Perfil: <input name="imagen_usuario" type="file" accept="image/*" required /><br><br>
        Subir PDF: <input name="pdf_usuario" type="file" accept=".pdf" required /><br><br>
        
        <input type="submit" value="Enviar ficheros" />
    </form>

    <?php

        
 
    ?>
</body>
</html>
