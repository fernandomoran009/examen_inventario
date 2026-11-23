<?php
/**
 * Archivo que establece la conexión entre PHP y MySQL usando PDO.
 */

// Tarea 1: Cargar la configuración
$config = require __DIR__ . '/config.php';

// Tarea 2: Construir el Data Source Name (DSN)
$dsn = "mysql:host={$config['host']};"
    . "port={$config['port']};"
    . "dbname={$config['database']};"
    . "charset=utf8mb4";

// Tarea 3: Configuración de PDO
$opciones = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false
];

// Tarea 4: Establecer la conexión
try {
    $conexion = new PDO(
        $dsn,
        $config['username'],
        $config['password'],
        $opciones
    );
} catch (PDOException $error) {
    error_log("Error de conexión a MySQL: " . $error->getMessage());
    throw new RuntimeException(
        "No fue posible conectar con la base de datos."
    );
}

// Tarea 5: Devolver el objeto PDO
return $conexion;