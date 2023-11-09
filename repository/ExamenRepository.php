<?php

//require_once '../repository/Db.php';

class ExamenRepository
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerExamenes()
    {
        $sql = "SELECT * FROM examen";
        $result = $this->conexion->query($sql);
        $examenes = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
        {
            $examenes[] = $row;
        }
        return $examenes;
    }

    public function obtenerExamenPorId($id)
    {
        $sql = "SELECT * FROM examen WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function eliminarExamenPorId($id)
    {
        $sql = "DELETE FROM examen WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}

?>
