<?php

function conecta(){
    $host='db';
    $user='root';
    $pass='test';

    $conPDO = new PDO("mysql:host=$host",$user,$pass);
    $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conPDO;
}
function conectaDB(){
    $host='db';
    $user='root';
    $pass='test';
    $db='donaciones2';

    $conPDO = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
    $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conPDO;
}

function crearDB(){
    try{
        $conn = conecta();
        $sql = 'CREATE DATABASE IF NOT EXISTS donaciones2';

        return ($conn->exec($sql));

    }catch (PDOException $e){
       return false;
    }finally {
        $conn = null;
    }
}

function crearTabla($sql){
    try{
        $conn = conectaDB();
        $resultado = $conn->exec($sql);

        return ($resultado === false ? false : true);

    }catch (PDOException $e){
        return false;
    }finally {
        $conn = null;
    }
}

function crearAllTablas(){
    $sqlDon = "CREATE TABLE IF NOT EXISTS donantes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        apellidos VARCHAR(50) NOT NULL,
        edad INT NOT NULL CHECK (Edad >= 18),
        grupo_sanguineo ENUM('O-', 'O+', 'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+') NOT NULL,
        codigo_postal CHAR(5) NOT NULL CHECK (codigo_postal REGEXP '^[0-9]{5}$'),
        telefono_movil CHAR(9) NOT NULL CHECK (telefono_movil REGEXP '^[0-9]{9}$')
    )";
    $sqlHis = "CREATE TABLE IF NOT EXISTS historico (
        id INT AUTO_INCREMENT PRIMARY KEY,
        donante INT NOT NULL,
        fecha_donacion DATE NOT NULL,
        fecha_proxima_donacion DATE GENERATED ALWAYS AS (DATE_ADD(fecha_donacion, INTERVAL 4 MONTH)) STORED,
        FOREIGN KEY (donante) REFERENCES donantes(id)
    )";
    $sqlAdm = "CREATE TABLE IF NOT EXISTS administradores (
        nombre_usuario VARCHAR(50) PRIMARY KEY,
        contrasena VARCHAR(200) NOT NULL
    )";

    return([crearTabla($sqlDon),crearTabla($sqlHis),crearTabla($sqlAdm)]);
}

function addDonante($nombre, $apellidos, $edad, $grupoSanguineo, $codigoPostal, $telefonoMovil){
    try{
        $conn = conectaDB();

        $sql = "INSERT INTO donantes (nombre, apellidos, edad, grupo_sanguineo, codigo_postal, telefono_movil)
        VALUES (:nombre, :apellidos, :edad, :grupo_sanguineo, :codigo_postal, :telefono_movil)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
        $stmt->bindParam(':edad', $edad, PDO::PARAM_INT);
        $stmt->bindParam(':grupo_sanguineo', $grupoSanguineo, PDO::PARAM_STR);
        $stmt->bindParam(':codigo_postal', $codigoPostal, PDO::PARAM_STR);
        $stmt->bindParam(':telefono_movil', $telefonoMovil, PDO::PARAM_STR);

        return $stmt->execute();

    }catch (PDOException $e){
        return false;
    }finally {
        $conn = null;
    }
}
function addDonacion($idDonante,$fechaDonacion){
    try{
        $conn=conectaDB();


        $sql = "INSERT INTO historico (donante, fecha_donacion)
                VALUES (:donante, :fechaDonacion)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':donante', $idDonante, PDO::PARAM_INT);
        $stmt->bindParam(':fechaDonacion', $fechaDonacion, PDO::PARAM_STR);

        return $stmt->execute();
    




    }catch (PDOException $e){
        return $e;
    }finally {
        $conn = null;
    }
}

function borrarDonante($id){
    try{
        $conn = conectaDB();

        $conn->beginTransaction();

        $sqlDonaciones = "DELETE FROM historico WHERE donante = :donanteId";
        $stmtDonaciones = $conn->prepare($sqlDonaciones);
        $stmtDonaciones->bindParam(':donanteId', $id, PDO::PARAM_INT);
        $stmtDonaciones->execute();

        $sqlDonante = "DELETE FROM donantes WHERE id = :donanteId";
        $stmtDonante = $conn->prepare($sqlDonante);
        $stmtDonante->bindParam(':donanteId', $id, PDO::PARAM_INT);
        $stmtDonante->execute();

        $conn->commit();
        return true;
    }catch (PDOException $e){
        return false;
    }finally {
        $conn = null;
    } 
}

function listaDonantes($codPostal, $grupo){
    try{
        $conn = conectaDB();

        $sql = 'SELECT d.* FROM donantes d';

        if(isset($codPostal)){
            $sql = $sql . " LEFT JOIN historico h ON d.id = h.donante WHERE d.codigo_postal = '$codPostal'";
            if (isset($grupo)){
                $sql = $sql . " AND d.grupo_sanguineo = '$grupo'";
            }
            $sql = $sql . " AND (h.fecha_proxima_donacion IS NULL OR h.fecha_proxima_donacion > CURDATE())"; /** esto inecesario entendo */
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultados = $stmt->fetchAll();
        return $resultados;

    }catch (PDOException $e){
        return false;
    }finally {
        $conn = null;
    }
}