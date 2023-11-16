<?php

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

// Función para obtener preguntas según los criterios seleccionados
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

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['categoria'], $_POST['dificultad'])) {
    $idCategoria = $_POST['categoria'];
    $idDificultad = $_POST['dificultad'];

    // Obtener preguntas
    $preguntas = obtenerPreguntas($idCategoria, $idDificultad);
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

    <?php if (isset($preguntas)): ?>
        <h2>Preguntas encontradas:</h2>
        <ul>
            <?php foreach ($preguntas as $pregunta): ?>
                <li><?php echo $pregunta['enunciado']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>