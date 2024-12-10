<?php

function conecta($host, $user, $pass, $db){
    return new mysqli($host, $user, $pass, $db);
}
function conectaBD(){
    return new mysqli('db', 'root', 'test', 'tienda2');
}

function cerrarConexion($conexion){
    if (isset($conexion) && $conexion->connect_errno === 0) {
        $conexion->close();
    }
}

function creaDB(){
    try{
        $conexion = conecta('db','root','test',null);

        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{

            $sqlCheck = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'tienda2'";
            $resultado = $conexion->query($sqlCheck);

            if ($resultado && $resultado->num_rows > 0){
                return [false, 'La base de datos "tienda2" ya existía.'];
            }

            $sql = 'CREATE DATABASE IF NOT EXISTS tienda2';
            if ($conexion->query($sql)){
                return [true, 'Base de datos "tienda2" creada correctamente.'];
            }else{
                return [false, 'Error crear base de datos "tienda2".'];
            }

        }

    }catch (mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        cerrarConexion($conexion);
    }
}

function creaTabla(){
    try{
        $conexion = conectaBD();

        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{

            $sqlCheck = "SHOW TABLES LIKE 'usuarios'";
            $resultado = $conexion->query($sqlCheck);

            if ($resultado && $resultado->num_rows > 0){
                return [false, 'La tabla "usuarios" ya existía.'];
            }

            $sql = '
                    CREATE TABLE IF NOT EXISTS `tienda2`.`usuarios` (
                        `id` INT NOT NULL AUTO_INCREMENT, 
                        `nombre` VARCHAR(50) NOT NULL, 
                        `apellidos` VARCHAR(100) NOT NULL, 
                        `edad` INT NOT NULL, 
                        `provincia` VARCHAR(50) NOT NULL, 
                        PRIMARY KEY (`id`) 
                    )';
            if($conexion->query($sql)){
                return [true, 'Tabla "usuarios" creada correctamente'];
            }else{
                return [false, 'No se pudo crear la tabla "usuarios".'];
            }
        }
    }catch (mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        cerrarConexion($conexion);
    }
}

function nuevoUsuario($nombre,$apellidos,$edad,$provincia){
    $conexion = conectaBD();
    try{
        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{

            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, edad, provincia) VALUES (?,?,?,?)");
            $stmt->bind_param("ssis", $nombre, $apellidos, $edad, $provincia);

            $stmt->execute();

            return [true, 'Usuario creado correctamente.'];
        }
    }catch (mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        cerrarConexion($conexion);
    }
}

function listarUsuarios(){
    $conexion = conectaBD();
    try{
        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            $sql = "SELECT * FROM usuarios";
            $resultado = $conexion->query($sql);

            return [true, $resultado->fetch_all(MYSQLI_ASSOC)];
        } 
    }catch (mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        cerrarConexion($conexion);
    }
}

function borrarUser($id){
    try{
        $conexion = conectaBD();

        if($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            
            $stmt = $conexion->prepare("DELETE FROM usuarios WHERE `usuarios`.`id` = ?");
            $stmt->bind_param("i",$id);
            $stmt->execute();

                return [true, 'Usuario borrado correctamente.'];
           
        }


    }catch (mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        cerrarConexion($conexion);
    }
}

function buscarUser($id){
    try {
        $conexion = conectaBD();

        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            $sql = "SELECT * FROM usuarios WHERE id = " . $id;
            $resultados = $conexion->query($sql);
            if ($resultados->num_rows == 1){
                return [true, $resultados->fetch_assoc()];
            }else{
                return [false, 'No se pudo recuperar el alumno.'];
            }
            
        }
        
    }catch (mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        cerrarConexion($conexion);
    }
}


function actualizaUsuario($id, $nombre, $apellidos, $edad, $provincia)
{
    try {
        $conexion = conectaBD();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "UPDATE usuarios SET nombre = ?, apellidos = ?, edad = ?, provincia = ? WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            
            $stmt->bind_param("ssisi", $nombre, $apellidos, $edad, $provincia, $id);

            $stmt->execute();

            return [true, 'Usuario actualizado correctamente.'];
            
        }
        
    }
    catch (mysqli_sql_exception $e) {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}