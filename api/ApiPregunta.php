<?php

header("Access-Control-Allow-Origin: *");
require_once '../repository/Db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') 
{
    try 
    {
        $conexion = Db::conectar();

        if (isset($_GET['categoria'], $_GET['dificultad'])) 
        {
            $categoria = $_GET['categoria'];
            $dificultad = $_GET['dificultad'];

            $query = "SELECT enunciado FROM pregunta p
                      INNER JOIN categoria c ON p.id_categoria = c.id 
                      INNER JOIN dificultad d ON p.id_dificultad = d.id
                      WHERE c.nombre = :categoria AND d.nombre = :dificultad";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':categoria', $categoria);
            $statement->bindParam(':dificultad', $dificultad);
            $statement->execute();
            $preguntas = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($preguntas) 
            {
                header('Content-type: application/json');
                echo json_encode(['preguntas' => $preguntas]);
            } 
            else 
            {
                header('HTTP/1.0 404 Not Found');
                echo json_encode(array('error' => 'No se encontraron preguntas'));
            }
        } 
        else 
        {
            
        $query = "SELECT p.id, p.enunciado, c.nombre AS categoria, d.nombre AS dificultad, 
        p.resp1 AS res1, p.resp2 AS res2, p.resp3 AS res3 FROM pregunta p
        INNER JOIN categoria c ON p.id_categoria = c.id INNER JOIN dificultad d ON p.id_dificultad = d.id";
        $statement = $conexion->prepare($query);
        $statement->execute();
        $preguntas = $statement->fetchAll(PDO::FETCH_ASSOC);
        $preguntasConRespuestas = [];
        foreach ($preguntas as $pregunta) 
        {
            $preguntaConRespuesta = 
            [
                'id' => $pregunta['id'],
                'enunciado' => $pregunta['enunciado'],
                'categoria' => $pregunta['categoria'],
                'dificultad' => $pregunta['dificultad'],
                'respuesta' => 
                [
                    'res1' => $pregunta['res1'],
                    'res2' => $pregunta['res2'],
                    'res3' => $pregunta['res3']
                ]
            ];
            $preguntasConRespuestas[] = $preguntaConRespuesta;
        }

        if ($preguntasConRespuestas) 
        {
            header('Content-type: application/json');
            echo json_encode(['preguntas' => $preguntasConRespuestas]);
        } 
        else 
        {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(array('error' => 'No se encontraron preguntas'));
        }
            
        }
        
       
    } 
    catch (PDOException $e) 
    {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
    }
} 
else 
{
    echo json_encode(['error' => 'Método no permitido']);
}
