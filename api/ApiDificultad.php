<?php

require_once 'Db.php'; // Asegúrate de incluir tu archivo Db.php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $conexion = Db::conectar();
        $query = "SELECT id, nombre FROM dificultad";
        $statement = $conexion->prepare($query);
        $statement->execute();
        $dificultades = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($dificultades) {
            header('Content-type: application/json');
            echo json_encode(['dificultades' => $dificultades]);
        } else {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(array('error' => 'No se encontraron dificultades'));
        }
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Procesar solicitud DELETE
    parse_str(file_get_contents('php://input'), $_DELETE);
    $idDificultad = $_DELETE['id'] ?? null;

    if ($idDificultad) {
        try {
            $conexion = Db::conectar();
            $query = "DELETE FROM dificultad WHERE id = :id";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':id', $idDificultad, PDO::PARAM_INT);

            if ($statement->execute()) {
                header('Content-type: application/json');
                echo json_encode(['message' => 'Dificultad eliminada con éxito']);
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(['error' => 'No se pudo eliminar la dificultad']);
            }
        } catch (PDOException $e) {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'ID de dificultad no proporcionado']);
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['error' => 'Método no permitido']);
}
