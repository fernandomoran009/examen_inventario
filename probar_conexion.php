<?php
try {
    $pdo = require __DIR__ . '/app/db.php';
    echo "✅ CONEXIÓN EXITOSA CON MYSQL\n";
    echo "Base de datos: examen_inventario\n";
    
    // Probar una consulta simple
    $stmt = $pdo->query("SELECT COUNT(*) AS total FROM productos");
    $resultado = $stmt->fetch();
    echo "📦 Productos encontrados: " . $resultado['total'] . "\n";
} catch (RuntimeException $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
}