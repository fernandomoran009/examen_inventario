<?php
/*
 * Plantilla de configuración para conectar con MySQL.
 * Este archivo NO contiene contraseñas reales.
 * Se puede subir a Git sin problema.
 */

// Dirección del servidor MySQL
$host = '127.0.0.1';
$puerto = '3306';

// Nombre de la base de datos
$baseDatos = 'examen_inventario';

// Usuario de la aplicación
$usuario = 'examen_user';

// Contraseña (placeholder, no real)
$contrasena = '12345678';

// Retornar los valores como arreglo asociativo
return [
    'host'     => $host,
    'port'     => $puerto,
    'database' => $baseDatos,
    'username' => $usuario,
    'password' => $contrasena
];