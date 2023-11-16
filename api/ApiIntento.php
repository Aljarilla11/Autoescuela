<?php

require_once '../repository/Db.php'; // Asegúrate de incluir tu archivo Db.php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $conexion = Db::conectar();
        $query = "SELECT * FROM intentos";
        $statement = $conexion->prepare($query);
        $statement->execute();
        $intentos = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($intentos) {
            header('Content-type: application/json');
            echo json_encode(['intentos' => $intentos]);
        } else {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(['error' => 'No se encontraron intentos']);
        }
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recuperar datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents('php://input'), true);

    // Validar y procesar los datos recibidos
    if (isset($data['fecha'], $data['json'], $data['id_usuario'], $data['id_examen'])) {
        try {
            $conexion = Db::conectar();
            $query = "INSERT INTO intentos (fecha, json, id_usuario, id_examen) VALUES (:fecha, :json, :id_usuario, :id_examen)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':fecha', $data['fecha']);
            $statement->bindParam(':json', $data['json']);
            $statement->bindParam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
            $statement->bindParam(':id_examen', $data['id_examen'], PDO::PARAM_INT);

            if ($statement->execute()) {
                header('Content-type: application/json');
                echo json_encode(['message' => 'Intento creado con éxito']);
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(['error' => 'No se pudo crear el intento']);
            }
        } catch (PDOException $e) {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'Datos incompletos o incorrectos']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Recuperar datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents('php://input'), true);

    // Validar y procesar los datos recibidos
    if (isset($data['id'])) {
        try {
            $conexion = Db::conectar();
            $query = "DELETE FROM intentos WHERE id = :id";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':id', $data['id'], PDO::PARAM_INT);

            if ($statement->execute()) {
                header('Content-type: application/json');
                echo json_encode(['message' => 'Intento eliminado con éxito']);
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(['error' => 'No se pudo eliminar el intento']);
            }
        } catch (PDOException $e) {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'Datos incompletos o incorrectos']);
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['error' => 'Método no permitido']);
}

?>
