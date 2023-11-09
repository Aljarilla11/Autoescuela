<?php

//require_once '../repository/Db.php';

class CategoriaRepository
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerCategorias()
    {
        $sql = "SELECT * FROM categoria";
        $result = $this->conexion->query($sql);
        $categorias = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
        {
            $categorias[] = $row;
        }
        return $categorias;
    }

    public function obtenerCategoriaPorId($id)
    {
        $sql = "SELECT * FROM categoria WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarCategoriaPorId($id, $nuevoNombre)
    {
        $sql = "UPDATE categoria SET nombre = :nuevo_nombre WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nuevo_nombre', $nuevoNombre);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function eliminarCategoriaPorId($id)
    {
        $sql = "DELETE FROM categoria WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}

?>
