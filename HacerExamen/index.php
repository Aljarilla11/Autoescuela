<?php

//$rolUsuario = FuncionesLogin::obtenerRolUsuarioPorNombre($_SESSION['usuario']); // Reemplaza "nombre_de_usuario" con el nombre real

try {
    // Consulta preparada para obtener el rol del usuario por su nombre
    $conexion = Db::conectar();
    $query = "SELECT role FROM usuario WHERE nombre = :nombreUsuario";
    $statement = $conexion->prepare($query);

    $statement->bindParam(':nombreUsuario', $_SESSION['usuario'], PDO::PARAM_STR);
    $statement->execute();

    // Obtener el resultado de la consulta
    $resultado = $statement->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        $rolUsuario = $resultado['role'];
    } else {
        $rolUsuario = 'sinRol'; // Establece un valor predeterminado si el usuario no tiene un rol
    }
} catch (PDOException $e) {
    // Manejar errores de conexión o consultas
    $rolUsuario = 'sinRol';
}



// Lógica para determinar qué mostrar según el rol
if ($rolUsuario == 'admin') 
{
    ImprimirMenus::imprimirMenuAdmin();
} 
elseif ($rolUsuario == 'profesor') 
{
    ImprimirMenus::imprimirMenuProfesor();
} 
elseif ($rolUsuario == 'alumno') 
{
    ImprimirMenus::imprimirMenuAlumno();
} else 
{
    echo $rolUsuario;
    echo $_SESSION['usuario'];
    echo "<p>Rol no reconocido</p>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="HacerExamen/js/hacerExamen.js"></script>
    <link rel="stylesheet" href="HacerExamen/estilos/estiloExamen.css">
</head>
<body>


<div id="examen"></div>
<button id="comenzar">Comenzar</button>
<button id="finalizar">Finalizar Examen</button> 

</body>
</html>
