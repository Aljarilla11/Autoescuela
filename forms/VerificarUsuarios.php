<?php

class FuncionesAdmin
{
    
   
    public static function adminFunctionality()
    {
        ImprimirMenus::imprimirMenuAdmin();
        $conexion = Db::conectar();
        $usuarioRepo = new UsuarioRepository($conexion);

        $usuarios = $usuarioRepo->obtenerTodosLosUsuarios();

        // Definir roles disponibles
        $rolesDisponibles = array('admin', 'alumno', 'profesor');
        
?>
        <link rel="stylesheet" href="../estilos/estiloAdminUser.css">

<?php

        if (!empty($usuarios)) {
?>
            <table>
                <tr>
                    <th>Nombre de Usuario</th>
                    <th>Acciones</th>
                </tr>
<?php
            foreach ($usuarios as $usuario) {
?>
                <tr>
                    <td><?php echo $usuario['nombre']; ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="usuario_id" value="<?php echo $usuario['id']; ?>">
                            <!-- Cambiar el campo de texto por un cuadro de lista -->
                            <select name="nuevo_role">
                                <?php
                                foreach ($rolesDisponibles as $rol) {
                                    echo "<option value=\"$rol\">$rol</option>";
                                }
                                ?>
                            </select>
                            <input type="submit" name="asignar_role" value="Asignar Role">
                            <input type="submit" name="eliminar_usuario" value="Eliminar Usuario">
                        </form>
                    </td>
                </tr>
<?php
            }
?>
            </table>
<?php
        } else {
            echo "No hay usuarios";
        }

        // Verificar si se ha enviado un formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['asignar_role'])) {
                // Lógica para actualizar el role del usuario
                $usuarioId = $_POST['usuario_id'];
                $nuevoRole = $_POST['nuevo_role'];
                $usuarioRepo->actualizarRoleUsuario($usuarioId, $nuevoRole);
                //header('Location: ?menu=adminuser');
                exit;
            } elseif (isset($_POST['eliminar_usuario'])) {
                // Lógica para eliminar al usuario
                $usuarioId = $_POST['usuario_id'];
                $usuarioRepo->eliminarUsuario($usuarioId);
                //header('Location: ?menu=adminuser');
                exit;
            }
        }
    }
}

// Llamar a la función de administración
FuncionesAdmin::adminFunctionality();
?>
