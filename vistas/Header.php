<?php
// Inicia la sesión
session_start();

// Comprueba si el usuario ha iniciado sesión
$usuario_iniciado = isset($_SESSION['usuario']);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Autoescuela - Inicio</title>
    <style>
        .header {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
        }

        .menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        .menu li {
            float: left;
        }

        .menu li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .menu li a:hover {
            background-color: #111;
        }
    </style>
</head>
<body>
<?php 
if (!FuncionesLogin::estaLogeado()) 
{ ?>
<div class="header">
    <h2>Autoescuela Iliturgi</h2>
</div>


<ul class="menu">
    <li><a href="?menu=inicio">Inicio</a></li>
    <li><a href="#vergaleria">Ver Galería</a></li>
    <li><a href="?menu=login">Login</a></li>
    <li><a href="?menu=registro">Registro</a></li>
    <li><a href="#contacto">Contacto</a></li>
</ul>
<?php } ?>

</body>
</html>
