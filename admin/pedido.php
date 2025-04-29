<?php
include '../conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'user') {
    header("Location: login.php");
    exit;
}

$pedido = $_POST['pedido'];
$usuario_id = $_SESSION['usuario']['id'];

$query = $conexion->prepare("INSERT INTO ordenes (usuario_id, pedido) VALUES (?, ?)");
$query->bind_param("is", $usuario_id, $pedido);
$query->execute();

echo "¡Orden enviada!";
echo '<br><a href="../index.php">Volver</a>';
