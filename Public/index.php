<?php
$pdo = require __DIR__ . '/../app/db.php';

$buscar = $_GET['buscar'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM productos WHERE nombre LIKE :buscar1 OR categoria LIKE :buscar2 ORDER BY id DESC");
$stmt->execute(['buscar1' => "%$buscar%", 'buscar2' => "%$buscar%"]);
$productos = $stmt->fetchAll();

$mensaje = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Tienda</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>📦 Inventario de Productos</h1>
        <nav><a href="formulario.php" class="btn btn-primary">+ Nuevo Producto</a></nav>
    </header>

    <main>
        <?php if ($mensaje): ?>
            <div class="alerta alerta-exito"><?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <form method="GET" action="index.php" class="buscador">
            <label for="buscar">Buscar:</label>
            <input type="text" id="buscar" name="buscar" value="<?= htmlspecialchars($buscar, ENT_QUOTES, 'UTF-8') ?>" placeholder="Nombre o categoría">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <?php if (empty($productos)): ?>
            <p class="alerta alerta-advertencia">No se encontraron registros que coincidan con la búsqueda.</p>
        <?php else: ?>
            <div class="tabla-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th><th>Nombre</th><th>Categoría</th>
                            <th>Cantidad</th><th>Precio</th><th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['id'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($p['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($p['categoria'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($p['cantidad'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td>$<?= htmlspecialchars(number_format($p['precio'], 2), ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="acciones">
                                    <a href="formulario.php?id=<?= $p['id'] ?>" class="btn btn-editar">Editar</a>
                                    <a href="confirmar_eliminar.php?id=<?= $p['id'] ?>" class="btn btn-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>