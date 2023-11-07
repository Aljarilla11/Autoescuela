<?php

require_once '../repository/Db.php';

class UsuarioRepository
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerUsuariosConRoleVacio()
    {
        $sql = "SELECT * FROM usuario WHERE role = ''";
        $result = $this->conexion->query($sql);
        $usuarios = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
        {
            $usuarios[] = $row;
        }
        return $usuarios;
    }

    public function actualizarRoleUsuario($usuarioId, $nuevoRole)
    {
        $sql = "UPDATE usuario SET role = :nuevo_role WHERE id = :usuario_id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nuevo_role', $nuevoRole);
        $stmt->bindParam(':usuario_id', $usuarioId);
        $stmt->execute();
    }

    public function eliminarUsuario($usuarioId)
    {
        $sql = "DELETE FROM usuario WHERE id = :usuario_id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuarioId);
        $stmt->execute();
    }

    public function obtenerTodosLosUsuarios()
    {
        $sql = "SELECT * FROM usuario";
        $result = $this->conexion->query($sql);
        $usuarios = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
        {
            $usuarios[] = $row;
        }
        return $usuarios;
    }

}


?>