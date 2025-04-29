<?php
include '../conexion.php';

session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$id = intval($_GET['id']);
$miId = $_SESSION['usuario']['id'];

// Prevenir que un admin se quite a sí mismo el rol
if ($id === $miId) {
    header("Location: admin.php?error=noAutoRevocar");
    exit;
}

$conexion->query("UPDATE usuarios SET rol = 'user' WHERE id = $id");
header("Location: admin.php");
exit;
