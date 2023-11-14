<?php

require_once 'Db.php'; // Asegúrate de incluir tu archivo Db.php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $conexion = Db::conectar();
        $query = "SELECT id, nombre FROM categoria";
        $statement = $conexion->prepare($query);
        $statement->execute();
        $categorias = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($categorias) {
            header('Content-type: application/json');
            echo json_encode(['categorias' => $categorias]);
        } else {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(array('error' => 'No se encontraron categorías'));
        }
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Procesar solicitud DELETE
    parse_str(file_get_contents('php://input'), $_DELETE);
    $idCategoria = $_DELETE['id'] ?? null;

    if ($idCategoria) {
        try {
            $conexion = Db::conectar();
            $query = "DELETE FROM categoria WHERE id = :id";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':id', $idCategoria, PDO::PARAM_INT);

            if ($statement->execute()) {
                header('Content-type: application/json');
                echo json_encode(['message' => 'Categoría eliminada con éxito']);
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(['error' => 'No se pudo eliminar la categoría']);
            }
        } catch (PDOException $e) {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'ID de categoría no proporcionado']);
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['error' => 'Método no permitido']);
}
