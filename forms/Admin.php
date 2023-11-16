<?php
class Admin
{
    public static function imprimirMenuAdmin()
    {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Menu</title>
            <link rel="stylesheet" href="../estilos/estiloMenuAdmin.css">
        </head>
        <body>

        <ul class="menu">
            <li class="submenu">
                <a href="?menu=adminuser">Administrar Usuarios</a>
            </li>
            <li class="submenu">
                <a href="?menu=hacerexamen">Hacer Examen</a>
                <div class="dropdown-content">
                    <div class="profesor">
                        <a href="?menu=hacerexamen">Profesor</a>
                        <div class="profesor-dropdown-content">
                            <a href="?menu=hacerexamen">Facil</a>
                            <a href="?menu=hacerexamen">Medio</a>
                            <a href="?menu=hacerexamen">Dificil</a>
                        </div>
                    </div>
                    <div class="automatico">
                        <a href="?menu=hacerexamen">Automatico</a>
                        <div class="automatico-dropdown-content">
                            <a href="?menu=hacerexamen">Facil</a>
                            <a href="?menu=hacerexamen">Medio</a>
                            <a href="?menu=hacerexamen">Dificil</a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="submenu">
                <a href="?menu=crearPregunta">Crear Preguntas</a>
            </li>
            <li class="submenu">
                <a href="#verresultado">Ver Resultado</a>
            </li>
            <li class="submenu">
                <a href="?menu=crearexamen2">Crear Examen</a>
                <div class="dropdown-content">
                    <a href="?menu=crearexamen2">Manualmente</a>
                    <div class="aleatorio">
                        <a href="?menu=crearexamen2">Aleatorio</a>
                        <div class="aleatorio-dropdown-content">
                            <a href="?menu=crearexamen2">Facil</a>
                            <a href="?menu=crearexamen2">Medio</a>
                            <a href="?menu=crearexamen2">Dificil</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        </body>
        </html>
        <?php
    }
}

// Llamar a la función desde cualquier parte
Admin::imprimirMenuAdmin();
?>
