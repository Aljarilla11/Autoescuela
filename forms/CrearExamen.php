<?php

//$rolUsuario = FuncionesLogin::obtenerRolUsuarioPorNombre($_SESSION['usuario']);

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
// Obtener categorías
$conexion = Db::conectar();

$queryCategorias = "SELECT id, nombre FROM categoria";
$statementCategorias = $conexion->prepare($queryCategorias);
$statementCategorias->execute();
$categorias = $statementCategorias->fetchAll(PDO::FETCH_ASSOC);

// Obtener dificultades
$queryDificultades = "SELECT id, nombre FROM dificultad";
$statementDificultades = $conexion->prepare($queryDificultades);
$statementDificultades->execute();
$dificultades = $statementDificultades->fetchAll(PDO::FETCH_ASSOC);

// Funciones para obtener preguntas
function obtenerPreguntas($idCategoria, $idDificultad)
{
    $conexion = Db::conectar();

    $query = "SELECT * FROM pregunta WHERE id_categoria = :idCategoria AND id_dificultad = :idDificultad";
    $statement = $conexion->prepare($query);
    $statement->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);
    $statement->bindParam(':idDificultad', $idDificultad, PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerIdPreguntaPorEnunciado($enunciado)
{
    $conexion = Db::conectar();

    $query = "SELECT id FROM pregunta WHERE enunciado = :enunciado";
    $statement = $conexion->prepare($query);
    $statement->bindParam(':enunciado', $enunciado, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result ? $result['id'] : null;
}

// Variable para almacenar el ID del examen actual
$idExamenActual = null;
$cambiarExamen = 1;

if (isset($_POST['crearExamen'])) {
    $cambiarExamen = 2;
    echo "Examen creado con éxito.";
}

// Procesar el formulario cuando se añade una pregunta al examen
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['categoria'], $_POST['dificultad'])) 
    {
        $idCategoria = $_POST['categoria'];
        $idDificultad = $_POST['dificultad'];
        $preguntas = obtenerPreguntas($idCategoria, $idDificultad);
    } 
    elseif (isset($_POST['enunciado_pregunta'])) 
    {
        $enunciadoPregunta = $_POST['enunciado_pregunta'];

        // Obtener el ID de la pregunta por enunciado
        $idPregunta = obtenerIdPreguntaPorEnunciado($enunciadoPregunta);

        if ($idPregunta) 
        {
            // Si aún no hay un examen creado, crea uno nuevo
            if ($idExamenActual === null || $cambiarExamen == 1) {
                var_dump($cambiarExamen);
                $conexion = Db::conectar();
                $insertExamenQuery = "INSERT INTO examen (fechaHora, id_usuario) VALUES (NOW(), :idUsuario)";
                $insertExamenStatement = $conexion->prepare($insertExamenQuery);
                // Reemplaza 1 con el ID del usuario actual
                $idUsuario = 1;
                $insertExamenStatement->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
                $insertExamenStatement->execute();

                // Obtener el ID del nuevo examen insertado
                $idExamenActual = $conexion->lastInsertId();
            }

            // Insertar la pregunta en la tabla 'preguntaexamen'
            $insertPreguntaExamenQuery = "INSERT INTO preguntaexamen (id_examen, id_pregunta) VALUES (:idExamen, :idPregunta)";
            $insertPreguntaExamenStatement = $conexion->prepare($insertPreguntaExamenQuery);
            $insertPreguntaExamenStatement->bindParam(':idExamen', $idExamenActual, PDO::PARAM_INT);
            $insertPreguntaExamenStatement->bindParam(':idPregunta', $idPregunta, PDO::PARAM_INT);
            $insertPreguntaExamenStatement->execute();

            // Redirigir o realizar cualquier otra acción después de añadir la pregunta al examen
            header("Location: ?menu=crearexamen2");
            exit();
        }
        else {
            echo "Error: La pregunta no fue encontrada.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Examen</title>
    <link rel="stylesheet" href="../estilos/estiloCrearExamen.css">
</head>
<body>
    <h1>Crear Examen</h1>

    <!-- Formulario para seleccionar categoría y dificultad -->
    <form action="" method="post">
        <label for="categoria">Categoría:</label>
        <select name="categoria" required>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="dificultad">Dificultad:</label>
        <select name="dificultad" required>
            <?php foreach ($dificultades as $dificultad): ?>
                <option value="<?php echo $dificultad['id']; ?>"><?php echo $dificultad['nombre']; ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Buscar Preguntas</button>
    </form>

    <!-- Lista de preguntas encontradas -->
    <?php if (isset($preguntas)): ?>
        <h2>Preguntas encontradas:</h2>
        <form action="" method="post">
            <input type="hidden" name="crearExamen3" value="1">
            <ul>
                <?php foreach ($preguntas as $pregunta): ?>
                    <li>
                        <?php echo $pregunta['enunciado']; ?>
                        <input type="hidden" name="enunciado_pregunta" value="<?php echo $pregunta['enunciado']; ?>">
                        <button type="submit" name="addQuestion">Añadir al Examen</button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </form>  
    <?php endif; ?>
    
    <!-- Formulario para crear el examen -->
    <form action="" method="post">
        <input type="hidden" name="crearExamen">
        <button type="submit">Crear Examen</button>
    </form>
</body>
</html>