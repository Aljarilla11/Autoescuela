<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: http://autoescuela.com');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Allow-Credentials: true');
    http_response_code(200);
    exit;
}
require_once '../repository/Db.php'; // Asegúrate de incluir tu archivo Db.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    try 
    {
        // Obtén los datos del cuerpo de la solicitud
        $data = json_decode(file_get_contents("php://input"), true);

        // Validar y procesar los datos según tus necesidades
        $idUsuario = $data['idUsuario'];
        $fecha = $data['fecha'];
        $enunciado = $data['enunciado']; // Enunciado de la pregunta

        // Conecta a la base de datos
        $conexion = Db::conectar();

        // Busca el id_pregunta correspondiente al enunciado
        $selectPreguntaQuery = "SELECT id FROM pregunta WHERE enunciado = :enunciado";
        $selectPreguntaStatement = $conexion->prepare($selectPreguntaQuery);
        $selectPreguntaStatement->bindParam(':enunciado', $enunciado);
        $selectPreguntaStatement->execute();
        $idPregunta = $selectPreguntaStatement->fetchColumn();

        // Si no se encontró la pregunta, puedes decidir qué hacer, aquí se asume que la pregunta no existe
        if (!$idPregunta) {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(['error' => 'Pregunta no encontrada']);
            exit;
        }

        // Inserta el nuevo examen en la tabla 'examen'
        $insertExamenQuery = "INSERT INTO examen (fecha, id_usuario) VALUES (:fecha, :idUsuario)";
        $insertExamenStatement = $conexion->prepare($insertExamenQuery);
        $insertExamenStatement->bindParam(':fecha', $fecha);
        $insertExamenStatement->bindParam(':idUsuario', $idUsuario);
        $insertExamenStatement->execute();

        // Obtiene el ID del nuevo examen insertado
        $idExamen = $conexion->lastInsertId();

        // Inserta la pregunta en la tabla 'preguntaexamen'
        $insertPreguntaExamenQuery = "INSERT INTO preguntaexamen (id_examen, id_pregunta) VALUES (:idExamen, :idPregunta)";
        $insertPreguntaExamenStatement = $conexion->prepare($insertPreguntaExamenQuery);
        $insertPreguntaExamenStatement->bindParam(':idExamen', $idExamen);
        $insertPreguntaExamenStatement->bindParam(':idPregunta', $idPregunta);
        $insertPreguntaExamenStatement->execute();

        // Devuelve la respuesta según el resultado de la inserción
        header('Content-type: application/json');
        echo json_encode(['mensaje' => 'Examen y pregunta agregados correctamente']);
    } 
    catch (PDOException $e) 
    {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} 
else 
{
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['error' => 'Método no permitido']);
}
