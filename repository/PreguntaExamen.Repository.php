<?php

//require_once '../repository/Db.php';

class PreguntaExamenRepository
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerPreguntasExamen()
    {
        $sql = "SELECT * FROM pregunta_examen";
        $result = $this->conexion->query($sql);
        $preguntasExamen = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
        {
            $preguntasExamen[] = $row;
        }
        return $preguntasExamen;
    }

    public function obtenerPreguntaExamenPorId($id)
    {
        $sql = "SELECT * FROM pregunta_examen WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function eliminarPreguntaExamenPorId($id)
    {
        $sql = "DELETE FROM pregunta_examen WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}

?>
