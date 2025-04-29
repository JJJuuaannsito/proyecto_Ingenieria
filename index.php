<?php
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];

if ($usuario['rol'] === 'admin') {
    header("Location: admin/admin.php");
    exit;
}
?>

<h1>Hola, <?= $usuario['username'] ?>!</h1>
<form action="admin/pedido.php" method="POST">
    <label>¿Qué querés pedir?</label><br>
    <textarea name="pedido" rows="4" cols="40"></textarea><br>
    <button type="submit">Hacer orden</button>
</form>
<a href="logout.php">Cerrar sesión</a>
x