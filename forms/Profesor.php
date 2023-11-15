<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <link rel="stylesheet" href="../estilos/estiloMenuProfesor.css">
</head>
<body>

<ul class="menu">
    <li class="submenu">
        <a href="#hacerexamen">Hacer Examen</a>
        <div class="dropdown-content">
            <div class="profesor">
                <a href="?menu=hacerexamen">Profesor</a>
                <div class="profesor-dropdown-content">
                    <a href="#facil">Facil</a>
                    <a href="#medio">Medio</a>
                    <a href="#dificil">Dificil</a>
                </div>
            </div>
            <div class="automatico">
                <a href="?menu=hacerexamen">Automatico</a>
                <div class="automatico-dropdown-content">
                    <a href="#facil">Facil</a>
                    <a href="#medio">Medio</a>
                    <a href="#dificil">Dificil</a>
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
        <a href="#crearexamen">Crear Examen</a>
        <div class="dropdown-content">
            <a href="#manualmente">Manualmente</a>
            <div class="aleatorio">
                <a href="#aleatorio">Aleatorio</a>
                <div class="aleatorio-dropdown-content">
                    <a href="#facil">Facil</a>
                    <a href="#medio">Medio</a>
                    <a href="#dificil">Dificil</a>
                </div>
            </div>
        </div>
    </li>
</ul>

</body>
</html>
