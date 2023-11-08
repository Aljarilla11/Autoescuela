<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <style>
        .menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        .submenu {
            float: left;
        }

        .submenu a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .submenu a:hover {
            background-color: #111;
        }

        .submenu .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 160px;
            z-index: 1;
        }

        .submenu:hover .dropdown-content {
            display: block;
        }

        .submenu .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .submenu .dropdown-content a:hover {
            background-color: #111;
        }

        .profesor-dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 160px;
            z-index: 1;
            margin-top: 50px;
        }

        .profesor:hover .profesor-dropdown-content {
            display: block;
        }

        .profesor-dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .profesor-dropdown-content a:hover {
            background-color: #111;
        }

        .crear-dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 160px;
            z-index: 1;
            margin-top: 50px;
        }

        .crear:hover .crear-dropdown-content {
            display: block;
        }

        .crear-dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .crear-dropdown-content a:hover {
            background-color: #111;
        }
    </style>
</head>
<body>

<ul class="menu">
    <li class="submenu">
        <a href="#administrar">Administrar Usuarios</a>
    </li>
    <li class="submenu">
        <a href="#hacerexamen">Hacer Examen</a>
        <div class="dropdown-content">
            <a href="#automatico">Automatico</a>
            <div class="profesor">
                <a href="#profesor">Profesor</a>
                <div class="dropdown-content">
            

                 </div>
            </div>
        </div>
    </li>
    <li class="submenu">
        <a href="#crearpreguntas">Crear Preguntas</a>
    </li>
    <li class="submenu">
        <a href="#verresultado">Ver Resultado</a>
    </li>
    <li class="submenu">
        <a href="#crearexamen">Crear Examen</a>
        <div class="dropdown-content">
            <a href="#manualmente">Manualmente</a>
            <a href="#aleatorio">Aleatorio</a>
        </div>
    </li>
</ul>

</body>
</html>
