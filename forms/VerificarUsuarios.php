<?php

//require_once '../repository/Db.php';
//require_once '../repository/UsuarioRepository.php';

class FuncionesAdmin
{
    public static function adminFunctionality()
    {
        $conexion = Db::conectar();
        $usuarioRepo = new UsuarioRepository($conexion);

        // Obtener usuarios con role vacío
        $usuarios = $usuarioRepo->obtenerTodosLosUsuarios();

        if (!empty($usuarios)) 
        {
            echo "<table><tr><th>Nombre de Usuario</th><th>Acciones</th></tr>";
            foreach ($usuarios as $usuario) 
            {
                echo "<tr><td>".$usuario['nombre']."</td><td>";
                echo "<form method='post' action='Admin.php'>";
                echo "<input type='hidden' name='usuario_id' value='".$usuario['id']."'>";
                echo "<input type='text' name='nuevo_role' placeholder='Nuevo Role'>";
                echo "<input type='submit' name='asignar_role' value='Asignar Role'>";
                echo "<input type='submit' name='eliminar_usuario' value='Eliminar Usuario'>";
                echo "</form>";
                echo "</td></tr>";
            }
            echo "</table>";
        } 
        else 
        {
            echo "No hay usuarios";
        }

        // Verificar si se ha enviado un formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            if (isset($_POST['asignar_role'])) 
            {
                // Lógica para actualizar el role del usuario
                $usuarioId = $_POST['usuario_id'];
                $nuevoRole = $_POST['nuevo_role'];
                $usuarioRepo->actualizarRoleUsuario($usuarioId, $nuevoRole);
                header('Location: Admin.php');
                exit;
            } 
            elseif (isset($_POST['eliminar_usuario'])) 
            {
                // Lógica para eliminar al usuario
                $usuarioId = $_POST['usuario_id'];
                $usuarioRepo->eliminarUsuario($usuarioId);
                header('Location: Admin.php');
                exit;
            }
        }
    }
}

// Llamar a la función de administración
FuncionesAdmin::adminFunctionality();

?>
