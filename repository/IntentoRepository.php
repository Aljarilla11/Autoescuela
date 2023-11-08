<?php

require_once '../repository/Db.php';

class IntentoRepository
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerIntentos()
    {
        $sql = "SELECT * FROM intento";
        $result = $this->conexion->query($sql);
        $intentos = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
        {
            $intentos[] = $row;
        }
        return $intentos;
    }

    public function obtenerIntentoPorId($id)
    {
        $sql = "SELECT * FROM intento WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function eliminarIntentoPorId($id)
    {
        $sql = "DELETE FROM intento WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}

?>
