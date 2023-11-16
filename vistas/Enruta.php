<?php
if (isset($_GET['menu'])) 
{
    if ($_GET['menu'] == "inicio") 
    {
        require_once 'index.php';
    }

    if ($_GET['menu'] == "login") 
    {
        require_once './forms/Login.php';
    }

    if ($_GET['menu'] == "registro") 
    {
        require_once './forms/Register.php';
    }

    if ($_GET['menu'] == "cerrarsesion") 
    {
        require_once './Vistas/Login.php';
     
    }

    if ($_GET['menu'] == "admin") 
    {
        require_once './forms/Admin.php';
    }

    if ($_GET['menu'] == "profesor") 
    {
        require_once './forms/Profesor.php';
    }

    if ($_GET['menu'] == "alumno") 
    {
        require_once './forms/Alumno.php';
    }

    if($_GET['menu'] == "hacerexamen")
    {
        require_once './HacerExamen/index.html';
    }
    if($_GET['menu'] == "adminuser")
    {
        require_once './forms/VerificarUsuarios.php';
    }
    if($_GET['menu'] == "logout")
    {
        require_once './helpers/CierraSesion.php';
    }
    if($_GET['menu'] == "contacto")
    {
        require_once './forms/Contacto.php';
    }
    if($_GET['menu'] == "galeria")
    {
        require_once './forms/Galeria.php';
    }
    if($_GET['menu'] == "crearPregunta")
    {
        require_once './forms/CrearPregunta.php';
    }
    /**if($_GET['menu'] == "crearExamen")
    {
        require_once './forms/CrearExamen.php';
    }**/
    if($_GET['menu'] == "crearexamen")
    {
        require_once './CrearExamen/index.html';
    }
    if($_GET['menu'] == "recuperar")
    {
        require_once './forms/RecuperarContraseña.php';
    }



   
    
}
