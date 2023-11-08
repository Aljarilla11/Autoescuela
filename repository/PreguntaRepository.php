<?php

require_once '../repository/Db.php';

class PreguntaRepository
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerPreguntas()
    {
        $sql = "SELECT * FROM pregunta";
        $result = $this->conexion->query($sql);
        $preguntas = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
        {
            $preguntas[] = $row;
        }
        return $preguntas;
    }

    public function obtenerPreguntaPorId($id)
    {
        $sql = "SELECT * FROM pregunta WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarPreguntaPorId($id, $nuevoEnunciado)
    {
        $sql = "UPDATE pregunta SET enunciado = :nuevo_enunciado WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nuevo_enunciado', $nuevoEnunciado);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function eliminarPreguntaPorId($id)
    {
        $sql = "DELETE FROM pregunta WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}

?>
