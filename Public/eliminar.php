<?php
$pdo = require __DIR__ . '/../app/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    if ($id) {
        $stmt = $pdo->prepare("DELETE FROM productos WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
header("Location: index.php?msg=Producto eliminado correctamente.");
exit;