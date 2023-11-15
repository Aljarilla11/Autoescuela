<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['enunciado'], $_POST['resp1'], $_POST['resp2'], $_POST['resp3'], $_POST['correcto'], $_POST['categoria'], $_POST['dificultad'])) {

    
    
     Admin::imprimirMenuAdmin();
    $conexion = Db::conectar();

    $enunciado = $_POST['enunciado'];
    $resp1 = $_POST['resp1'];
    $resp2 = $_POST['resp2'];
    $resp3 = $_POST['resp3'];
    $correcto = $_POST['correcto'];
    $url = isset($_POST['url']) ? $_POST['url'] : null;
    $tipoUrl = isset($_POST['tipoUrl']) ? $_POST['tipoUrl'] : null;
    $categoriaNombre = $_POST['categoria'];
    $dificultadNombre = $_POST['dificultad'];

    // Obtener el id de la categoría
    $queryCategoria = "SELECT id FROM categoria WHERE nombre = :categoriaNombre LIMIT 1";
    $statementCategoria = $conexion->prepare($queryCategoria);
    $statementCategoria->bindParam(':categoriaNombre', $categoriaNombre);
    $statementCategoria->execute();
    $idCategoria = $statementCategoria->fetch(PDO::FETCH_COLUMN);

    // Obtener el id de la dificultad
    $queryDificultad = "SELECT id FROM dificultad WHERE nombre = :dificultadNombre LIMIT 1";
    $statementDificultad = $conexion->prepare($queryDificultad);
    $statementDificultad->bindParam(':dificultadNombre', $dificultadNombre);
    $statementDificultad->execute();
    $idDificultad = $statementDificultad->fetch(PDO::FETCH_COLUMN);

    // Sentencia SQL para insertar la pregunta
    $sql = "INSERT INTO pregunta (enunciado, resp1, resp2, resp3, correcto, url, tipoUrl, id_dificultad, id_categoria)
            VALUES (:enunciado, :resp1, :resp2, :resp3, :correcto, :url, :tipoUrl, :idDificultad, :idCategoria)";

    $statement = $conexion->prepare($sql);

    $statement->bindParam(':enunciado', $enunciado);
    $statement->bindParam(':resp1', $resp1);
    $statement->bindParam(':resp2', $resp2);
    $statement->bindParam(':resp3', $resp3);
    $statement->bindParam(':correcto', $correcto);
    $statement->bindParam(':url', $url);
    $statement->bindParam(':tipoUrl', $tipoUrl);
    $statement->bindParam(':idDificultad', $idDificultad, PDO::PARAM_INT);
    $statement->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);

    if ($statement->execute()) {
        echo "Pregunta guardada exitosamente.";
    } else {
        echo "Error al guardar la pregunta: " . $statement->errorInfo()[2];
    }

    // Cierra la conexión
    $conexion = null;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pregunta</title>
    <link rel="stylesheet" href="../estilos/estiloCrearPregunta.css">
</head>
<body>
    <h1>Crear Pregunta</h1>

    <form action="" method="post">
        <label for="enunciado">Enunciado:</label>
        <input type="text" name="enunciado" required>

        <label for="resp1">Respuesta 1:</label>
        <input type="text" name="resp1" required>

        <label for="resp2">Respuesta 2:</label>
        <input type="text" name="resp2" required>

        <label for="resp3">Respuesta 3:</label>
        <input type="text" name="resp3" required>

        <label for="correcto">Respuesta Correcta:</label>
        <input type="text" name="correcto" required>

        <label for="url">URL (opcional):</label>
        <input type="text" name="url">

        <label for="tipoUrl">Tipo de URL (opcional):</label>
        <input type="text" name="tipoUrl">

        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" required>

        <label for="dificultad">Dificultad:</label>
        <input type="text" name="dificultad" required>

        <button type="submit">Guardar Pregunta</button>
    </form>
</body>
</html>
