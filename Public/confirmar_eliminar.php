<?php
// Activar visualización de errores (solo para desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pdo = require __DIR__ . '/../app/db.php';

$id = $_GET['id'] ?? null;
$producto = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT nombre FROM productos WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $producto = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Eliminación</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>⚠️ Confirmar Eliminación</h1>
        <nav><a href="index.php">← Volver al listado</a></nav>
    </header>

    <main>
        <?php if ($producto): ?>
            <div class="alerta alerta-advertencia">
                <p>¿Eliminar el producto <strong><?= htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8') ?></strong>?</p>
                <p>Esta acción no se puede deshacer.</p>
            </div>
            <form method="POST" action="eliminar.php" class="acciones-confirmar">
                <input type="hidden" name="id" value="<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>">
                <a href="index.php" class="btn btn-secundario">Cancelar</a>
                <button type="submit" class="btn btn-eliminar">Eliminar</button>
            </form>
        <?php else: ?>
            <div class="alerta alerta-error">
                <p>Producto no encontrado.</p>
            </div>
            <a href="index.php" class="btn btn-secundario">Volver al listado</a>
        <?php endif; ?>
    </main>
</body>
</html>