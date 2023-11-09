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
            background-color: blue; /* Cambiado a azul */
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

        .submenu .dropdown-content {
            display: none;
            position: absolute;
            background-color: blue; /* Cambiado a azul */
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

        .profesor-dropdown-content,
        .aleatorio-dropdown-content,
        .automatico-dropdown-content {
            display: none;
            position: absolute;
            background-color: blue; /* Cambiado a azul */
            min-width: 160px;
            z-index: 1;
            margin-top: 0;
            margin-left: 100%;
        }

        .profesor:hover .profesor-dropdown-content,
        .aleatorio:hover .aleatorio-dropdown-content,
        .automatico:hover .automatico-dropdown-content {
            display: block;
        }

        .profesor-dropdown-content a,
        .aleatorio-dropdown-content a,
        .automatico-dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .profesor-dropdown-content .submenu,
        .automatico-dropdown-content .submenu {
            float: none;
        }
    </style>
</head>
<body>

<ul class="menu">
    <li class="submenu">
        <a href="#hacerexamen">Hacer Examen</a>
        <div class="dropdown-content">
            <div class="profesor">
                <a href="#profesor">Profesor</a>
                <div class="profesor-dropdown-content">
                    <a href="#facil">Facil</a>
                    <a href="#medio">Medio</a>
                    <a href="#dificil">Dificil</a>
                </div>
            </div>
            <div class="automatico">
                <a href="#automatico">Automatico</a>
                <div class="automatico-dropdown-content">
                    <a href="#facil">Facil</a>
                    <a href="#medio">Medio</a>
                    <a href="#dificil">Dificil</a>
                </div>
            </div>
        </div>
    </li>
    <li class="submenu">
        <a href="#verresultado">Ver Resultado</a>
    </li>
</ul>

</body>
</html>
