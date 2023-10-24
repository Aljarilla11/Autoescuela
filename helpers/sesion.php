<?php

function iniciaSesion()
{
    session_start();
} 

function cerrarSesion()
{
    session_destroy();
}

function guardarSesion($clave, $valor)
{
    $_SESSION[$clave] = $valor;
}

?>