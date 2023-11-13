<?php
session_start();
$usuario_iniciado = isset($_SESSION['usuario']);

// Obtener el valor de la variable 'menu' (si está definida)
$menu_actual = isset($_GET['menu']) ? $_GET['menu'] : '';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoescuela - Inicio</title>
    <link rel="stylesheet" href="../estilos/estiloHeader.css">
   
</head>

<?php if (!$usuario_iniciado) { ?>

<header>
    <ul class="menu">
        <li class="first"><a href="?menu=inicio">AUTOESCUELA ILITURGI</a></li>
        <li><a href="?menu=inicio" <?php if ($menu_actual === 'inicio') echo 'class="active"'; ?>>INICIO</a></li>
        <li><a href="#vergaleria">VER GALERÍA</a></li>
        <li><a href="?menu=login">LOGIN</a></li>
        <li><a href="?menu=registro">REGISTRO</a></li>
        <li><a href="#contacto">CONTACTO</a></li>
    </ul>
</header>
<body>

   

    <?php if ($menu_actual == 'inicio' || $menu_actual == '') { ?>
        <!-- Imagen debajo del menú -->
        <img class="imagen" src="./imagenes/imagenfondo.jpg" alt="">
    <?php } ?>

<?php } ?>


</body>
</html>
