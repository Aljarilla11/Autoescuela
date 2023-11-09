<?php

//require_once "../helpers/Sesion.php";
//require_once "../repository/Db.php";

class FuncionesLogin
{
    private static $conexion;

    public static function iniciarConexion()
    {
        self::$conexion = Db::conectar();
    }

    public static function login($nombre, $password)
    {
        Sesion::iniciaSesion();

        if (isset($_POST['enviar'])) 
        {
                      
            if(self::existeUsuario($nombre, $password)) 
            {
                $role = self::obtenerRoleUsuario($nombre, $password);

                if ($role === 'admin') 
                {
                    Sesion::guardarSesion('usuario', $_SESSION['usuario'] = $nombre);
                    header('Location: ?menu=admin');
                    exit;
                } 
                elseif ($role === 'alumno') 
                {
                    Sesion::guardarSesion('usuario', $_SESSION['usuario'] = $nombre);
                    header('Location: ?menu=alumno');
                    exit;
                } 
                elseif ($role === 'profesor') 
                {
                    Sesion::guardarSesion('usuario', $_SESSION['usuario'] = $nombre);
                    header('Location: ?menu=profesor');
                    exit;
                } 
                else 
                {
                    echo "No tienes un rol para esta aplicacion";
                }
            }
        } 
        else 
        {
            echo "No se encuentra registrado";
        }   
    }

    public static function existeUsuario($nombre, $password)
    {
        Sesion::iniciaSesion();
        self::iniciarConexion();

        // Utilizar sentencias preparadas para prevenir ataques de inyección de SQL
        $sql = "SELECT * FROM usuario WHERE nombre = :nombre AND password = :password AND role <> ''";
        $stmt = self::$conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    public static function obtenerRoleUsuario($nombre, $password)
    {
        Sesion::iniciaSesion();
        self::iniciarConexion();

        $sql = "SELECT role FROM usuario WHERE nombre = :nombre AND password = :password";
        $stmt = self::$conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) 
        {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['role'];
        } 
        else 
        {
            return null;
        }
    }

    public static function estaLogeado()
    {
        if (isset($_SESSION['usuario'])) 
        {
            return true; // El usuario está autenticado
        } 
        else 
        {
            return false; // El usuario no está autenticado
        }
    }

    public static function logout()
    {
         Sesion::cerrarSesion();
         header('Location: http://autoescuela.com/forms/Login.php');
         exit;
    }

    public static function register($nombre, $password)
    {
        Sesion::iniciaSesion();
        self::iniciarConexion();

        if (isset($_POST['enviar'])) 
        {
            $query = "INSERT INTO usuario (nombre, password) VALUES ('$nombre', '$password')";
            self::$conexion->exec($query);
            header('Location: http://autoescuela.com/forms/Login.php');
        }
    }
}

?>
