<?ph

header("Access-Control-Allow-Origin: *");
require_once '../repository/Db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $conexion = Db::conectar();
        $query = "SELECT * FROM preguntaexamen";
        $statement = $conexion->prepare($query);
        $statement->execute();
        $preguntaexamenes = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($preguntaexamenes) {
            header('Content-type: application/json');
            echo json_encode(['preguntaexamenes' => $preguntaexamenes]);
        } else {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(['error' => 'No se encontraron preguntas de examen']);
        }
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id_pregunta'], $data['id_examen'])) {
        try {
            $conexion = Db::conectar();
            $query = "INSERT INTO preguntaexamen (id_pregunta, id_examen) VALUES (:id_pregunta, :id_examen)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':id_pregunta', $data['id_pregunta'], PDO::PARAM_INT);
            $statement->bindParam(':id_examen', $data['id_examen'], PDO::PARAM_INT);

            if ($statement->execute()) {
                header('Content-type: application/json');
                echo json_encode(['message' => 'Asociación creada con éxito']);
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(['error' => 'No se pudo crear la asociación']);
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
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['id'])) {
        try {
            $conexion = Db::conectar();
            $query = "DELETE FROM preguntaexamen WHERE id = :id";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':id', $data['id'], PDO::PARAM_INT);

            if ($statement->execute()) {
                header('Content-type: application/json');
                echo json_encode(['message' => 'Asociación eliminada con éxito']);
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(['error' => 'No se pudo eliminar la asociación']);
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
