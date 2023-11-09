<?php

//require_once '../repository/Db.php';

class DificultadRepository
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerDificultades()
    {
        $sql = "SELECT * FROM dificultad";
        $result = $this->conexion->query($sql);
        $dificultades = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
        {
            $dificultades[] = $row;
        }
        return $dificultades;
    }

    public function obtenerDificultadPorId($id)
    {
        $sql = "SELECT * FROM dificultad WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarDificultadPorId($id, $nuevoNombre)
    {
        $sql = "UPDATE dificultad SET nombre = :nuevo_nombre WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nuevo_nombre', $nuevoNombre);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function eliminarDificultadPorId($id)
    {
        $sql = "DELETE FROM dificultad WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}

?>
