<?php

require_once '../repository/Db.php';

if ($_SERVER['REQUEST_METHOD']=='POST')
{
    $datos_json = file_get_contents('php://input');
    $datos = json_decode($datos_json, true);

    if (isset($datos['nombre']) && isset($datos['role'])) 
    {
        try 
        {
            $conexion = Db::conectar();
            $query = "INSERT INTO usuario (nombre, role) VALUES (:nombre, :role)";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
            $statement->bindParam(':rol', $datos['rol'], PDO::PARAM_STR);
            $statement->execute();
            $nuevoUsuarioID = $conexion->lastInsertId();
            header('Content-type: application/json');
            echo json_encode(array('id' => $nuevoUsuarioID));

        } 
        catch (PDOException $e) 
        {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
        }
    } 
    else 
    {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array('error' => 'Datos incompletos'));
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') 
{
    
    $id = isset($_GET['id']) ? intval($_GET['id']) : 11;

    try 
    {
        $conexion = Db::conectar();
        $query = "SELECT id, nombre, role FROM usuario WHERE id = :id";
        $statement = $conexion->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $usuario = $statement->fetch(PDO::FETCH_ASSOC);

        if ($usuario) 
        {
            header('Content-type: application/json');
            echo json_encode($usuario);
        } 
        else 
        {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(array('error' => 'Usuario no encontrado'));
        }
    } 
    catch (PDOException $e) 
    {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
    }
}
elseif ($_SERVER['REQUEST_METHOD']=='DELETE')
{
 
     $id = isset($_GET['id']) ? intval($_GET['id']) : 0; 

     if ($id > 0) 
     {
         try 
         {
             $conexion = Db::conectar();
             $query = "DELETE FROM usuario WHERE id = :id";
             $statement = $conexion->prepare($query);
             $statement->bindParam(':id', $id, PDO::PARAM_INT);
             $statement->execute();

             $filas_afectadas = $statement->rowCount();
             if ($filas_afectadas > 0) 
             {
                 header('Content-type: application/json');
                 echo json_encode(array('mensaje' => 'Usuario eliminado exitosamente'));
             } 
             else 
             {
                 header('HTTP/1.0 404 Not Found');
                 echo json_encode(array('error' => 'Usuario no encontrado'));
             }
         } 
         catch (PDOException $e) 
         {
             header('HTTP/1.1 500 Internal Server Error');
             echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
         }
     } 
     else 
     {
         header('HTTP/1.0 400 Bad Request');
         echo json_encode(array('error' => 'ID de usuario no válido'));
     }
 }


 if ($_SERVER['REQUEST_METHOD'] == 'PUT') 
 {
    $datos_json = file_get_contents('php://input');
    $datos = json_decode($datos_json);

    if (isset($datos->id) && isset($datos->nombre) && isset($datos->role)) 
    {
        try 
        {
            $conexion = Db::conectar();

            $query = "UPDATE usuario SET nombre = :nombre, role = :role WHERE id = :id";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':id', $datos->id, PDO::PARAM_INT);
            $statement->bindParam(':nombre', $datos->nombre, PDO::PARAM_STR);
            $statement->bindParam(':role', $datos->role, PDO::PARAM_STR);
            $statement->execute();

            $filas_afectadas = $statement->rowCount();
            if ($filas_afectadas > 0) 
            {
                header('Content-type: application/json');
                echo json_encode(array('mensaje' => 'Usuario actualizado exitosamente'));
            } 
            else 
            {
                header('HTTP/1.0 404 Not Found');
                echo json_encode(array('error' => 'Usuario no encontrado'));
            }
        } 
        catch (PDOException $e) 
        {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(array('error' => 'Error en la base de datos: ' . $e->getMessage()));
        }
    } 
    else 
    {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array('error' => 'Datos incompletos'));
    }
}
 
 