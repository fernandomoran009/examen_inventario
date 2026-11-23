<?php
$pdo = require __DIR__ . '/../app/db.php';

$id = $_GET['id'] ?? null;
$errores = [];
$datos = ['nombre' => '', 'categoria' => '', 'cantidad' => '', 'precio' => ''];

// Si es GET y hay ID, cargar datos para editar (F4)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $id) {
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $producto = $stmt->fetch();
    if ($producto) {
        $datos = $producto;
    } else {
        header("Location: index.php?msg=El producto no existe.");
        exit;
    }
}

// Si es POST, validar y guardar (S1, S2)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_post = $_POST['id'] ?? null;
    $datos = [
        'nombre'    => trim($_POST['nombre'] ?? ''),
        'categoria' => trim($_POST['categoria'] ?? ''),
        'cantidad'  => $_POST['cantidad'] ?? '',
        'precio'    => $_POST['precio'] ?? ''
    ];

    // Validación servidor (S1)
    if (empty($datos['nombre'])) {
        $errores[] = "El nombre es obligatorio.";
    }
    if (empty($datos['categoria'])) {
        $errores[] = "La categoría es obligatoria.";
    }
    if (!is_numeric($datos['cantidad']) || (int)$datos['cantidad'] < 0) {
        $errores[] = "La cantidad debe ser un número entero mayor o igual a cero.";
    }
    if (!is_numeric($datos['precio']) || (float)$datos['precio'] < 0) {
        $errores[] = "El precio debe ser un número mayor o igual a cero.";
    }

    // Si no hay errores, guardar (S2)
    if (empty($errores)) {
        if ($id_post) {
            // Actualizar (F4)
            $stmt = $pdo->prepare("UPDATE productos SET nombre=:nombre, categoria=:categoria, cantidad=:cantidad, precio=:precio WHERE id=:id");
            $stmt->execute([
                'nombre' => $datos['nombre'],
                'categoria' => $datos['categoria'],
                'cantidad' => $datos['cantidad'],
                'precio' => $datos['precio'],
                'id' => $id_post
            ]);
            header("Location: index.php?msg=Producto actualizado correctamente.");
        } else {
            // Crear (F2)
            $stmt = $pdo->prepare("INSERT INTO productos (nombre, categoria, cantidad, precio) VALUES (:nombre, :categoria, :cantidad, :precio)");
            $stmt->execute([
                'nombre' => $datos['nombre'],
                'categoria' => $datos['categoria'],
                'cantidad' => $datos['cantidad'],
                'precio' => $datos['precio']
            ]);
            header("Location: index.php?msg=Producto registrado correctamente.");
        }
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $id ? 'Editar' : 'Nuevo' ?> Producto</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1><?= $id ? '✏️ Editar' : '➕ Registrar' ?> Producto</h1>
        <nav><a href="index.php">← Volver al listado</a></nav>
    </header>

    <main>
        <?php if (!empty($errores)): ?>
            <div class="alerta alerta-error">
                <ul>
                    <?php foreach ($errores as $e): ?>
                        <li><?= htmlspecialchars($e, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="formulario.php" class="formulario">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <div class="campo">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($datos['nombre'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="campo">
                <label for="categoria">Categoría:</label>
                <input type="text" id="categoria" name="categoria" value="<?= htmlspecialchars($datos['categoria'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="campo">
                <label for="cantidad">Cantidad (Existencias):</label>
                <input type="number" id="cantidad" name="cantidad" value="<?= htmlspecialchars($datos['cantidad'], ENT_QUOTES, 'UTF-8') ?>" min="0" required>
            </div>

            <div class="campo">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" min="0" value="<?= htmlspecialchars($datos['precio'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <button type="submit" class="btn btn-primary"><?= $id ? 'Guardar Cambios' : 'Registrar Producto' ?></button>
        </form>
    </main>
</body>
</html>